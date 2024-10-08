<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class controllerKategori extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori
        $kategori = Kategori::getKategori();
        return view('kategori.index', compact('kategori'));
    }

    public function takeId($id)
    {
        // Mengambil satu data kategori berdasarkan ID
        $kategori = Kategori::getKategoriId($id);
        return view('kategori.edit', compact('kategori')); // Mengarahkan ke view edit
    }

    public function create()
    {
        return view('kategori.create'); // Menampilkan form untuk menambah kategori
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Menyimpan data kategori baru
        $data = ['nama' => $request->input('nama')];
        Kategori::addKategori($data);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update data kategori
        $data = ['nama' => $request->input('nama')];
        Kategori::updateKategori($id, $data);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kategori::deleteKategori($id);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
