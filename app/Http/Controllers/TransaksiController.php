<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua transaksi beserta relasi barang
        $transaksis = Transaksi::with('barang')->get();
        return view('transaksis.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data barang untuk dropdown
        $barangs = Barang::all();
        return view('transaksis.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang', // Pastikan id_barang ada di tabel barangs
            'jumlah_barang' => 'required|integer|min:1',
            'tipe_transaksi' => 'required|in:jual,beli',
        ]);

        // Ambil barang berdasarkan id_barang
        $barang = Barang::findOrFail($request->id_barang);
        $totalHarga = $barang->harga * $request->jumlah_barang;

        // Menambah atau mengurangi stok berdasarkan tipe transaksi
        if ($request->tipe_transaksi === 'jual') {
            if ($barang->stok_saat_ini >= $request->jumlah_barang) {
                // Kurangi stok
                $barang->stok_saat_ini -= $request->jumlah_barang;
            } else {
                return redirect()->back()->withErrors(['jumlah_barang' => 'Stok tidak cukup.']);
            }
        } elseif ($request->tipe_transaksi === 'beli') {
            // Tambah stok
            $barang->stok_saat_ini += $request->jumlah_barang;
        }

        // Simpan perubahan stok barang
        $barang->save();

        // Simpan transaksi baru
        Transaksi::create([
            'id_barang' => $request->id_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $totalHarga,
            'tanggal_transaksi' => now(),
            'tipe_transaksi' => $request->tipe_transaksi,
        ]);

        // Redirect kembali ke halaman index transaksi dengan pesan sukses
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil transaksi berdasarkan ID dengan relasi barang
        $transaksi = Transaksi::with('barang')->findOrFail($id);

        // Return ke view show dengan transaksi yang dipilih
        return view('transaksis.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil transaksi dan barang untuk diedit
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all();

        return view('transaksis.edit', compact('transaksi', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_barang' => 'required|integer|min:1',
            'tipe_transaksi' => 'required|in:jual,beli',
        ]);

        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
        $barang = Barang::findOrFail($request->id_barang);

        // Perubahan stok berdasarkan tipe transaksi
        if ($transaksi->tipe_transaksi === 'jual') {
            // Kembalikan stok barang sebelum transaksi
            $barang->stok += $transaksi->jumlah_barang;
        } elseif ($transaksi->tipe_transaksi === 'beli') {
            $barang->stok -= $transaksi->jumlah_barang;
        }

        if ($request->tipe_transaksi === 'jual') {
            if ($barang->stok >= $request->jumlah_barang) {
                $barang->stok -= $request->jumlah_barang;
            } else {
                return redirect()->back()->withErrors(['jumlah_barang' => 'Stok tidak cukup.']);
            }
        } elseif ($request->tipe_transaksi === 'beli') {
            $barang->stok += $request->jumlah_barang;
        }

        // Update barang stok
        $barang->save();

        // Update transaksi
        $transaksi->update([
            'id_barang' => $request->id_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $barang->harga * $request->jumlah_barang,
            'tipe_transaksi' => $request->tipe_transaksi,
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus transaksi
        $transaksi = Transaksi::findOrFail($id);
        $barang = $transaksi->barang;

        // Kembalikan stok berdasarkan tipe transaksi
        if ($transaksi->tipe_transaksi === 'jual') {
            $barang->stok += $transaksi->jumlah_barang;
        } elseif ($transaksi->tipe_transaksi === 'beli') {
            $barang->stok -= $transaksi->jumlah_barang;
        }

        // Simpan stok setelah penghapusan
        $barang->save();

        // Hapus transaksi
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
