<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');