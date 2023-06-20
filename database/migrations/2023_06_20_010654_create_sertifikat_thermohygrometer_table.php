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
        Schema::create('sertifikat_thermohygrometer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')->constrained('inventaris')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('tahun', 4);
            $table->string('uc_suhu', 50)->nullable();
            $table->string('intercept_suhu', 50)->nullable();
            $table->string('x_variable_suhu', 50)->nullable();
            $table->string('uc_kelembapan', 50)->nullable();
            $table->string('intercept_kelembapan', 50)->nullable();
            $table->string('x_variable_kelembapan', 50)->nullable();
            $table->string('file');
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
        Schema::dropIfExists('sertifikat_thermohygrometer');
    }
};
