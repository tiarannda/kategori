<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up()
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_barang')->constrained('barangs')->onDelete('cascade'); // Ubah dari barang_id menjadi id_barang
        $table->integer('jumlah_barang');
        $table->decimal('total_harga', 10, 2);
        $table->enum('tipe_transaksi', ['jual', 'beli']);
        $table->date('tanggal_transaksi');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
