<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data = User::latest()->get();
        return view('admin.users', compact('data'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'User dihapus');
    }
}