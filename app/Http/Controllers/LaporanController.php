<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua laporan yang sudah ada
        $laporans = Laporan::all();
        return view('laporans.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporans.create');
    }

    public function store(Request $request)
    {
        // Ambil data dari tabel transaksi berdasarkan tanggal yang dipilih
        $tanggal = $request->input('tanggal_laporan');

        // Mengambil transaksi yang terjadi pada tanggal yang dipilih
        $transaksis = Transaksi::whereDate('tanggal', $tanggal)->get();

        // Menghitung total pemasukan dan pengeluaran berdasarkan transaksi
        $total_pemasukan = number_format($transaksis->where('tipe_transaksi', 'jual')->sum('total_harga'), 3, '.', '');
        $total_pengeluaran = number_format($transaksis->where('tipe_transaksi', 'beli')->sum('total_harga'), 3, '.', '');

        // Menghitung total barang keluar dan barang masuk
        $total_barang_keluar = $transaksis->where('tipe_transaksi', 'jual')->sum('jumlah_barang');
        $total_barang_masuk = $transaksis->where('tipe_transaksi', 'beli')->sum('jumlah_barang');

        // Simpan laporan yang baru
        $laporan = Laporan::create([
            'tanggal_laporan' => $tanggal,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'total_barang_keluar' => $total_barang_keluar,
            'total_barang_masuk' => $total_barang_masuk,
            'id_user' => auth()->user()->id,
        ]);

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show($id)
    {
        // Menampilkan detail laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);
        return view('laporans.show', compact('laporan'));
    }

    public function destroy($id)
    {
        // Menghapus laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
