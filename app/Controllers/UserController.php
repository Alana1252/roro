<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Myth\Auth\Authentication\LocalAuthenticator;

class UserController extends Controller
{
    public function index()
    {
        $auth = service('authentication');

        // Check if the user is already logged in
        if ($auth->check()) {
            // Get the currently logged-in user
            $user = $auth->user();

            // Retrieve the user ID
            $userId = $user->id;

            // Load the user model
            $userModel = new \App\Models\UserModel();

            // Retrieve the user data by user ID
            $userData = $userModel->find($userId);

            // Set the user's name in a session variable
            session()->set('user_name', $userData['name']);

            // Pass the user data to the view
            $data = [
                'user' => $userData
            ];

            return view('pages/user', $data);
        } else {
            // User is not logged in, redirect to the login page
            return redirect()->to('/login');
        }
    }
}
