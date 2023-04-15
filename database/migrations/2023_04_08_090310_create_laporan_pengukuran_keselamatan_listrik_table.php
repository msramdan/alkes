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
        Schema::create('laporan_pengukuran_keselamatan_listrik', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->string('field_keselamatan_listrik')->nullable();
            $table->string('slug')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('laporan_pengukuran_keselamatan_listrik');
    }
};
