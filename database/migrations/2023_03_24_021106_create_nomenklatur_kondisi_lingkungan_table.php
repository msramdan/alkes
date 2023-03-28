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
        Schema::create('nomenklatur_kondisi_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomenklatur_id')->constrained('nomenklaturs')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('field_kondisi_lingkungan');
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
        Schema::dropIfExists('nomenklatur_kondisi_lingkungan');
    }
};
