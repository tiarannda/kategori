<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laporan;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function hitungSAW(Request $request)
    {
        $barangs = Barang::all();
        if ($barangs->isEmpty()) {
            return response()->json(['message' => 'Data barang tidak ditemukan'], 404);
        }

        // Bobot kriteria
        $weights = ['C1' => 0.5, 'C2' => 0.3, 'C3' => 0.2];

        // Data maksimum dan minimum
        $maxHarga = Barang::max('harga');
        $minStok = Barang::min('stok_saat_ini');
        $laporan = Laporan::selectRaw('id_barang, SUM(total_barang_keluar) as total')
        ->groupBy('id_barang')
        ->pluck('total', 'id_barang');

        $maxLaporan = $laporan->max();
        // dd($maxHarga, $minStok, $maxLaporan);

        // Proses perhitungan SAW
        $hasil = $barangs->map(function ($barang) use ($weights, $maxHarga, $minStok, $laporan, $maxLaporan) {
            $C1 = $maxHarga > 0 ? $barang->harga / $maxHarga : 0; // Normalisasi harga (maximize)
            $C2 = $minStok > 0 ? $minStok / $barang->stok_saat_ini : 0; // Normalisasi stok (minimize)
            $C3 = $maxLaporan > 0 ? ($laporan->get($barang->id_barang, 0) / $maxLaporan) : 0; // Normalisasi laporan (maximize)

            $score = $C1 * $weights['C1'] + $C2 * $weights['C2'] + $C3 * $weights['C3'];

            return [
                'nama' => $barang->nama_barang,
                'C1' => $C1,
                'C2' => $C2,
                'C3' => $C3,
                'score' => $score,
            ];
        });

        $hasil = $hasil->sortByDesc('score');
        dd($hasil);

        return view('dashboard.tampilan', compact('hasil'));
    }
}
