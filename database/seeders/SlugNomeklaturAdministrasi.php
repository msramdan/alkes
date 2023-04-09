<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SlugNomeklaturAdministrasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrasis = DB::table('nomenklatur_pendataan_administrasi')->get();

        foreach ($administrasis as $administrasi) {
            $slug = Str::slug($administrasi->field_pendataan_administrasi);

            $admin = DB::table('nomenklatur_pendataan_administrasi')
                        ->where('id', $administrasi->id)
                        ->update([
                            'slug' => $slug
                        ]);
        }
    }
}
