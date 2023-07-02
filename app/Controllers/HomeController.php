<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $auth = service('authentication');

        // Cek apakah pengguna sudah login
        $isLoggedIn = $auth->check();
        $userImage = ($isLoggedIn) ? $auth->user()->user_img : '';

        // Tampilkan halaman home.php dengan data isLoggedIn dan userImage
        return view('pages/home', [
            'isLoggedIn' => $isLoggedIn,
            'userImage' => $userImage
        ]);
    }
}
