<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Mengambil semua kategori dari database
        return view('kategoris.index', compact('kategoris')); // Mengirim data ke tampilan
    }

    public function create()
    {
        return view('kategoris.create'); // Mengembalikan tampilan untuk membuat kategori baru
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required', // Memastikan kolom nama tidak kosong
        ]);

        Kategori::create($request->all()); // Membuat kategori baru berdasarkan input
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dibuat.'); // Mengalihkan kembali ke index dengan pesan sukses
    }

    public function show(Kategori $kategori)
    {
        return view('kategoris.show', compact('kategori')); // Mengembalikan tampilan dengan detail kategori
    }

    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori')); // Mengembalikan tampilan edit dengan data kategori
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required', // Memastikan kolom nama tidak kosong
        ]);

        $kategori->update($request->all()); // Memperbarui kategori dengan data baru
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.'); // Mengalihkan kembali ke index dengan pesan sukses
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete(); // Menghapus kategori dari database
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.'); // Mengalihkan kembali ke index dengan pesan sukses
    }
}
