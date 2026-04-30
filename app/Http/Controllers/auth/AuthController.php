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
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 ADMIN
            if ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard');
            }

            // 🔥 USER (mahasiswa, dosen, staff)
            if (in_array($user->role, ['Mahasiswa', 'Dosen', 'Staff'])) {
                return redirect()->route('user.dashboard');
            }

            // fallback kalau role tidak dikenali
            Auth::logout();
            return back()->with('error', 'Role tidak valid');
        }

        return back()->with('error', 'Username atau password salah.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // ⬅️ kembali ke login
    }
}
