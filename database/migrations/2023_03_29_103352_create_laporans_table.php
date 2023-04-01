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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan', 100);
            $table->foreignId('user_created')->constrained('users')->restrictOnUpdate()->restrictOnDelete();
            $table->dateTime('tgl_laporan');
            $table->string('status_laporan', 150);
            $table->foreignId('user_review')->nullable()->constrained('users')->restrictOnUpdate()->restrictOnDelete();
            $table->dateTime('tgl_review')->nullable();
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
        Schema::dropIfExists('laporans');
    }
};
