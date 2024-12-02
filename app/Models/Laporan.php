<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // Nama tabel
    protected $primaryKey = 'id_laporan'; // Primary key
    public $timestamps = true; // Untuk created_at dan updated_at

    protected $fillable = [
        'tanggal_laporan',
        'total_pemasukan',
        'total_pengeluaran', 
        'total_barang_keluar',
        'total_barang_masuk',
        'id_user'
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
