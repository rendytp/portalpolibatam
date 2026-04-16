<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page/index');
});
Route::get('/login', function () {
    return view('landing_page/login');
});