<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController; //
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman & Proses Auth (Login/Register)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Beranda User (Dashboard)
Route::get('/beranda', [userDashboardController::class, 'index'])->name('user.dashboard');

Route::get('/admin/dashboard', [adminDashboardController::class, 'index'])
    ->name('admin.dashboard');
