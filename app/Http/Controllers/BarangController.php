<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategoris;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategoris = Kategoris::all(); // Mengambil semua kategori dari database
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok_saat_ini' => 'required|integer',
            'id' => 'required|exists:kategoris,id',
        ]);
    
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok_saat_ini' => $request->stok_saat_ini,
            'id' => $request->id,
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }    

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategoris::all(); // Mengambil semua kategori untuk dropdown
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok_saat_ini' => 'required|integer',
            'id' => 'required|exists:kategoris,id',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok_saat_ini' => $request->stok_saat_ini,
            'id' => $request->id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id); // Temukan barang berdasarkan ID
        $barang->delete(); // Hapus barang

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
