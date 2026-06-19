<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORT CONTROLLER USER & AUTH
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\auth\AuthController;
// Kita beri nama alias "UserDashboardController"
use App\Http\Controllers\user\DashboardController as UserDashboardController;

// 2. IMPORT CONTROLLER ADMIN
// Kita beri nama alias "AdminDashboardController"
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LayananController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LinkController;
use App\Http\Controllers\admin\ProfilController; // Pastikan 'admin' huruf kecil agar sama dengan yang lain


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
    Route::get('/beranda', [UserDashboardController::class, 'index'])->name('beranda');
    Route::post('/favorit/{id}/toggle', [UserDashboardController::class, 'toggleFavorit'])->name('favorit.toggle');
    Route::get('/cari-layanan', [UserDashboardController::class, 'cari'])->name('cari');
    Route::get('/favorit-saya', [UserDashboardController::class, 'favorit'])->name('favorit');

    // PERBAIKAN CUSTOM LINKS: Menambahkan rute Update (PUT) dan Delete (DELETE)
    Route::get('/custom-links', [UserDashboardController::class, 'customLinks'])->name('custom.links');
    Route::post('/custom-links', [UserDashboardController::class, 'storeCustomLink'])->name('custom.links.store');
    Route::put('/custom-links/{id}', [UserDashboardController::class, 'updateCustomLink'])->name('custom.links.update');
    Route::delete('/custom-links/{id}', [UserDashboardController::class, 'deleteCustomLink'])->name('custom.links.delete');

    // TAMPILAN PROFIL & PROSES UPDATE PROFIL USER
    Route::get('/profil-saya', [UserDashboardController::class, 'profil'])->name('profil');
    Route::put('/profil-saya/update', [UserDashboardController::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil-saya/password', [UserDashboardController::class, 'updatePassword'])->name('profil.password');
});


// ==========================================
// RUTE ADMIN (HANYA ADMIN)
// ==========================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // LAYANAN
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{id}', [LayananController::class, 'destroy'])->name('layanan.delete');

        // KATEGORI
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');

        // USERS
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

        // LINKS
        Route::get('/links', [LinkController::class, 'index'])->name('links');
        Route::post('/links', [LinkController::class, 'store'])->name('links.store');
        Route::put('/links/{id}', [LinkController::class, 'update'])->name('links.update');
        Route::delete('/links/{id}', [LinkController::class, 'destroy'])->name('links.delete');

        // PROFIL
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
        Route::put('/profil/update', [ProfilController::class, 'updateProfil'])->name('profil.update');
        Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
    });