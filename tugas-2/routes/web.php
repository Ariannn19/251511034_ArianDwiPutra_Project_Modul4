<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/tambah-qty/{id}', [KeranjangController::class, 'tambahQty'])->name('keranjang.tambahQty');
Route::post('/keranjang/kurang-qty/{id}', [KeranjangController::class, 'kurangQty'])->name('keranjang.kurangQty');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');
