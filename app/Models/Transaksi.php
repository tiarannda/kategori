<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
        protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_barang',
        'jumlah_barang',
        'total_harga',
        'tipe_transaksi',
        'tanggal',
    ];

    protected $casts = [
        'tanggal'=> 'datetime',
    ];

    //relasi dengan barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
