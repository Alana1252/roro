<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Authentication\LocalAuthenticator;

class AuthController extends Controller
{
    public function login()
    {
        $auth = new LocalAuthenticator();
        
        // Lakukan validasi login di sini
        
        // Contoh validasi sederhana
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        if ($auth->attempt(['email' => $email, 'password' => $password])) {
            // Login berhasil
            return redirect()->to('/dashboard');
        } else {
            // Login gagal
            return redirect()->back()->with('error', 'Login failed');
        }
    }
    
    public function logout()
    {
        $auth = new LocalAuthenticator();
        $auth->logout();
        
        return redirect()->to('/');
    }
}
