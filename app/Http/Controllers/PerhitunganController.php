<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Bobot;
use App\Models\Transaksi;
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
        $weights = Bobot::all()->pluck('bobot', 'kriteria')->toArray();
        // dd($weights);

        // Data maksimum dan minimum
        $maxHarga = Barang::max('harga');

        // Mengambil data barang masuk (tipe_transaksi = 'beli') dan barang keluar (tipe_transaksi = 'jual')
        $barangMasuk = Transaksi::where('tipe_transaksi', 'beli')
            ->selectRaw('id_barang, SUM(jumlah) as jumlah_barang')
            ->groupBy('id_barang')
            ->pluck('jumlah_barang', 'id_barang');

        $barangKeluar = Transaksi::where('tipe_transaksi', 'jual')
            ->selectRaw('id_barang, SUM(jumlah) as jumlah_barang')
            ->groupBy('id_barang')
            ->pluck('jumlah_barang', 'id_barang');

        $maxMasuk = $barangMasuk->min();
        $maxKeluar = $barangKeluar->max();

        // Proses perhitungan SAW
        $hasil = $barangs->map(function ($barang) use ($weights, $maxHarga, $barangMasuk, $barangKeluar, $maxMasuk, $maxKeluar) {
            $C1 = $maxHarga > 0 ? $barang->harga / $maxHarga : 0; // Normalisasi harga (maximize)
            $C2 = $minMasuk > 0 ? ($barangMasuk->get($barang->id_barang, 0) / $minMasuk) : 0; // Normalisasi barang masuk (maximize)
            $C3 = $maxKeluar > 0 ? ($barangKeluar->get($barang->id_barang, 0) / $maxKeluar) : 0; // Normalisasi barang keluar (maximize)

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
        // dd($hasil);

        return view('dashboard.tampilan', compact('hasil'));
    }
}
