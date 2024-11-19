<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->date('tanggal_laporan');
            $table->decimal('total_pemasukan', 15, 2);
            $table->decimal('total_pengeluaran', 15, 2);
            $table->integer('total_barang_keluar');
            $table->integer('total_barang_masuk');
            $table->foreignId('id_user')->constrained('users'); // Mengacu ke tabel users
            $table->foreignId('id_barang')->constrained('barangs'); // Mengacu ke tabel barangs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
