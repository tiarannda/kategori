<?php

namespace App\Http\Controllers;

use App\Models\Kategoris;
use Illuminate\Http\Request;

class KategorisController extends Controller
{
    public function index()
    {
        $kategoris = Kategoris::all(); // Mengambil semua kategori dari database
        return view('kategoris.index', compact('kategoris')); // Mengirim data ke tampilan
    }

    public function create()
    {
        return view('kategoris.create'); // Mengembalikan tampilan untuk membuat kategori baru
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', // Mengubah ke 'nama' sesuai dengan kolom di database
        ]);

        Kategoris::create($request->only('name')); // Membuat kategori baru berdasarkan input
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dibuat.'); // Mengarahkan kembali ke index dengan pesan sukses
    }

    public function show(Kategoris $kategori)
{
    return view('kategoris.show', compact('kategori')); // Pastikan 'kategori' dalam bentuk tunggal di sini
}


    public function edit(Kategoris $kategori)
    {
        return view('kategoris.edit', compact('kategori')); // Mengembalikan tampilan edit dengan data kategori
    }

    public function update(Request $request, Kategoris $kategori)
    {
        \Log::info('Data yang diterima:', $request->all());
        $request->validate([
            'name' => 'required', // Mengubah ke 'nama' sesuai dengan kolom di database
        ]);

        $kategori->update($request->only('name'));// Memperbarui kategori dengan data baru
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.'); // Mengarahkan kembali ke index dengan pesan sukses
    }

    public function destroy(Kategoris $kategori)
    {
        $kategori->delete(); // Menghapus kategori dari database
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.'); // Mengarahkan kembali ke index dengan pesan sukses
    }
}
