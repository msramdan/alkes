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
        Schema::create('laporan_daftar_alat_ukur', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->foreignId('nomenklatur_type_id')->cascadeOnDelete();
            $table->foreignId('inventaris_id');
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
        Schema::dropIfExists('laporan_daftar_alat_ukur');
    }
};
