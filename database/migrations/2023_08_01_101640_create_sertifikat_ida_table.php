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
        Schema::create('sertifikat_ida', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')->constrained('inventaris')->restrictOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('sertifikat_ida');
    }
};
