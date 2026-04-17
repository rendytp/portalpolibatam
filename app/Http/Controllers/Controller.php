<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    // Menampilkan Landing Page
    public function landing()
    {
        return view('landing');
    }

    // Menampilkan Halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // Menampilkan Halaman Registrasi
    public function register()
    {
        return view('auth.register');
    }

    // --- Logika Proses (Bisa disesuaikan dengan kebutuhan backend Anda) ---
    public function processLogin(Request $request) {
        // Logika autentikasi...
        return back();
    }

    public function processRegister(Request $request) {
        // Logika simpan data...
        return back();
    }
}