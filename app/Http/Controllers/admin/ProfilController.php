<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.profil');
    }

    public function updateProfil(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique'   => 'Username sudah digunakan oleh akun lain.',
        ]);

        // Sebelumnya: DB::table('users')->where('id', $user->id)->update([...])
        // $user sudah berupa instance model User (dari Auth::user()), jadi
        // tinggal update() langsung. updated_at otomatis ditangani Eloquent.
        $user->update([
            'username' => $request->username,
        ]);

        return back()->with('success', 'Informasi profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:6',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required'         => 'Password baru wajib diisi.',
            'password.confirmed'        => 'Konfirmasi password baru tidak cocok.',
            'password.min'              => 'Password baru minimal harus 6 karakter.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
        }

        // Catatan: model User punya cast 'password' => 'hashed', jadi Hash::make()
        // di sini sebenarnya opsional (Laravel akan hash otomatis kalau nilainya
        // belum berbentuk hash). Tetap dipakai di sini agar konsisten & eksplisit.
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password akun berhasil diperbarui.');
    }
}