<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\UserModel;
use App\Models\TransactionModel;
use Myth\Auth\Models\GroupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class AdminController extends BaseController
{
    protected $transactionModel;
    protected $tiketModel;
    protected $kendaraanModel;
    protected $groupModel;
    protected $userModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->tiketModel = new TiketModel();
        $this->groupModel = new GroupModel();
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }


    public function user()
    {
        $data['title'] = 'User List';
        $this->builder = $this->db->table('users');

        $this->builder->select('users.id as userid, username,status_message, email, name, user_image,status, created_at, updated_at, deleted_at,
        COUNT(CASE WHEN transaksi.transaction_status = "pending" THEN 1 END) as pending_count,
        COUNT(CASE WHEN transaksi.transaction_status = "settlement" THEN 1 END) as settlement_count');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('transaksi', 'transaksi.users = users.id', 'left');
        $this->builder->groupBy('users.id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
        return view('admin/user', $data);
    }
    public function editUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $deletedAt = ($status == 'Nonaktif') ? date('Y-m-d H:i:s') : null;

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'status' => $status,
            'status_message' => $this->request->getPost('status_message'),
            'deleted_at' => $deletedAt,
        ];

        $this->userModel->update($id, $data);

        // Periksa apakah ada perubahan pada group
        $groupId = $this->request->getPost('group');
        if (is_int($groupId) && $groupId !== $user->group_id) {
            $this->groupModel->removeUserFromAllGroups($id);
            $this->groupModel->addUserToGroup($id, $groupId);
        } else {
            // Handle the case when $groupId is an array or null
            // For example, display an error message or take appropriate action
        }

        return redirect('admin')->with('success', 'Data pengguna berhasil diperbarui.');
    }


    public function deleteUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Hapus pengguna berdasarkan ID
        $this->userModel->delete($id);

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
    }




    public function showTicket()
    {
        $data['title'] = 'Tiket List';
        $this->builder = $this->db->table('tiket');

        $this->builder->select('tiket.id_tiket as idtiket, tiket.kapal as tiket_kapal,
        tiket.keberangkatan as tiket_keberangkatan, tiket.tiba as tiket_tiba, tanggal,
        tiket.asal as tiket_asal, tiket.tujuan as tiket_tujuan,tiket.kouta_penumpang as koutapenumpang,
         tiket.kouta_kendaraan as koutakendaraan,');
        $this->builder->select('tiket.id_tiket, kapal.id_kapal, kapal.kapal');
        $this->builder->join('kapal', 'kapal.id_kapal = tiket.kapal', 'left');
        $this->builder->select('tiket.id_tiket, tiket.keberangkatan AS tiket_keberangkatan, tiket.tiba AS tiket_tiba, jam.keberangkatan AS jam_keberangkatan, jam.tiba AS jam_tiba');
        $this->builder->join('jam', 'jam.id_jam = tiket.keberangkatan', 'left');
        $this->builder->select('tiket.id_tiket, tiket.asal AS value_asal, tiket.tujuan AS value_tujuan, keberangkatan.asal AS tiket_asal, keberangkatan.tujuan AS tiket_tujuan');
        $this->builder->join('keberangkatan', 'keberangkatan.id_keberangkatan = tiket.asal', 'left');

        // Perhitungan Tiket Terjual
        $this->builder->select('(100 - tiket.kouta_penumpang) AS tiket_terjual');

        // Tiket Pending
        $this->builder->select('COUNT(CASE WHEN transaksi.transaction_status = "pending" THEN 1 END) AS tiket_pending');
        $this->builder->join('transaksi', 'transaksi.id_tiket = tiket.id_tiket', 'left');

        $this->builder->groupBy('tiket.id_tiket');
        $query = $this->builder->get();

        $data['tiket'] = $query->getResult();

        // Mengambil data kapal untuk opsi pada select

        $kapalData = $this->db->table('kapal')->get()->getResult();
        $data['kapalData'] = $kapalData;
        $jamData = $this->db->table('jam')->get()->getResult();
        $data['jamData'] = $jamData;
        $keberangkatanData = $this->db->table('keberangkatan')->get()->getResult();
        $data['keberangkatanData'] = $keberangkatanData;

        return view('admin/tiket', $data);
    }


    public function editTiket($id)
    {
        $tiket = $this->tiketModel->find($id);

        if (!$tiket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        $data = [
            'kapal' => $this->request->getPost('kapal'),
            'keberangkatan' => $this->request->getPost('keberangkatan'),
            'tiba' => $this->request->getPost('tiba'),
            'tanggal' => $this->request->getPost('tanggal'),
            'asal' => $this->request->getPost('asal'),
            'tujuan' => $this->request->getPost('tujuan'),
            'kouta_penumpang' => $this->request->getPost('kouta_penumpang'),
            'kouta_kendaraan' => $this->request->getPost('kouta_kendaraan'),

        ];

        $this->tiketModel->update($id, $data);
        return redirect('admin/tiket')->with('success', 'Tiket diperbarui.');
    }
    public function deleteTiket($id)
    {
        $tiket = $this->tiketModel->find($id);

        if (!$tiket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        // Hapus pengguna berdasarkan ID
        $this->tiketModel->delete($id);

        return redirect()->back()->with('success', 'Tiket dihapus.');
    }
    public function deleteAllTiket()
    {
        // Nonaktifkan constraint foreign key
        $this->tiketModel->disableForeignKeyChecks();

        // Menghapus semua data tiket
        $this->tiketModel->truncate();

        // Aktifkan kembali constraint foreign key
        $this->tiketModel->enableForeignKeyChecks();

        return redirect()->back()->with('success', 'Semua tiket dihapus.');
    }


    public function exportTiket()
    {
        $this->builder = $this->db->table('tiket');

        $this->builder->select('tiket.id_tiket as idtiket, tiket.kapal as tiket_kapal,
        tiket.keberangkatan as tiket_keberangkatan, tiket.tiba as tiket_tiba, tanggal,
        tiket.asal as tiket_asal, tiket.tujuan as tiket_tujuan,tiket.kouta_penumpang as koutapenumpang,
        tiket.kouta_kendaraan as koutakendaraan');
        $this->builder->select('tiket.id_tiket, kapal.id_kapal, kapal.kapal');
        $this->builder->join('kapal', 'kapal.id_kapal = tiket.kapal', 'left');
        $this->builder->select('tiket.id_tiket, tiket.keberangkatan AS tiket_keberangkatan, tiket.tiba AS tiket_tiba, jam.keberangkatan AS jam_keberangkatan, jam.tiba AS jam_tiba');
        $this->builder->join('jam', 'jam.id_jam = tiket.keberangkatan', 'left');
        $this->builder->select('tiket.id_tiket, tiket.asal AS value_asal, tiket.tujuan AS value_tujuan, keberangkatan.asal AS tiket_asal, keberangkatan.tujuan AS tiket_tujuan');
        $this->builder->join('keberangkatan', 'keberangkatan.id_keberangkatan = tiket.asal', 'left');

        // Perhitungan Tiket Terjual
        $this->builder->select('(100 - tiket.kouta_penumpang) AS tiket_terjual');

        // Tiket Pending
        $this->builder->select('COUNT(CASE WHEN transaksi.transaction_status = "pending" THEN 1 END) AS tiket_pending');
        $this->builder->join('transaksi', 'transaksi.id_tiket = tiket.id_tiket', 'left');

        $this->builder->groupBy('tiket.id_tiket');
        $query = $this->builder->get();

        $data = $query->getResult();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Keberangkatan');
        $sheet->setCellValue('D1', 'Tiba');
        $sheet->setCellValue('E1', 'Asal');
        $sheet->setCellValue('F1', 'Tujuan');
        $sheet->setCellValue('G1', 'Sisa Tiket');


        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(10);

        // Populate the data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->idtiket);
            $sheet->setCellValue('B' . $row, date('d-m-Y', strtotime($item->tanggal)));
            $sheet->setCellValue('C' . $row, date('H:i', strtotime($item->tiket_keberangkatan)) . ' WIB');
            $sheet->setCellValue('D' . $row, date('H:i', strtotime($item->tiket_tiba)) . ' WIB');
            $sheet->setCellValue('E' . $row, $item->tiket_asal);
            $sheet->setCellValue('F' . $row, $item->tiket_tujuan);
            $sheet->setCellValue('G' . $row, $item->koutapenumpang);

            $row++;
        }
        $spreadsheet->getProperties()->setCreator('Alan Kamesta Ginting');
        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'tiket_list.xlsx';

        // Set the appropriate headers for the download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Mengatur latar belakang kuning untuk header
        $headerStyle = $spreadsheet->getActiveSheet()->getStyle('A1:G1');
        $headerFill = $headerStyle->getFill();
        $headerFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        // Save the Excel file to output
        $writer->save('php://output');
        exit;
    }

    public function transaksi()
    {
        $data['title'] = 'Transaksi List';
        $this->builder = $this->db->table('transaksi');

        // Join the 'tiket' table with 'jam' table
        $this->builder->join('tiket', 'tiket.id_tiket = transaksi.id_tiket');
        $this->builder->join('jam j1', 'j1.id_jam = tiket.keberangkatan');
        $this->builder->join('jam j2', 'j2.id_jam = tiket.tiba');
        $this->builder->join('keberangkatan l1', 'l1.id_keberangkatan = tiket.asal');
        $this->builder->join('keberangkatan l2', 'l2.id_keberangkatan = tiket.tujuan');
        $this->builder->join('users', 'users.id = transaksi.users');
        $this->builder->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.kouta_kendaraan');

        // Select the desired columns, including the username from the users table and the jenis from the kendaraan table
        $this->builder->select('transaksi.order_id, tiket.id_tiket as idtiket, j1.keberangkatan, j2.tiba, l1.asal, l2.tujuan, tiket.tanggal, transaksi.kouta_penumpang, transaksi.kouta_kendaraan, transaksi.kelas, users.username, transaksi.nama_lengkap, transaksi.gross_amount, transaksi.payment_type, transaksi.payment_method, transaksi.transaction_time, transaksi.transaction_status, transaksi.barcode, kendaraan.jenis');

        $query = $this->builder->get();

        $transaksi = $query->getResult();

        foreach ($transaksi as &$row) {
            $namaLengkapArray = explode(', ', $row->nama_lengkap);
            $jumlahNama = count($namaLengkapArray);
            $namaPertama = $namaLengkapArray[0];
            $namaLengkapFormatted = '';
            for ($i = 0; $i < $jumlahNama; $i++) {
                $nomorUrut = $i + 1;
                $namaLengkapFormatted .= '<div>' . $nomorUrut . '. ' . $namaLengkapArray[$i] . '</div>';
            }
            $inputNamaLengkap = $namaLengkapArray;
            $row->nama_pertama = $namaPertama;
            $row->nama_lengkap = $namaLengkapFormatted;


            $row->input_nama_lengkap = $inputNamaLengkap;
        }

        $data['transaksi'] = $transaksi;

        return view('admin/transaksi', $data);
    }

    public function editTransaksi($id)
    {
        $transaksi = $this->transactionModel->find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Mendapatkan data nama_lengkap dari input form
        $namaLengkap = $this->request->getPost('nama_lengkap');

        // Memperbarui data transaksi dengan nilai yang sesuai
        $data = [
            'nama_lengkap' => implode(', ', $namaLengkap), // Menggabungkan array nama_lengkap menjadi satu string dengan pemisah koma
            'transaction_status' => $this->request->getPost('transaction_status'),
            'payment_method' => $this->request->getPost('payment_method'),
            'kelas' => $this->request->getPost('kelas'),
            'kouta_penumpang' => count($namaLengkap),
            'kouta_kendaraan' => $this->request->getPost('kouta_kendaraan'),
        ];

        $this->transactionModel->update($id, $data);
        return redirect('admin/transaksi')->with('success', 'Transaksi diperbarui.');
    }

    public function deleteTransaksi($id)
    {
        $transaksi = $this->transactionModel->find($id);

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $this->transactionModel->delete($id);

        return redirect('admin/transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }


    public function exportTransaksi()
    {
        $this->builder = $this->db->table('transaksi');

        // Join the 'tiket' table with 'jam' table
        $this->builder->join('tiket', 'tiket.id_tiket = transaksi.id_tiket');
        $this->builder->join('jam j1', 'j1.id_jam = tiket.keberangkatan');
        $this->builder->join('jam j2', 'j2.id_jam = tiket.tiba');
        $this->builder->join('keberangkatan l1', 'l1.id_keberangkatan = tiket.asal');
        $this->builder->join('keberangkatan l2', 'l2.id_keberangkatan = tiket.tujuan');
        $this->builder->join('users', 'users.id = transaksi.users');
        $this->builder->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.kouta_kendaraan');

        // Select the desired columns, including the username from the users table and the jenis from the kendaraan table
        $this->builder->select('transaksi.order_id, tiket.id_tiket as idtiket, j1.keberangkatan, j2.tiba, l1.asal, l2.tujuan, tiket.tanggal, transaksi.kouta_penumpang, transaksi.kouta_kendaraan, transaksi.kelas, users.username, transaksi.nama_lengkap, transaksi.gross_amount, transaksi.payment_type, transaksi.payment_method, transaksi.transaction_time, transaksi.transaction_status, transaksi.barcode, kendaraan.jenis');

        $query = $this->builder->get();

        $data = $query->getResult();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $sheet->setCellValue('A1', 'Order ID');
        $sheet->setCellValue('B1', 'Tiket ID');
        $sheet->setCellValue('C1', 'Nama Pemesan');
        $sheet->setCellValue('D1', 'Jumlah Penumpang');
        $sheet->setCellValue('E1', 'Golongan');
        $sheet->setCellValue('F1', 'Kelas');
        $sheet->setCellValue('G1', 'Jumlah Pembayaran');
        $sheet->setCellValue('H1', 'Tipe Pembayaran');
        $sheet->setCellValue('I1', 'Waktu Pembayaran');
        $sheet->setCellValue('J1', 'Status Pembayaran');
        $sheet->setCellValue('K1', 'Nama Penumpang');


        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(18);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(35);
        // Populate the data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->order_id);
            $sheet->setCellValue('B' . $row, $item->idtiket);
            $sheet->setCellValue('C' . $row, $item->username);
            $sheet->setCellValue('D' . $row, $item->kouta_penumpang);
            $sheet->setCellValue('E' . $row, $item->jenis);
            $sheet->setCellValue('F' . $row, $item->kelas);
            $sheet->setCellValue('G' . $row, $item->gross_amount);
            $sheet->setCellValue('H' . $row, $item->payment_method);
            $sheet->setCellValue('I' . $row, $item->transaction_time);
            $sheet->setCellValue('J' . $row, $item->transaction_status);
            $sheet->setCellValue('K' . $row, $item->nama_lengkap);

            $row++;
        }
        $spreadsheet->getProperties()->setCreator('Alan Kamesta Ginting');
        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'transaksi_list.xlsx';

        // Set the appropriate headers for the download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        // Mengatur latar belakang kuning untuk header
        $headerStyle = $spreadsheet->getActiveSheet()->getStyle('A1:K1');
        $headerFill = $headerStyle->getFill();
        $headerFill->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

        // Save the Excel file to output
        $writer->save('php://output');
        exit;
    }
}
