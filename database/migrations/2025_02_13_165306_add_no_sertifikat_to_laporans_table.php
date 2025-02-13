<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('no_sertifikat')->nullable()->after('no_laporan'); // Ganti 'column_name' dengan kolom sebelumnya
        });
    }

    public function down()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('no_sertifikat');
        });
    }
};
