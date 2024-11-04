<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Tampilkan semua laporan dengan view
    public function index()
    {
        // Ambil semua data laporan dengan relasi user dan barang
        $laporans = Laporan::with('barang')->get();

        // Kirim data laporan ke view laporans.index
        return view('laporans.index', compact('laporans'));
    }

    // Tampilkan formulir tambah laporan
    public function create()
    {
        // Ambil data pengguna dan barang untuk dropdown
       
        $barangs = Barang::all();

        // Kirim data ke view create
        return view('laporans.create', compact('barangs'));
    }

    // Tampilkan laporan berdasarkan ID
    public function show($id_laporan)
    {
        // Cari laporan berdasarkan ID, termasuk relasi user dan barang
        $laporan = Laporan::with('barang')->find($id_laporan);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        // Kirim data laporan spesifik ke view untuk detail
        return view('laporans.show', compact('laporan'));
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'tanggal_laporan' => 'required|date',
            'total_pemasukan' => 'required|numeric|min:0',
            'total_penjualan' => 'required|numeric|min:0',
            'total_barang_keluar' => 'required|integer|min:0',
            'total_barang_masuk' => 'required|integer|min:0',
           
            'id_barang' => 'required|exists:barangs,id',
        ]);

        // Simpan laporan baru ke database
        $laporan = Laporan::create($request->all());

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    // Update laporan berdasarkan ID
    public function update(Request $request, $id_laporan)
    {
        // Cari laporan berdasarkan ID
        $laporan = Laporan::find($id_laporan);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        // Validasi data input
        $request->validate([
            'tanggal_laporan' => 'required|date',
            'total_pemasukan' => 'required|numeric|min:0',
            'total_penjualan' => 'required|numeric|min:0',
            'total_barang_keluar' => 'required|integer|min:0',
            'total_barang_masuk' => 'required|integer|min:0',
          
            'id_barang' => 'required|exists:barangs,id',
        ]);

        // Update laporan yang ditemukan
        $laporan->update($request->all());

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil diperbarui');
    }

    // Hapus laporan berdasarkan ID
    public function destroy($id_laporan)
    {
        // Cari laporan berdasarkan ID
        $laporan = Laporan::find($id_laporan);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }

        // Hapus laporan yang ditemukan
        $laporan->delete();

        // Redirect ke halaman laporan dengan pesan sukses
        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dihapus');
    }
}
