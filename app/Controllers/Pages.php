<?php

namespace App\Controllers;
use App\Models\News_model;
class Pages extends BaseController
{
   
    public function login()
    {
        $data = [
            'title' => 'Home | Halaman Utama'
        ];
        // return view('pages/home', $data);
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Home | Halaman Utama'
        ];
        // return view('pages/home', $data);
        return view('auth/register', $data);
    }

    public function user()
    {
        return view('user/index');
    }
}
