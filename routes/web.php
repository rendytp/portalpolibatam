<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController; //
use App\Http\Controllers\user\DashboardController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman & Proses Auth (Login/Register)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

// Halaman Beranda User (Dashboard)
Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');