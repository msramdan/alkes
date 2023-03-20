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
        Schema::create('kabkots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')->constrained('provinces')->restrictOnUpdate()->cascadeOnDelete();
			$table->string('kabupaten_kota', 100);
			$table->string('ibukota', 100);
			$table->char('k_bsni', 3);
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
        Schema::dropIfExists('kabkots');
    }
};
