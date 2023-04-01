<?php

use Illuminate\Support\Facades\DB;


function is_checked($nomenklatur_id, $field, $value, $table)
{
    $cek = DB::table($table)
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where($field, $value)->first();
    if ($cek) {
        return "checked";
    }
}

function cek_satuan($nomenklatur_id, $field_pendataan_administrasi)
{
    $cek = DB::table('nomenklatur_pendataan_administrasi')
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where('field_pendataan_administrasi', $field_pendataan_administrasi)->first();
    if ($cek) {

        return $cek->satuan;
    }
}


function get_data_teknisi()
{
    $id = Session::get('id-teknisi');
    $cek = DB::table('pelaksana_teknisis')
        ->where('id', $id)->first();
    return $cek;
}


function is_show($nomenklatur_id, $field, $value, $table)
{
    $cek = DB::table($table)
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where($field, $value)->first();
    if ($cek) {
        return 'show';
    }else{
        return 'none';
    }
}
