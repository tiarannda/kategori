<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi; // Pastikan ada model Transaksi untuk transaksi
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total stok dari tabel barang
        $totalStock = Barang::sum('stok_saat_ini');

        // Mendapatkan tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Menghitung pendapatan bulan ini dari transaksi tipe 'jual'
        $pendapatanBulanIni = Transaksi::where('tipe_transaksi', 'jual')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Menghitung pengeluaran bulan ini dari transaksi tipe 'beli'
        $pengeluaranBulanIni = Transaksi::where('tipe_transaksi', 'beli')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        // Menghitung keuntungan bulan ini
        $untungBulanIni = $pendapatanBulanIni - $pengeluaranBulanIni;

        // Mengirimkan data ke view dashboard
        return view('dashboard.dashboard', [
            'totalStock' => $totalStock,
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'untungBulanIni' => $untungBulanIni
        ]);
    }
}

