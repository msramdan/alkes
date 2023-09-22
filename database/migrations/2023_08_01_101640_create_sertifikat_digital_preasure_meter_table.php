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
        Schema::create('sertifikat_inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')->constrained('inventaris')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('tahun', 4);
            $table->json('data');
            $table->string('file');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sertifikat_ida');
    }
};
