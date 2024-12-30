<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerhitunganController extends Controller
{
    public function hitungSAW(Request $request)
    {
        // Ambil data barang
        $barangs = Barang::all(); // Ambil semua data barang dari database

        // Tentukan bobot untuk masing-masing kriteria
        $bobot = [
            'C1' => 0.4,  // Bobot untuk harga
            'C2' => 0.3,  // Bobot untuk stok
            'C3' => 0.3,  // Bobot untuk total barang keluar
        ];

        // Pastikan $barangs tidak kosong
        if ($barangs->isEmpty()) {
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }

        // Menghitung skor SAW
        $hasil = $barangs->map(function ($barang) use ($bobot) {
            // Ambil nilai C3 dari tabel laporans berdasarkan id_barang
            $total_barang_keluar = Laporan::where('id_barang', $barang->id_barang)
                                          ->whereMonth('tanggal_laporan', request('month'))
                                          ->whereYear('tanggal_laporan', request('year'))
                                          ->sum('total_barang_keluar');

            // Max values for normalization
            $max_harga = Barang::max('harga');
            $min_stok = Barang::min('stok_saat_ini');
            $max_total_barang_keluar = Laporan::where('id_barang', $barang->id_barang)
                                              ->max('total_barang_keluar');

            // Normalisasi C1, C2, C3 dengan pengecekan nilai max > 0
            $C1_normalisasi = ($max_harga > 0) ? $barang->harga / $max_harga : 0;
            $C2_normalisasi = ($min_stok > 0) ? $barang->stok_saat_ini / $min_stok : 0;
            $C3_normalisasi = ($max_total_barang_keluar > 0) ? $total_barang_keluar / $max_total_barang_keluar : 0;

            // Menghitung skor SAW
            $skor_saw = $C1_normalisasi * $bobot['C1'] + $C2_normalisasi * $bobot['C2'] + $C3_normalisasi * $bobot['C3'];

            return [
                'nama' => $barang->nama_barang,
                'C1_normalisasi' => $C1_normalisasi,
                'C2_normalisasi' => $C2_normalisasi,
                'C3_normalisasi' => $C3_normalisasi,
                'skor_saw' => $skor_saw,
            ];
        });

        // Return hasil perhitungan ke view
        return view('dashboard.tampilan', compact('hasil'));
    }


}
