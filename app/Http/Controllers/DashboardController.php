<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Laporan;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil bulan dan tahun dari query string atau default ke bulan dan tahun saat ini
        $month = $request->input('month', date('m'));  // Bulan saat ini, default ke bulan sekarang
        $year = $request->input('year', date('Y'));    // Tahun saat ini, default ke tahun sekarang

        // Total stok semua barang
        $totalStock = Barang::sum('stok_saat_ini');

        // Rentang waktu bulan ini
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Pendapatan bulan ini
        $pendapatanBulanIni = Transaksi::where('tipe_transaksi', 'jual')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Pengeluaran bulan ini
        $pengeluaranBulanIni = Transaksi::where('tipe_transaksi', 'beli')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Keuntungan bulan ini
        $untungBulanIni = $pendapatanBulanIni - $pengeluaranBulanIni;

        // Mendapatkan data laporan harian untuk grafik
        $laporanHarian = Laporan::select(
            DB::raw("DATE(tanggal_laporan) as tanggal"),
            DB::raw("SUM(total_pemasukan) as pemasukan"),
            DB::raw("SUM(total_pengeluaran) as pengeluaran")
        )
        ->whereBetween('tanggal_laporan', [$startOfMonth, $endOfMonth])
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->get();

        // Membuat label dan data untuk grafik berdasarkan 7 hari terakhir
        $labels = collect();
        $dataPemasukan = collect();
        $dataPengeluaran = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $laporan = $laporanHarian->firstWhere('tanggal', $date);

            $labels->push($date);
            $dataPemasukan->push($laporan ? $laporan->pemasukan : 0);
            $dataPengeluaran->push($laporan ? $laporan->pengeluaran : 0);
        }

        // Mengambil data barang dan total penjualan untuk perhitungan SAW
        $barangs = Barang::all();

        // Ambil total penjualan berdasarkan laporan bulan dan tahun yang dipilih
        $laporanData = Laporan::selectRaw('id_barang, SUM(total_barang_keluar) AS total_barang_keluar')
            ->whereMonth('tanggal_laporan', $month)
            ->whereYear('tanggal_laporan', $year)
            ->groupBy('id_barang')
            ->get()
            ->keyBy('id_barang')
            ->map(function ($laporan) {
                return $laporan->total_barang_keluar;
            });

        // Data untuk perhitungan SAW
        $hasil = $barangs->map(function ($barang) use ($laporanData) {
            // Asumsi C1, C2, dan C3 adalah beberapa kriteria yang sudah dihitung sebelumnya
            $C1_normalisasi = $barang->stok_saat_ini / Barang::max('stok_saat_ini');  // Normalisasi C1
            $C2_normalisasi = $barang->harga / Barang::max('harga');  // Normalisasi C2
            $C3_normalisasi = $laporanData->get($barang->id_barang, 0) / $laporanData->max();  // Normalisasi C3 berdasarkan penjualan

            // Menghitung skor SAW
            $skor_saw = $C1_normalisasi * 0.4 + $C2_normalisasi * 0.3 + $C3_normalisasi * 0.3;

            return [
                'nama' => $barang->nama_barang,
                'C1_normalisasi' => $C1_normalisasi,
                'C2_normalisasi' => $C2_normalisasi,
                'C3_normalisasi' => $C3_normalisasi,
                'skor_saw' => $skor_saw,
            ];
        });

        // Data warna untuk grafik
        $warnaPemasukan = 'rgba(75, 192, 192, 0.2)';
        $warnaPengeluaran = 'rgba(255, 99, 132, 0.2)';

        return view('dashboard.dashboard', [
            'totalStock' => $totalStock,
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'untungBulanIni' => $untungBulanIni,
            'labels' => $labels,
            'dataPemasukan' => $dataPemasukan,
            'dataPengeluaran' => $dataPengeluaran,
            'warnaPemasukan' => $warnaPemasukan,
            'warnaPengeluaran' => $warnaPengeluaran,
            'hasil' => $hasil, // Menambahkan hasil perhitungan SAW
            'month' => $month,
            'year' => $year
        ]);
    }

}
