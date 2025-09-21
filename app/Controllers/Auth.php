<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        // Redirect to login page
        return $this->login();
    }

    public function login()
    {
        // Display the login view
        return view('auth/login');
    }

    public function authenticate()
    {
        // Handle login authentication
        // For now, just redirect to dashboard
        return redirect()->to('/Dashboard');
    }

    public function logout()
    {
        // Handle logout
        return redirect()->to('/');
    }
}