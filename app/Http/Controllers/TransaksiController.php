<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        // tampilkan semua transaksi
        $transaksis = Transaksi::with('barang')->get();
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        // form menambahkan transaksi
        $barangs = Barang::all();
        return view('transaksis.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        // simpan transaksi baru
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang', 
            'jumlah_barang' => 'required|integer|min:1',
            'tipe_transaksi' => 'required|in:jual,beli',
        ]);

        // Fetch the selected item
        $barang = Barang::findOrFail($request->id_barang);
        $totalHarga = $barang->harga * $request->jumlah_barang;

        // Update stock based on transaction type
        if ($request->tipe_transaksi === 'jual') {
            if ($barang->stok_saat_ini >= $request->jumlah_barang) {
                $barang->stok_saat_ini -= $request->jumlah_barang; // Reduce stock
            } else {
                return redirect()->back()->withErrors(['jumlah_barang' => 'Stok tidak cukup.']);
            }
        } elseif ($request->tipe_transaksi === 'beli') {
            $barang->stok_saat_ini += $request->jumlah_barang; // Increase stock
        }

        // Save updated stock
        $barang->save();

        // Save the transaction
        Transaksi::create([
            'id_barang' => $request->id_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $totalHarga,
            'tanggal' => now(), // Simpan tanggal saat ini
            'tipe_transaksi' => $request->tipe_transaksi,
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // tampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('barang')->findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    // form mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all();
        return view('transaksis.edit', compact('transaksi', 'barangs'));
    }

    // update transaksi yg ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id_barang',
            'jumlah_barang' => 'required|integer|min:1',
            'tipe_transaksi' => 'required|in:jual,beli',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $barang = Barang::findOrFail($request->id_barang);

        // Revert previous stock change before applying new one
        if ($transaksi->tipe_transaksi === 'jual') {
            $barang->stok_saat_ini += $transaksi->jumlah_barang; // Restore stock for sale
        } elseif ($transaksi->tipe_transaksi === 'beli') {
            $barang->stok_saat_ini -= $transaksi->jumlah_barang; // Restore stock for purchase
        }

        // Apply new stock adjustment based on the updated transaction type
        if ($request->tipe_transaksi === 'jual') {
            if ($barang->stok_saat_ini >= $request->jumlah_barang) {
                $barang->stok_saat_ini -= $request->jumlah_barang; // Reduce stock for sale
            } else {
                return redirect()->back()->withErrors(['jumlah_barang' => 'Stok tidak cukup.']);
            }
        } elseif ($request->tipe_transaksi === 'beli') {
            $barang->stok_saat_ini += $request->jumlah_barang; // Increase stock for purchase
        }

        // Save updated stock and transaction
        $barang->save();
        $transaksi->update([
            'id_barang' => $request->id_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $barang->harga * $request->jumlah_barang,
            'tanggal' => now(), // Update jika perlu
            'tipe_transaksi' => $request->tipe_transaksi,
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barang = $transaksi->barang;

        // Revert stock change based on transaction type before deleting
        if ($transaksi->tipe_transaksi === 'jual') {
            $barang->stok_saat_ini += $transaksi->jumlah_barang; // Restore stock for sale
        } elseif ($transaksi->tipe_transaksi === 'beli') {
            $barang->stok_saat_ini -= $transaksi->jumlah_barang; // Restore stock for purchase
        }

        $barang->save();
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
