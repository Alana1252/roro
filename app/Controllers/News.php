<?php

namespace App\Controllers;

use App\Models\News_model;

class News extends BaseController
{
    public function index()
    {
        $model = new News_model();
        $data['news'] = $model->getLatestNews();

        return view('pages/home', $data);
    }
    public function detail($id)
    {
        // Simulasikan data berita dari database
        $newsData = [
            1 => [
                'id' => 1,
                'title' => 'Judul Berita 1',
                'description' => 'Deskripsi berita 1.',
            ],
            2 => [
                'id' => 2,
                'title' => 'Judul Berita 2',
                'description' => 'Deskripsi berita 2.',
            ],
            // ...
        ];

        // Cek apakah ID berita tersedia dalam data berita
        if (array_key_exists($id, $newsData)) {
            $news = $newsData[$id];

            // Load view pages/berita_detail.php dan kirim data berita
            return view('pages/berita_detail', ['news' => $news]);
        } else {
            // Jika ID berita tidak ditemukan, tampilkan halaman 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
