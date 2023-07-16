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
        Schema::create('sertifikat_electrical_safety_analyzer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')->constrained('inventaris')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('tahun', 4);
            // LIVE TO NETRAL
            $table->double('intercept1', 15, 9)->nullable();
            $table->double('x_variable1', 15, 9)->nullable();
            // EARTH TO NETRAL
            $table->double('intercept2', 15, 9)->nullable();
            $table->double('x_variable2', 15, 9)->nullable();
            // LIVE TO EARTH
            $table->double('intercept3', 15, 9)->nullable();
            $table->double('x_variable3', 15, 9)->nullable();
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
        Schema::dropIfExists('sertifikat_electrical_safety_analyzer');
    }
};
