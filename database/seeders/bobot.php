<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bobot extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('bobots')->insert([
            [
                'kriteria' => 'harga',
                'bobot' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kriteria' => 'barang_masuk',
                'bobot' => 0.3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kriteria' => 'barang_keluar',
                'bobot' => 0.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
