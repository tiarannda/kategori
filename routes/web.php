<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controllerKategori;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kategori', [controllerKategori::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [controllerKategori::class, 'create'])->name('kategori.create');
Route::post('/kategori', [controllerKategori::class, 'store'])->name('kategori.store');
Route::get('/kategori/{id}/edit', [controllerKategori::class, 'takeId'])->name('kategori.edit'); // Arahkan ke edit
Route::put('/kategori/{id}', [controllerKategori::class, 'update'])->name('kategori.update'); // Gunakan PUT untuk update
Route::delete('/kategori/{id}', [controllerKategori::class, 'destroy'])->name('kategori.destroy'); // Gunakan DELETE untuk delete
