<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\KapalModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\KelasModel;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\KendaraanModel;

class TiketController extends BaseController
{
    public function index()
    {
        $auth = service('authentication');

        // Cek apakah pengguna sudah login
        $isLoggedIn = $auth->check();
        $userImage = ($isLoggedIn) ? $auth->user()->user_img : '';

        // Jika belum login, tampilkan modal login
        if (!$isLoggedIn) {
            return view('pages/cari_tiket', [
                'isLoggedIn' => $isLoggedIn,
                'userImage' => $userImage,
                'showModal' => true
            ]);
        }

        // Jika sudah login, tampilkan halaman tiket
        return view('pages/cari_tiket', [
            'isLoggedIn' => $isLoggedIn,
            'userImage' => $userImage,
            'showModal' => false
        ]);
    }
    public function search()
    {
        $tanggal = $this->request->getVar('tanggal');
        $asal = $this->request->getVar('asal');
        $kelas = $this->request->getVar('kelas');
        $kouta_penumpang = $this->request->getVar('kouta_penumpang');
        $kouta_kendaraan = $this->request->getVar('kouta_kendaraan');

        // Logika untuk menentukan kapan modal akan ditampilkan
        $showModal = false; // Defaultnya false

        // Contoh logika berdasarkan parameter tertentu
        if ($tanggal == '2023-06-22' && $asal == 2 && $kelas == 'Ekonomi' && $kouta_penumpang == 1) {
            $showModal = true; // Jika parameter sesuai, set $showModal menjadi true
        }

        $tiketModel = new TiketModel();
        $tikets = $tiketModel->searchTiket($tanggal, $asal, $kouta_penumpang, $kouta_kendaraan);

        $kapalModel = new KapalModel();
        $jamModel = new JamModel();
        $lokasiModel = new LokasiModel();
        $kelasModel = new KelasModel();

        // Ambil harga dari tabel kelas berdasarkan pilihan pengguna
        $harga = $kelasModel->getHargaByNama($kelas);

        // Set nilai kelas pada tiket berdasarkan pilihan pengguna
        $kelasTiket = '';
        if ($kelas == 'Ekonomi') {
            $kelasTiket = 'Ekonomi';
        } elseif ($kelas == 'Premium') {
            $kelasTiket = 'Premium';
        }

        // Simpan nilai pencarian pada session
        session()->set('search_data', [
            'tanggal' => $tanggal,
            'asal' => $asal,
            'kelas' => $kelas,
            'kouta_penumpang' => $kouta_penumpang,
            'kouta_kendaraan' => $kouta_kendaraan
        ]);

        // Simpan data tiket dengan nilai kelas yang sesuai
        foreach ($tikets as &$tiket) {
            $tiket['kelas'] = $kelasTiket;
        }

        return view('pages/cari_tiket', [
            'tikets' => $tikets,
            'kapalModel' => $kapalModel,
            'jamModel' => $jamModel,
            'lokasiModel' => $lokasiModel,
            'kelasModel' => $kelasModel,
            'harga' => $harga,
            'namaKelas' => $kelas,
            'kouta_kendaraan' => $kouta_kendaraan,
            'kouta_penumpang' => $kouta_penumpang,
            'showModal' => $showModal // Mengirim nilai $showModal ke view
        ]);
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
        return redirect()->to("/order/print/$orderId");
    }


    public function cariOrder()
    {
        return view('pages/cari_orderid');
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
            return view('tiket/print_tiket', ['orderId' => $orderId, 'order' => $order]);
        }
    }
    private function formatCustomerNames($names)
    {
        $customerNames = explode(',', $names);
        $formattedNames = [];

        foreach ($customerNames as $key => $name) {
            $formattedNames[] =  ($key + 1) . '. ' . trim($name);
        }

        return implode('<br>', $formattedNames);
    }
}
