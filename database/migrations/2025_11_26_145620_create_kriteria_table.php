<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['cost', 'benefit']);
            $table->decimal('bobot_ahp', 5, 2);  // Bobot AHP (misalnya 0.20, 0.25, dst)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * Drops the `kriteria` table.
     */
    public function down()
    {
        Schema::dropIfExists('kriteria');
    }
}
