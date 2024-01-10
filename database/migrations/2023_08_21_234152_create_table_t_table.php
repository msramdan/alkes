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
        Schema::create('table_t', function (Blueprint $table) {
            $table->id();
            $table->integer('df')->nullable();
            $table->double('value', 3)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_t');
    }
};
