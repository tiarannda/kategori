<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok_saat_ini',
        'id', // Foreign key ke tabel kategori
    ];

    /**
     * Relasi barang dengan kategori
     * Barang belongs to Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategoris::class, 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksis::class);
    }
}
