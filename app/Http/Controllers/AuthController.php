<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Hapus tulisan "extends Controller" di bawah ini
class AuthController
{
    public function landing()
    {
        return view('landing');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}