<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategorisController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\KaryawanMiddleware;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DropboxController;

// Route untuk halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Route resource untuk kategori
Route::resource('kategoris', KategorisController::class);

// Route resource untuk barang
Route::resource('barang', BarangController::class);
Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');

// Route resource untuk transaksi
Route::resource('transaksis', TransaksiController::class);
Route::get('/transaksis/{id}', [TransaksiController::class, 'show'])->name('transaksis.show');
Route::delete('/transaksis/{id}', [TransaksiController::class, 'destroy'])->name('transaksis.destroy');
Route::put('/transaksis/{transaksi}', [TransaksiController::class, 'update'])->name('transaksis.update');
Route::get('/transaksis/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksis.edit');
Route::post('/transaksis', [TransaksiController::class, 'store'])->name('transaksis.store');



//Route resource untuk akun
Route::resource('users', UserController::class)->middleware('auth');
Route::put('/users/{id_user}', [UserController::class, 'update'])->name('users.update');


// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route resource untuk laporan
Route::resource('laporans', LaporanController::class);
Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');


Route::post('/laporans/send-to-dropbox', [LaporanController::class, 'sendLaporanToDropbox'])->name('laporans.sendToDropbox');

// route tes

Route::get('/dropbox/authorize', [DropboxController::class, 'authorize'])->name('dropbox.authorize');
Route::get('/dropbox/callback', [DropboxController::class, 'callback'])->name('dropbox.callback');
Route::get('/laporan', [DropboxController::class, 'listFiles'])->name('laporan.index');



