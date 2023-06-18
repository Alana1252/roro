<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Authentication\LocalAuthenticator;

class UserController extends Controller
{
    public function index()
    {
        $auth = service('authentication');

        // Cek apakah pengguna sudah login
        if ($auth->check()) {
            // Dapatkan informasi pengguna yang sedang login
            $user = $auth->user();

            // Ambil data pengguna
            $userModel = new \Myth\Auth\Models\UserModel();
            $userData = $userModel->find($user->id);

            // Tampilkan halaman user.php dengan data pengguna
            $data = [
                'user' => $userData
            ];

            return view('pages/user', $data);
        } else {
            // Pengguna belum login, redirect ke halaman login
            return redirect()->to('/login');
        }
    }
}
