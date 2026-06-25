<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->leftJoin('user_favorit', 'users.id', '=', 'user_favorit.id_user')
            ->select('users.*', DB::raw('COUNT(user_favorit.id) as jumlah_bookmark'))
            ->groupBy(
                'users.id',
                'users.nama',
                'users.username',
                'users.password',
                'users.role',
                'users.remember_token',
                'users.created_at',
                'users.updated_at'
            )
            ->orderBy('users.created_at', 'desc')
            ->get();

        return view('admin.users', compact('data'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'User dihapus');
    }
}