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
        Schema::create('laporan_kinerja', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan', 100);
            $table->foreign('no_laporan')->references('no_laporan')->on('laporans')->cascadeOnDelete();
            $table->string('type_laporan_kinerja', 100);
            $table->json('data_laporan');
            $table->json('data_sertifikat')->nullable();
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
        Schema::dropIfExists('laporan_kinerja');
    }
};
