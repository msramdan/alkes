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
        Schema::create('faskes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_faskes', 200);
            $table->foreignId('jenis_faskes_id')->nullable()->constrained('jenis_faskes')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('provinsi_id')->nullable()->constrained('provinces')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('kabkot_id')->nullable()->constrained('kabkots')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans')->restrictOnUpdate()->nullOnDelete();
            $table->foreignId('kelurahan_id')->nullable()->constrained('kelurahans')->restrictOnUpdate()->nullOnDelete();
            $table->string('zip_kode', 10);
            $table->longText('alamat');
            $table->integer('pin')->default('123456');
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
        Schema::dropIfExists('faskes');
    }
};
