<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'kriteria';

    // Tentukan kolom mana yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama',
        'jenis',  // 'cost' atau 'benefit'
        'bobot_ahp',
    ];

    // Relasi dengan model Barang (jika ada)
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_kriteria');
    }
}
