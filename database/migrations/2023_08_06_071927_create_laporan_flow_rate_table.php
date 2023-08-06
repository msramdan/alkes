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
        Schema::create('laporan_flow_rate', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan', 100);
            $table->foreign('no_laporan')->references('no_laporan')->on('laporans')->cascadeOnDelete();
            $table->double('percobaan1_1', 15, 9)->nullable();
            $table->double('percobaan1_2', 15, 9)->nullable();
            $table->double('percobaan1_3', 15, 9)->nullable();
            $table->double('percobaan1_4', 15, 9)->nullable();
            $table->double('percobaan1_5', 15, 9)->nullable();
            $table->double('percobaan1_6', 15, 9)->nullable();

            $table->double('percobaan2_1', 15, 9)->nullable();
            $table->double('percobaan2_2', 15, 9)->nullable();
            $table->double('percobaan2_3', 15, 9)->nullable();
            $table->double('percobaan2_4', 15, 9)->nullable();
            $table->double('percobaan2_5', 15, 9)->nullable();
            $table->double('percobaan2_6', 15, 9)->nullable();

            $table->double('percobaan3_1', 15, 9)->nullable();
            $table->double('percobaan3_2', 15, 9)->nullable();
            $table->double('percobaan3_3', 15, 9)->nullable();
            $table->double('percobaan3_4', 15, 9)->nullable();
            $table->double('percobaan3_5', 15, 9)->nullable();
            $table->double('percobaan3_6', 15, 9)->nullable();

            $table->double('percobaan4_1', 15, 9)->nullable();
            $table->double('percobaan4_2', 15, 9)->nullable();
            $table->double('percobaan4_3', 15, 9)->nullable();
            $table->double('percobaan4_4', 15, 9)->nullable();
            $table->double('percobaan4_5', 15, 9)->nullable();
            $table->double('percobaan4_6', 15, 9)->nullable();

            $table->string('tahun', 4);
            $table->double('slope_1', 15, 9)->nullable();
            $table->double('intercept_1', 15, 9)->nullable();
            $table->double('slope_2', 15, 9)->nullable();
            $table->double('intercept_2', 15, 9)->nullable();
            $table->double('drift10_1', 15, 9)->nullable();
            $table->double('drift50_1', 15, 9)->nullable();
            $table->double('drift100_1', 15, 9)->nullable();
            $table->double('drift500_1', 15, 9)->nullable();
            $table->double('drift10_2', 15, 9)->nullable();
            $table->double('drift50_2', 15, 9)->nullable();
            $table->double('drift100_2', 15, 9)->nullable();
            $table->double('drift500_2', 15, 9)->nullable();

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
        Schema::dropIfExists('laporan_flow_rate');
    }
};
