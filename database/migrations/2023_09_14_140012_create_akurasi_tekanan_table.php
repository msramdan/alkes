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
        Schema::create('akurasi_tekanan', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan', 100);
            $table->foreign('no_laporan')->references('no_laporan')->on('laporans')->cascadeOnDelete();

            $table->double('percobaan0_1_naik', 15, 9)->nullable();
            $table->double('percobaan0_1_turun', 15, 9)->nullable();
            $table->double('percobaan0_2_naik', 15, 9)->nullable();
            $table->double('percobaan0_2_turun', 15, 9)->nullable();
            $table->double('percobaan0_3_naik', 15, 9)->nullable();
            $table->double('percobaan0_3_turun', 15, 9)->nullable();

            $table->double('percobaan50_1_naik', 15, 9)->nullable();
            $table->double('percobaan50_1_turun', 15, 9)->nullable();
            $table->double('percobaan50_2_naik', 15, 9)->nullable();
            $table->double('percobaan50_2_turun', 15, 9)->nullable();
            $table->double('percobaan50_3_naik', 15, 9)->nullable();
            $table->double('percobaan50_3_turun', 15, 9)->nullable();

            $table->double('percobaan100_1_naik', 15, 9)->nullable();
            $table->double('percobaan100_1_turun', 15, 9)->nullable();
            $table->double('percobaan100_2_naik', 15, 9)->nullable();
            $table->double('percobaan100_2_turun', 15, 9)->nullable();
            $table->double('percobaan100_3_naik', 15, 9)->nullable();
            $table->double('percobaan100_3_turun', 15, 9)->nullable();

            $table->double('percobaan150_1_naik', 15, 9)->nullable();
            $table->double('percobaan150_1_turun', 15, 9)->nullable();
            $table->double('percobaan150_2_naik', 15, 9)->nullable();
            $table->double('percobaan150_2_turun', 15, 9)->nullable();
            $table->double('percobaan150_3_naik', 15, 9)->nullable();
            $table->double('percobaan150_3_turun', 15, 9)->nullable();

            $table->double('percobaan200_1_naik', 15, 9)->nullable();
            $table->double('percobaan200_1_turun', 15, 9)->nullable();
            $table->double('percobaan200_2_naik', 15, 9)->nullable();
            $table->double('percobaan200_2_turun', 15, 9)->nullable();
            $table->double('percobaan200_3_naik', 15, 9)->nullable();
            $table->double('percobaan200_3_turun', 15, 9)->nullable();

            $table->double('percobaan250_1_naik', 15, 9)->nullable();
            $table->double('percobaan250_1_turun', 15, 9)->nullable();
            $table->double('percobaan250_2_naik', 15, 9)->nullable();
            $table->double('percobaan250_2_turun', 15, 9)->nullable();
            $table->double('percobaan250_3_naik', 15, 9)->nullable();
            $table->double('percobaan250_3_turun', 15, 9)->nullable();

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
        Schema::dropIfExists('akurasi_tekanan');
    }
};
