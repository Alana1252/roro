<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\KapalModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\KelasModel; // Tambahkan ini
use CodeIgniter\Controller;

class TiketController extends Controller
{
    public function index()
    {
        $tiketModel = new TiketModel();
        $tikets = $tiketModel->findAll();

        $kapalModel = new KapalModel();
        $jamModel = new JamModel();
        $lokasiModel = new LokasiModel();
        $kelasModel = new KelasModel(); // Tambahkan ini

        return view('pages/tiket_view', [
            'tikets' => $tikets,
            'kapalModel' => $kapalModel,
            'jamModel' => $jamModel,
            'lokasiModel' => $lokasiModel,
            'kelasModel' => $kelasModel // Tambahkan ini
        ]);
    }
    public function search()
    {
        $tanggal = $this->request->getVar('tanggal');
        $asal = $this->request->getVar('asal');
        $kelas = $this->request->getVar('kelas');
    
        $tiketModel = new TiketModel();
        $tikets = $tiketModel->searchTiket($tanggal, $asal, $kelas);
    
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
    
        // Simpan data tiket dengan nilai kelas yang sesuai
        foreach ($tikets as &$tiket) {
            $tiket['kelas'] = $kelasTiket;
        }
    
        return view('pages/tiket_view', [
            'tikets' => $tikets,
            'kapalModel' => $kapalModel,
            'jamModel' => $jamModel,
            'lokasiModel' => $lokasiModel,
            'kelasModel' => $kelasModel,
            'harga' => $harga,
            'namaKelas' => $kelas
        ]);
    }
}