<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');
Route::get('/login', function () {
    return view('auth/Login');
})->name('login');

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/register', function (Request $request) {

    User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login');
})->name('register');
