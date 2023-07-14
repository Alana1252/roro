<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\TransactionModel;
use App\Models\KapalModel;
use App\Models\KendaraanModel;



class OperatorController extends BaseController
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
        $this->db = \Config\Database::connect();
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

        return view('operator/tiket', $data);
    }
    public function searchTransaksi()
    {
        $tiketModel = new TiketModel();
        $orderId = $this->request->getPost('order_id');

        // Validasi input order_id
        $validation = \Config\Services::validation();
        $validation->setRules(['order_id' => 'required']);
        if (!$validation->run(['order_id' => $orderId])) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        // Cari order_id dalam tabel transaksi
        $transactionModel = new TransactionModel();
        $transaction = $transactionModel->where('order_id', $orderId)->first();

        if (!$transaction) {
            return redirect()->back()->withInput()->with('error', 'Tiket tidak ditemukan.');
        }

        $tiket = $tiketModel->find($transaction['id_tiket']);
        $jamModel = new JamModel();
        $jamKeberangkatan = $jamModel->find($tiket['keberangkatan']);
        $tanggalJamKeberangkatan = $tiket['tanggal'] . ' ' . $jamKeberangkatan['keberangkatan'];

        $now = date('Y-m-d H:i:s');
        if ($tanggalJamKeberangkatan < $now) {
            return redirect()->back()->withInput()->with('error', 'Tiket anda sudah melewati waktunya');
        }

        // Redirect ke halaman tampilan order_id
        return redirect()->to("/operator/print/$orderId");
    }


    public function cariOrder()
    {
        return view('operator/cari_id');
    }

    public function view($orderId)
    {
        // Cari transaksi berdasarkan order_id
        $transactionModel = new TransactionModel();
        $kendaraanModel = new KendaraanModel();
        $tiketModel = new TiketModel();
        $kapalModel = new KapalModel();
        $lokasiModel = new LokasiModel();
        $jamModel = new JamModel();
        $transaction = $transactionModel->where('order_id', $orderId)->first();
        $order = $transactionModel->find($orderId);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }
        if ($order) {
            $id_tiket = $order['id_tiket'];
            $tiket = $tiketModel->find($id_tiket);

            $id_kendaraan = $order['kouta_kendaraan'];
            $jenisKendaraan = $kendaraanModel->getJenis($id_kendaraan);

            $order['kouta_kendaraan'] = $jenisKendaraan;

            if ($tiket) {
                $order['asal'] = $tiket['asal'];
                $order['tujuan'] = $tiket['tujuan'];
                $order['keberangkatan'] = $tiket['keberangkatan'];
                $order['tiba'] = $tiket['tiba'];
                $order['kapal'] = $kapalModel->getKapalName($tiket['kapal']);
                $order['kelas'] = $order['kelas'];
                $order['nama_lengkap'] = $this->formatCustomerNames($order['nama_lengkap']);
                $order['kouta_penumpang'] = $order['kouta_penumpang'];
                $order['kouta_kendaraan'] = $jenisKendaraan;
                $order['tanggal'] = $tiketModel->getTanggalFormatted($tiket['tanggal']);
                $order['asal'] = $lokasiModel->getAsal($tiket['asal']);
                $order['tujuan'] = $lokasiModel->getTujuan($tiket['tujuan']);
                $order['keberangkatan'] = $jamModel->getJamKeberangkatan($tiket['keberangkatan']);
                $order['tiba'] = $jamModel->getJamTiba($tiket['tiba']);
                $order['tanggal'] = $tiketModel->getTanggalFormatted($tiket['tanggal']);
                $order['barcode'] = $order['barcode'];
            }
            // Tampilkan halaman tampilan order_id dengan data transaksi
            return view('operator/print_tiket', ['orderId' => $orderId, 'order' => $order]);
        }
    }
    private function formatCustomerNames($names)
    {
        $customerNames = explode(',', $names);
        $formattedNames = [];

        foreach ($customerNames as $key => $name) {
            $formattedNames[] = ($key + 1) . '. ' . trim($name);
        }

        return implode('<br>', $formattedNames);
    }
}
