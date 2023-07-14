<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\TransactionModel;
use Myth\Auth\Models\GroupModel;
use App\Models\UserModel as AuthUserModel;


class UserController extends BaseController
{
    protected $transactionModel;
    protected $tiketModel;
    protected $groupModel;
    protected $authUserModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->tiketModel = new TiketModel();
        $this->groupModel = new GroupModel();
        $this->authUserModel = new AuthUserModel();
        $this->db = \Config\Database::connect();
    }
    public function user()
    {
        $userId = user_id();
        $user = $this->authUserModel->where('id', $userId)->first();
        $data['user'] = $user;
        $data['title'] = $user->username;

        $this->builder = $this->db->table('auth_groups_users');
        $this->builder->select('auth_groups.name');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups_users.user_id', $userId);
        $query = $this->builder->get();
        $data['groups'] = $query->getResult();

        // Tambahkan logika untuk menentukan apakah ikon edit harus ditampilkan
        $showEditIcon = $this->isUpdatedRecently($user->updated_at);
        $data['showEditIcon'] = $showEditIcon;
        // Mendapatkan jumlah transaksi per user dengan status "settlement"
        $transactionCountsSettlement = $this->transactionModel->select('users.id as user_id, COUNT(*) as total_transactions_settlement, SUM(gross_amount) as total_gross_settlement')
            ->join('users', 'users.id = transaksi.users')
            ->where('transaksi.transaction_status', 'settlement')
            ->groupBy('users.id')
            ->findAll();

        $data['totalSettlement'] = 0;
        $data['totalGrossSettlement'] = 0;
        foreach ($transactionCountsSettlement as $transaction) {
            $data['totalSettlement'] += $transaction['total_transactions_settlement'];
            $data['totalGrossSettlement'] += $transaction['total_gross_settlement'];
        }

        // Mendapatkan jumlah transaksi per user dengan status "pending"
        $transactionCountsPending = $this->transactionModel->select('users.id as user_id, COUNT(*) as total_transactions_pending, SUM(gross_amount) as total_gross_pending')
            ->join('users', 'users.id = transaksi.users')
            ->where('transaksi.transaction_status', 'pending')
            ->groupBy('users.id')
            ->findAll();

        $data['totalPending'] = 0;
        $data['totalGrossPending'] = 0;
        foreach ($transactionCountsPending as $transaction) {
            $data['totalPending'] += $transaction['total_transactions_pending'];
            $data['totalGrossPending'] += $transaction['total_gross_pending'];
        }

        // Menghitung total transaksi
        $data['totalTransactions'] = $data['totalPending'] + $data['totalSettlement'];
        $data['totalGrossAmount'] = $data['totalGrossPending'] + $data['totalGrossSettlement'];
        // Menghitung total transaksi
        $data['totalTransactions'] = $data['totalPending'] + $data['totalSettlement'];

        return view('pages/user', $data);
    }






    private function isUpdatedRecently($updatedAt)
    {
        $oneWeekInSeconds = 7 * 24 * 60 * 60; // 1 minggu dalam detik
        $updatedTime = strtotime($updatedAt);
        $currentTime = time();

        return $currentTime - $updatedTime >= $oneWeekInSeconds;
    }
    public function updateProfileImage()
    {
        $profileImage = $this->request->getFile('profile_image');

        if ($profileImage->isValid()) {
            $user = $this->authUserModel->where('id', user_id())->first();

            if ($user->user_image !== 'default.svg') {
                $oldImagePath = 'img/user/' . $user->user_image;
                if (is_file($oldImagePath) && $user->user_image !== 'default.svg') {
                    unlink($oldImagePath);
                }
            }

            $newImageName = $profileImage->getRandomName();
            $profileImage->move('img/user', $newImageName);

            // Memperbarui data pengguna dengan nama file gambar baru
            // Memperbarui data pengguna dengan nama file gambar baru
            $data = [
                'user_image' => $newImageName
            ];

            // Periksa apakah $data tidak kosong dan $newImageName memiliki nilai yang benar
            if (!empty($data) && !empty($newImageName)) {
                $this->authUserModel->protect(false)->update(user_id(), $data);
                return redirect()->back()->with('success', 'Profile image has been updated.');
            }
        }

        return redirect()->back()->with('error', 'Failed to upload profile image.');
    }
    public function updateUsername()
    {
        $newUsername = $this->request->getPost('new_username');

        // Lakukan validasi atau pemrosesan lainnya sesuai kebutuhan

        // Contoh pembaruan username dalam tabel "users"
        $data = [
            'username' => $newUsername
        ];
        $this->authUserModel->update(user_id(), $data);

        $response = [
            'success' => true
        ];

        return $this->response->setJSON($response);
    }
    public function updateFullname()
    {
        $newFullname = $this->request->getPost('new_fullname');

        $data = [
            'fullname' => $newFullname
        ];

        if (!empty($data) && !empty($newFullname)) {
            $this->authUserModel->protect(false)->update(user_id(), $data);
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
