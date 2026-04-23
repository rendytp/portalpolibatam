<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller; // 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // Menampilkan halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // Memproses data Register (Membuat Akun)
    public function registerPost(Request $request)
    {
        // Validasi data
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed', // Harus cocok dengan password_confirmation
            'role' => 'required'
        ]);

        // Simpan ke database
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password diamankan (Hash)
            'role' => $request->role,
        ]);

        // Jika berhasil, arahkan ke halaman login
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // Memproses data Login (Masuk Aplikasi)
    public function loginPost(Request $request)
    {
        // Coba login dengan username dan password yang diinput
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

       // Jika cocok, arahkan ke beranda
        if (Auth::attempt($credentials)) {
            // Regenerate session adalah standar keamanan wajib di Laravel terbaru
            $request->session()->regenerate(); 
            
            // Arahkan ke rute 'beranda'
            return redirect()->route('beranda');
        }

        // Jika salah, kembalikan ke halaman login
        return back()->with('error', 'Username atau password salah.');
    }
}