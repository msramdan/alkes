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
        Schema::create('kontak_masukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelaksana_teknis_id')->nullable()->constrained('pelaksana_teknisis')->restrictOnUpdate()->nullOnDelete();
            $table->string('judul', 255);
            $table->text('deksiprsi');
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
        Schema::dropIfExists('kontak_masukans');
    }
};
