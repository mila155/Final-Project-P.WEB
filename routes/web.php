<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return view('landing', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('landing', ['title' => 'About Page']);
});

Route::get('/cart', function () {
    return view('cart',['title' => 'Cart Page']);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/product', [ProdukController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProdukController::class, 'show'])->name('detail');

Route::get('/admin/produk', [ProdukController::class, 'adminindex'])->name('index');
Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/admin/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/admin/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

Route::get('/admin/stok/history', [StokController::class, 'history'])->name('stok.history');
Route::get('/admin/stok/create', [StokController::class, 'create'])->name('stok.create');
Route::post('/admin/stok', [StokController::class, 'store'])->name('stok.store');
Route::get('/admin/stok/report', [StokController::class, 'report'])->name('stok.report');
Route::post('/admin/stok/export-pdf', [StokController::class, 'exportPdf'])->name('stok.exportPdf');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admin/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admin/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/admin/admins/{user}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admin/admins/{user}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admin/admins/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::post('/payments/initiate', [PaymentController::class, 'initiatePayment'])->name('payments.initiate');
// });
// Route::post('/payments/midtrans-notification', [PaymentController::class, 'handleCallback'])->name('payments.notification');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


Route::get('/checkout', [CheckoutController::class, 'showForm'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');


Route::prefix('admin')->group(function () {
    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('admin.keuangan.index');
    Route::get('/keuangan/export/pdf', [KeuanganController::class, 'exportPdf'])->name('admin.keuangan.export.pdf');
    Route::get('/keuangan/export/excel', [KeuanganController::class, 'exportExcel'])->name('admin.keuangan.export.excel');
});