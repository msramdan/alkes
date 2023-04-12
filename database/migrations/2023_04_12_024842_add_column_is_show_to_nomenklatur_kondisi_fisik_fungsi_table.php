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
        Schema::table('nomenklatur_kondisi_fisik_fungsi', function (Blueprint $table) {
            $table->tinyInteger('is_show')->after('field_batas_pemeriksaan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomenklatur_kondisi_fisik_fungsi', function (Blueprint $table) {
            //
        });
    }
};
