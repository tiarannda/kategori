<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Total stok semua barang
        $totalStock = Barang::sum('stok_saat_ini');

        // Rentang waktu bulan ini
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

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
            'warnaPemasukan' => $warnaPemasukan,  // Hardcoded here
            'warnaPengeluaran' => $warnaPengeluaran,  // Hardcoded here
        ]);

    }
}
