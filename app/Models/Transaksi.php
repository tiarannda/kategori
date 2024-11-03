<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
        protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'id_barang',
        'jumlah_barang',
        'total_harga',
        'tipe_transaksi',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'tanggal_transaksi'=> 'datetime',
    ];

    //relasi dengan barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
