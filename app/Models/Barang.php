<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_barang';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok_saat_ini',
        'id', // Foreign key ke tabel kategori
    ];

    // Relasi barang belongs to kategori
    public function kategori()
    {
        return $this->belongsTo(Kategoris::class, 'id'); 
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_barang');
    }

   

}

