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
        Schema::create('nomenklatur_kondisi_fisik_fungsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomenklatur_id')->constrained('nomenklaturs')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('field_parameter')->nullable();
            $table->longText('field_batas_pemeriksaan')->nullable();
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
        Schema::dropIfExists('nomenklatur_kondisi_fisik_fungsi');
    }
};
