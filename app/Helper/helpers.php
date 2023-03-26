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

function get_data_teknisi()
{
    $id = Session::get('id-teknisi');
    $cek = DB::table('pelaksana_teknisis')
        ->where('id', $id)->first();
    return $cek;
}
