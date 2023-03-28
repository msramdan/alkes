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
        Schema::create('nomenklatur_cek_kualitatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomenklatur_id')->constrained('nomenklaturs')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('bagian_alat');
            $table->string('batasan_pemeriksaan');
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
        Schema::dropIfExists('nomenklatur_cek_kualitatif');
    }
};
