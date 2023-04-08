<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kondisi_fisik_fungsi', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->foreignId('nomenklatur_kondisi_fisik_fungsi_id');
            $table->string('value');
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
        Schema::dropIfExists('laporan_kondisi_fisik_fungsi');
    }
};
