<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $kategoris = kategori::all();
        return view('kategoris.index', compact('kategoris'));
    }

    // Menampilkan form untuk menambah kategori
    public function create()
    {
        return view('kategoris.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        kategori::create($request->all());
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    // Memperbarui kategori
    public function update(Request $request, kategori $kategori)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

