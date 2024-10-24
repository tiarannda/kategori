<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'tanggal_laporan',
        'total_pemasukan',
        'total_penjualan',
        'total_barang_keluar',
        'total_barang_masuk',
        'id_user',
        'id_barang'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
