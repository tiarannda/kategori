<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategoris;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Mengambil semua barang dengan relasi kategori
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        // Mengambil semua kategori untuk dropdown
        $kategoris = Kategoris::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok_saat_ini' => 'required|integer',
            'id' => 'required|exists:kategoris,id', // Validasi foreign key id kategori
        ]);

        // Membuat barang baru
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok_saat_ini' => $request->stok_saat_ini,
            'id' => $request->id, // Foreign key id kategori
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id_barang)
    {
        // Mengambil barang berdasarkan id_barang dengan relasi kategori
        $barang = Barang::with('kategori')->findOrFail($id_barang);
        return view('barang.show', compact('barang'));
    }

    public function edit($id_barang)
    {
        // Mengambil barang berdasarkan id_barang
        $barang = Barang::findOrFail($id_barang);
        // Mengambil semua kategori untuk dropdown
        $kategoris = Kategoris::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id_barang)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok_saat_ini' => 'required|integer',
            'id' => 'required|exists:kategoris,id', // Validasi foreign key id kategori
        ]);

        // Mengambil barang berdasarkan id_barang
        $barang = Barang::findOrFail($id_barang);
        // Update data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok_saat_ini' => $request->stok_saat_ini,
            'id' => $request->id, // Update foreign key id kategori
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id_barang)
    {
        // Mengambil barang berdasarkan id_barang
        $barang = Barang::findOrFail($id_barang);
        // Menghapus barang
        $barang->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
