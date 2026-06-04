<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORT CONTROLLER USER & AUTH (Pastikan folder huruf kecil sesuai strukturmu)
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;
// Kita beri nama alias "UserDashboardController"
use App\Http\Controllers\user\DashboardController as UserDashboardController; 

// 2. IMPORT CONTROLLER ADMIN
// Kita beri nama alias "AdminDashboardController"
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LayananController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LinkController;


// ==========================================
// RUTE GUEST (Belum Login)
// ==========================================

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman & Proses Auth (Login/Register)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// RUTE USER (Wajib Login)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // PERHATIKAN: Sekarang kita menggunakan UserDashboardController
    Route::get('/beranda', [UserDashboardController::class, 'index'])->name('beranda');
    Route::get('/cari-layanan', [UserDashboardController::class, 'cari'])->name('cari');
    Route::get('/favorit-saya', [UserDashboardController::class, 'favorit'])->name('favorit');
    
    Route::get('/custom-links', [UserDashboardController::class, 'customLinks'])->name('custom.links');
    Route::post('/custom-links', [UserDashboardController::class, 'storeCustomLink'])->name('custom.links.store');
    
    Route::get('/profil-saya', [UserDashboardController::class, 'profil'])->name('profil');
});


// ==========================================
// RUTE ADMIN
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    // PERHATIKAN: Sekarang kita menggunakan AdminDashboardController
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // LAYANAN
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.delete');

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    // LINKS
    Route::get('/links', [LinkController::class, 'index'])->name('links');
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
    Route::delete('/links/{id}', [LinkController::class, 'destroy'])->name('links.delete');
});