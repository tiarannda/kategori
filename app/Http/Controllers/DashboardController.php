<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total stok dari tabel barang
        $totalStock = Barang::sum('stok_saat_ini');

        // Mengirimkan total stok ke view dashboard
        return view('dashboard.dashboard', ['totalStock' => $totalStock]);
    }
}
