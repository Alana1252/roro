<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;

class AdminController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        $groupModel = new GroupModel();

        // Menambahkan data grup ke setiap pengguna
        foreach ($users as &$user) {
            $groups = $groupModel->getGroupsForUser($user->id);
            $user->groups = $groups;
        }

        $transactionModel = new TransactionModel();

        return view('admin/index', ['users' => $users, 'transactionModel' => $transactionModel]);
    }

    public function updateUser()
    {
        $userModel = new UserModel();

        // Validasi input pengguna jika diperlukan

        // Ambil data pengguna yang akan diperbarui


        $userIndex = $this->request->getPost('user_index');

        if (!isset($users[$userIndex])) {
            // Menangani jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'User not found');
        }

        $user = $users[$userIndex];
        $user->username = $this->request->getPost('username');
        $user->email = $this->request->getPost('email');
        $user->status = $this->request->getPost('status');
        $user->status_message = $this->request->getPost('status_message');
        $user->group = $this->request->getPost('group');

        // Simpan perubahan data pengguna
        $users[$userIndex] = $user;


        // Redirect ke halaman index atau halaman lain yang sesuai
        return redirect()->to('/admin')->with('success', 'User updated successfully');
    }

    public function editUser($id)
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            // Menangani jika pengguna tidak ditemukan
            return redirect()->back()->with('error', 'User not found');
        }

        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();

        return view('admin/edit_user', ['user' => $user, 'groups' => $groups]);
    }
}
