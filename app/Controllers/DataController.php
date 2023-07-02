<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TiketModel;
use App\Models\KapalModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\KelasModel;
use App\Models\KendaraanModel;
use Midtrans\Config;
use Midtrans\Snap;

class DataController extends BaseController
{
    public function selectTicket()
    {
        $tiketId = $this->request->getPost('tiket_id'); // Ambil ID tiket dari input form

        // Simpan ID tiket ke dalam session
        session()->set('selected_tiket_id', $tiketId);

        // Redirect ke halaman detail tiket
        return redirect()->to('detail-tiket');
    }

    public function detailTiket()
    {
        $tanggal = $this->request->getVar('tanggal');
        // Dapatkan ID tiket dari session
        $selectedTiketId = session()->get('selected_tiket_id');

        if (!$selectedTiketId) {
            // Handle jika ID tiket tidak ada dalam session
            return redirect()->to('home');
        }

        $tiketModel = new TiketModel();
        $tiket = $tiketModel->find($selectedTiketId); // Mengambil tiket berdasarkan ID tiket yang diberikan

        if (!$tiket) {
            // Handle jika tiket tidak ditemukan
            return redirect()->to('home');
        }

        $tanggalFormatted = $tiketModel->getTanggalFormatted($tiket['tanggal']);
        $tiket['tanggal_formatted'] = $tanggalFormatted;

        $kapalModel = new KapalModel();
        $jamModel = new JamModel();
        $lokasiModel = new LokasiModel();
        $kelasModel = new KelasModel();
        $kendaraanModel = new KendaraanModel();

        // Ambil data pencarian dari session
        $searchData = session('search_data');

        // Ambil harga dari tabel kelas berdasarkan pilihan pengguna
        $kelas = isset($searchData['kelas']) ? $searchData['kelas'] : '';
        $harga = $kelasModel->getHargaByNama($kelas);

        // Dapatkan ID kendaraan dari data pencarian
        $idKendaraan = isset($searchData['kouta_kendaraan']) ? $searchData['kouta_kendaraan'] : '';

        // Mendapatkan harga dari tabel Kendaraan berdasarkan ID kendaraan
        $jenisKendaraan = '';
        $hargaKendaraan = '';

        if ($idKendaraan !== null) {
            $kendaraan = $kendaraanModel->find($idKendaraan);
            if ($kendaraan) {
                $jenisKendaraan = $kendaraan['jenis'];
                $hargaKendaraan = $kendaraan['harga'];
            }
        }

        $koutaPenumpang = isset($searchData['kouta_penumpang']) ? $searchData['kouta_penumpang'] : 0;
        $hargaPenumpang = $koutaPenumpang * $harga;
        $jumlahHarga = $hargaKendaraan + $hargaPenumpang;

        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-3hL5upG4ONsCghSB1dlFe2H3';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'BKS-' . rand(),
                'gross_amount' => $jumlahHarga,
            ],
        ];

        // Generate Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Tampilkan halaman detail tiket dengan data tiket yang dipilih, golongan penumpang, jenis kendaraan, harga kendaraan, dan jumlah harga
        return view('tiket/detail_tiket', [
            'tiket' => $tiket,
            'kapalModel' => $kapalModel,
            'jamModel' => $jamModel,
            'lokasiModel' => $lokasiModel,
            'kelas' => $kelas,
            'harga' => $harga,
            'tanggal' => $tanggal,
            'idKendaraan' => $idKendaraan,
            'jenisKendaraan' => $jenisKendaraan,
            'hargaKendaraan' => $hargaKendaraan,
            'hargaPenumpang' => $hargaPenumpang,
            'jumlahHarga' => $jumlahHarga,
            'snapToken' => $snapToken,

        ]);
    }
}
