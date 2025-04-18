<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DetailPembelianController;

// Basic routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Add these routes inside the auth middleware group
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);

    // Product routes
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::patch('/product/{product}/update-stock', [ProductController::class, 'updateStock'])->name('product.update-stock');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // User management routes (only accessible by a
    // Route Pembelian
    Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
    Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::get('/pembelian/{pembelian}', [PembelianController::class, 'show'])->name('pembelian.show');
    Route::post('/pembelian/confirm', [PembelianController::class, 'confirm'])->name('pembelian.confirm');
    Route::post('/pembelian/member-info', [PembelianController::class, 'memberInfo'])->name('pembelian.member-info');
    Route::post('/pembelian/non-member/pembayaran', [PembelianController::class, 'pembayaranNonMember'])->name('pembelian.non-member.pembayaran');
    Route::post('/pembelian/pembayaran', [PembelianController::class, 'pembayaran'])->name('pembelian.pembayaran');
    Route::get('/check-member/{phone}', [PembelianController::class, 'checkMember']);
    Route::get('/pembelian/detail/{pembelian}', [PembelianController::class, 'detail'])->name('pembelian.detail');
    // Route::get('/pembelian/{pembelian}/detail', [PembelianController::class, 'detail'])->name('pembelian.detail');
    Route::get('/pembelian/{id}/detail-html', [DetailPembelianController::class, 'ajaxDetailHTML']);

});