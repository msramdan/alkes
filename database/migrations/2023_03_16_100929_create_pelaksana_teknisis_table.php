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
        Schema::create('pelaksana_teknisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
			$table->boolean('jenis_kelamin');
			$table->string('no_telpon', 15);
			$table->string('email', 200);
			$table->string('tempat_lahir', 100);
			$table->date('tangal_lahir');
			$table->string('photo', 200);
			$table->string('password', 200);
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
        Schema::dropIfExists('pelaksana_teknisis');
    }
};
