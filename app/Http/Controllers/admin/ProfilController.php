<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.profil');
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique'   => 'Username sudah digunakan oleh akun lain.',
        ]);

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'username'   => $request->username,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6', // Diubah menjadi minimal 6 karakter sesuai gambar
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required'         => 'Password baru wajib diisi.',
            'password.confirmed'        => 'Konfirmasi password baru tidak cocok.',
            'password.min'              => 'Password baru minimal harus 6 karakter.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password'   => Hash::make($request->password),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Password akun berhasil diperbarui.');
    }
}