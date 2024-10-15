<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategorisController; // Mengimpor KategoriController dengan benar
use App\Http\Controllers\BarangController;   // Mengimpor BarangController

// Route untuk halaman awal
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');




// Route untuk kategori
Route::get('/kategori', [KategorisController::class, 'index'])->name('kategoris.index'); // Menampilkan daftar kategori
Route::get('/kategori/create', [KategorisController::class, 'create'])->name('kategoris.create'); // Form tambah kategori
Route::post('/kategori', [KategorisController::class, 'store'])->name('kategoris.store'); // Simpan kategori baru
Route::get('/kategori/edit', [KategorisController::class, 'edit'])->name('kategoris.edit'); // Form edit kategori
Route::put('/kategori', [KategorisController::class, 'update'])->name('kategoris.update'); // Update kategori
Route::delete('/kategori/{kategori}', [KategorisController::class, 'destroy'])->name('kategoris.destroy');

// Route resource untuk barang

Route::resource('kategoris', KategorisController::class);



Route::resource('barang', BarangController::class); // Mengelola semua operasi CRUD untuk barang




