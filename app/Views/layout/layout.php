<?php

use Myth\Auth\Authentication\LocalAuthenticator;

// Dapatkan instance dari LocalAuthenticator
$auth = new LocalAuthenticator();

// Cek apakah pengguna sudah login
if ($auth->check()) {
    // Pengguna sudah login
    $isLoggedIn = true;
    
    // Dapatkan informasi pengguna yang sedang login
    $userId = $auth->user()->id;
    $userEmail = $auth->user()->email;
    // ... dapatkan data lainnya yang diperlukan
} else {
    // Pengguna belum login
    $isLoggedIn = false;
}

// ...

// Tampilkan tombol login atau logout
if ($isLoggedIn) {
    // Pengguna sudah login, tampilkan tombol logout
    echo '<a href="/logout">Logout</a>';
    echo '<span>' . $userEmail . '</span>';
} else {
    // Pengguna belum login, tampilkan tombol login
    echo '<a href="/login">Login</a>';
}

?>
