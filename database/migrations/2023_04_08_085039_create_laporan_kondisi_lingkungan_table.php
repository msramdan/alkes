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
        Schema::create('laporan_kondisi_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->string('suhu_awal')->nullable();
            $table->string('suhu_akhir')->nullable();
            $table->string('kelembapan_ruangan_awal')->nullable();
            $table->string('kelembapan_ruangan_akhir')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->double('uc_suhu', 15, 9)->nullable();
            $table->double('intercept_suhu', 15, 9)->nullable();
            $table->double('x_variable_suhu', 15, 9)->nullable();
            $table->double('uc_kelembapan', 15, 9)->nullable();
            $table->double('intercept_kelembapan', 15, 9)->nullable();
            $table->double('x_variable_kelembapan', 15, 9)->nullable();
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
        Schema::dropIfExists('laporan_kondisi_lingkungan');
    }
};
