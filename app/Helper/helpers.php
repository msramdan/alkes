<?php

use App\Models\Laporan;
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

function get_data_litsrik($no_laporan, $field, $where)
{
    $cek = DB::table('laporan_pengukuran_keselamatan_listrik')
        ->where('no_laporan', $no_laporan)
        ->where($field, $where)
        ->first();
    if (isset($cek)) {
        return $cek;
    } else {
        return '-';
    }
}

function get_data_rs($id)
{
    $cek = DB::table('faskes')
        ->where('id', $id)->first();
    if (isset($cek->nama_faskes)) {
        return $cek->nama_faskes;
    } else {
        return '-';
    }
}


function is_show($nomenklatur_id, $field, $value, $table)
{
    $cek = DB::table($table)
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where($field, $value)->first();
    if ($cek) {
        return 'show';
    } else {
        return 'none';
    }
}


function is_required($nomenklatur_id, $field, $value, $table)
{
    $cek = DB::table($table)
        ->where('nomenklatur_id', $nomenklatur_id)
        ->where($field, $value)->first();
    if ($cek) {
        return 'show';
    } else {
        return 'none';
    }
}

function totalLaporan($status)
{
    $totalStatus = Laporan::where('status_laporan', $status)
        ->get();
    return  $totalStatus->count();
}

function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
