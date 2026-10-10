<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\KeranjangController;

Route::get('/', [TokoController::class, 'index'])->name('toko.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/toko/tambah/{id}', [KeranjangController::class, 'tambah'])->name('toko.tambah');
    Route::post('/toko/kurang/{id}', [KeranjangController::class, 'kurang'])->name('toko.kurang');
    Route::post('/toko/hapus/{id}', [KeranjangController::class, 'hapus'])->name('toko.hapus');
    Route::post('/toko/checkout', [KeranjangController::class, 'checkout'])->name('toko.checkout');

    Route::get('/riwayat', [KeranjangController::class, 'riwayat'])->name('riwayat');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
