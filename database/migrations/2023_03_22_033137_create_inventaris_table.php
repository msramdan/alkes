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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inventaris', 150);
            $table->string('kode', 50);
            $table->year('tahun_pembelian');
            $table->foreignId('ruangan_id')->nullable()->constrained('rooms')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('jenis_alat_id')->nullable()->constrained('types')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('merk_id')->nullable()->constrained('brands')->restrictOnUpdate()->nullOnDelete();
            $table->string('tipe', 255);
            $table->string('serial_number', 255);
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->restrictOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('inventaris');
    }
};
