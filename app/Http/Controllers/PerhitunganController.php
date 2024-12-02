<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerhitunganController extends Controller
{
    public function hitungSAW_AHP()
    {
        // Ambil data barang beserta kriteria
        $barangs = Barang::with('kriteria')->get();
        
        // Kirim data ke Python melalui API atau menggunakan HTTP request
        $response = Http::post('http://127.0.0.1:5000/hitung', [
            'barangs' => $barangs,
        ]);

        // Ambil hasil perhitungan dari Python
        $hasil = $response->json();

        // Kirim hasil perhitungan ke view
        return view('perhitungan.index', compact('hasil'));
    }
}

