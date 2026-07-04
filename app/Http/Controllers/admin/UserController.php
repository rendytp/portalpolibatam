<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $data = User::withCount('favorit as jumlah_bookmark')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users', compact('data'));
    }

    public function destroy(int $id): RedirectResponse
    {
        // Cegah admin menghapus akunnya sendiri
        if ($id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user = User::find($id);

        if (! $user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}