<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoris extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk factory

    protected $table = 'kategoris'; // Nama tabel yang digunakan

    protected $fillable = [
        'name', // Kolom yang dapat diisi massal
    ];

    /**
     * Relasi kategori dengan barang
     * Satu kategori dapat memiliki banyak barang
     */
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id');
    }

    /**
     * Mengambil semua kategori.
     */
    public static function getKategori()
    {
        return self::all(); // Mengambil semua data dari tabel kategori
    }

    /**
     * Mengambil kategori berdasarkan ID.
     */
    public static function getKategoriId($id)
    {
        return self::find($id); // Mencari kategori berdasarkan ID
    }

    /**
     * Menambahkan kategori baru.
     */
    public static function addKategori($data)
    {
        return self::create($data); // Menambahkan kategori baru
    }

    /**
     * Mengupdate kategori berdasarkan ID.
     */
    public static function updateKategori($id, $data)
    {
        $kategoris = self::find($id); // Mencari kategori berdasarkan ID
        return $kategoris ? $kategoris->update($data) : null; // Update data jika kategori ditemukan
    }

    /**
     * Menghapus kategori berdasarkan ID.
     */
    public static function deleteKategori($id)
    {
        $kategoris = self::find($id); // Mencari kategori berdasarkan ID
        return $kategoris ? $kategoris->delete() : null; // Hapus kategori jika ditemukan
    }
}
