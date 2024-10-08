<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Kategori
{
    public static function getKategori()
    {
        return DB::table('kategori')->get();
    }

    public static function getKategoriId($id)
    {
        return DB::table('kategori')->where('id', $id)->first();
    }

    public static function addKategori($data)
    {
        return DB::table('kategori')->insert($data);
    }

    public static function updateKategori($id, $data)
    {
        return DB::table('kategori')->where('id', $id)->update($data);
    }

    public static function deleteKategori($id)
    {
        return DB::table('kategori')->where('id', $id)->delete();
    }
}

