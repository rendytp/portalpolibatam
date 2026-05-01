<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\auth\AuthController; //
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

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LinkController;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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