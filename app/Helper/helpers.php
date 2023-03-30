<?php

use Illuminate\Support\Facades\DB;

function checked_box($nomenklatur_id, $type_id)
{
    $cek = DB::table('nomenklatur_type')
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where('type_id', $type_id)->first();
    if ($cek) {
        return "checked";
    }
}

function checked_box_pendataan_administrasi($nomenklatur_id, $field_pendataan_administrasi)
{
    $cek = DB::table('nomenklatur_pendataan_administrasi')
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where('field_pendataan_administrasi', $field_pendataan_administrasi)->first();
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


function cek_lingkungan($nomenklatur_id, $field_kondisi_lingkungan)
{
    $cek = DB::table('nomenklatur_kondisi_lingkungan')
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where('field_kondisi_lingkungan', $field_kondisi_lingkungan)->first();
    if ($cek) {
        return "checked";
    }
}



function get_data_teknisi()
{
    $id = Session::get('id-teknisi');
    $cek = DB::table('pelaksana_teknisis')
        ->where('id', $id)->first();
    return $cek;
}
