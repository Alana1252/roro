<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\TiketModel;
use App\Models\KapalModel;
use App\Models\JamModel;
use App\Models\LokasiModel;
use App\Models\KelasModel;

class DataController extends Controller
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
        // Dapatkan ID tiket dari session
        $selectedTiketId = session()->get('selected_tiket_id');

        if (!$selectedTiketId) {
            // Handle jika ID tiket tidak ada dalam session
            return redirect()->to('halaman-lain');
        }

        $tiketModel = new TiketModel();
        $tiket = $tiketModel->find($selectedTiketId); // Mengambil tiket berdasarkan ID tiket yang diberikan

        $kapalModel = new KapalModel();
        $jamModel = new JamModel();
        $lokasiModel = new LokasiModel();
        $kelasModel = new KelasModel();

        // Ambil harga dari tabel kelas berdasarkan pilihan pengguna
        $searchData = session('search_data');
        $kelas = isset($searchData['kelas']) ? $searchData['kelas'] : '';
        $harga = $kelasModel->getHargaByNama($kelas);

        // Tampilkan halaman detail tiket dengan data tiket yang dipilih
        return view('pages/detail_tiket', [
            'tiket' => $tiket,
            'kapalModel' => $kapalModel,
            'jamModel' => $jamModel,
            'lokasiModel' => $lokasiModel,
            'kelas' => $kelas,
            'harga' => $harga,
        ]);
    }
}
