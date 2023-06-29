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
            $table->double('uc_suhu', 15, 9)->nullable();
            $table->double('intercept_suhu', 15, 9)->nullable();
            $table->double('x_variable_suhu', 15, 9)->nullable();
            $table->double('uc_kelembapan', 15, 9)->nullable();
            $table->double('intercept_kelembapan', 15, 9)->nullable();
            $table->double('x_variable_kelembapan', 15, 9)->nullable();
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
