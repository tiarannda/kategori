<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategorisController; // Mengimpor KategoriController dengan benar
use App\Http\Controllers\BarangController;   // Mengimpor BarangController
use App\Http\Controllers\DashboardController; // Mengimpor DashboardController
use App\Http\Controllers\TransaksiController;

// Route untuk halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk kategori
Route::get('/kategori', [KategorisController::class, 'index'])->name('kategoris.index'); // Menampilkan daftar kategori
Route::get('/kategori/create', [KategorisController::class, 'create'])->name('kategoris.create'); // Form tambah kategori
Route::post('/kategori', [KategorisController::class, 'store'])->name('kategoris.store'); // Simpan kategori baru
Route::get('/kategori/edit', [KategorisController::class, 'edit'])->name('kategoris.edit'); // Form edit kategori
Route::put('/kategori', [KategorisController::class, 'update'])->name('kategoris.update'); // Update kategori
Route::delete('/kategori/{kategori}', [KategorisController::class, 'destroy'])->name('kategoris.destroy');

// Route resource untuk kategori
Route::resource('kategoris', KategorisController::class);

// Route resource untuk barang
Route::resource('barang', BarangController::class); // Mengelola semua operasi CRUD untuk barang

Route::resource('transaksis', TransaksiController::class);
// Route::get('/transaksis/create', [TransaksiController::class, 'create'])-name('transaksis.create');
// Route::post('/transaksis', [TransaksiController::class, 'store'])-name('transaksis.store');

