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
}
