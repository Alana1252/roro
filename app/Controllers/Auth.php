<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Authentication\LocalAuthenticator;

class Auth extends Controller
{
    // ...

    public function logout()
    {
        $auth = service('authentication');
        $auth->logout();

        return redirect()->to('/login');
    }

    // ...
}
