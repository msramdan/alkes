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

function standard_deviation($sample)
{
    if (is_array($sample)) {
        $mean = array_sum($sample) / count($sample);
        foreach ($sample as $key => $num) $devs[$key] = pow($num - $mean, 2);
        return sqrt(array_sum($devs) / (count($devs) - 1));
    }
}

function hitung_uncertainty($resolusi_uut, $stdev, $uncert, $drift)
{
    // $pembacaan_berulang
    $n = 6;
    $stdev = $stdev;
    $pembagi = round(sqrt($n), 3); //2.45
    $v = $n - 1; //5
    $u = round($stdev / $pembagi, 3); // 10.36
    $c = 1;
    $uc =  $u * $c; //10.367
    $uc_1 = round($uc * $uc, 3);  //107.475
    $ucv_1 = ($uc_1 * $uc_1) / $v;
    // sertifikat Standar
    $stdev2 = $uncert;
    $pembagi2 = 2;
    $v2 = 50;
    $u2 = round($stdev2 / $pembagi2, 3); // 0.325
    $c2 = 1;
    $uc2 =  $u2 * $c2; // 0.325
    $uc_2 = round($uc2 * $uc2, 3);  //0.106
    $ucv_2 = ($uc_2 * $uc_2) / $v2;

    // Drift
    $stdev3 =  $drift;
    $pembagi3 = sqrt(3);
    $v3 = 50;
    $u3 = round($stdev3 / $pembagi3, 3); // 0.006
    $c3 = 1;
    $uc3 = $u3 * $c3; // 0.006
    $uc_3 = round($uc3 * $uc3, 3);  // 0
    $ucv_3 = ($uc_3 * $uc_3) / $v2;

    $stdev4 = 0.5 * $resolusi_uut;
    $pembagi4 = sqrt(3);
    $v4 = 50;
    $u4 = round($stdev4 / $pembagi4, 3); // 2.887
    $c4 = 1;
    $uc4 = $u4 * $c4; // 2.887
    $uc_4 = round($uc4 * $uc4, 3);  // 8.335
    $ucv_4 = ($uc_4 * $uc_4) / $v4;
    // ==============================================
    $jumlah_uc =  $uc_1  + $uc_2 + $uc_3 + $uc_4;
    $jumlah_ucv =  $ucv_1  + $ucv_2 + $ucv_3 + $ucv_4;
    $ketidakpastian_baku_gabungan = sqrt($jumlah_uc);
    $derajat_kebebasan_efektif = ($ketidakpastian_baku_gabungan * $ketidakpastian_baku_gabungan * $ketidakpastian_baku_gabungan * $ketidakpastian_baku_gabungan) /  $jumlah_ucv;
    $faktor_cakupan = tinv(0.05, floor($derajat_kebebasan_efektif));
    $ketidakpastian_bentangan = $faktor_cakupan * $ketidakpastian_baku_gabungan;
    return $ketidakpastian_bentangan;
}

function tinv($probability, $df)
{
    $table_t = DB::table('table_t')->where('df', $df)->first();
    return $table_t->value;
}

function generateKode($prefix)
{
    $tahun = date('Y');
    $sql = Laporan::orderBy('no_laporan', 'desc')->where(DB::raw('substr(no_laporan, 5, 4)'), '=', $tahun)->first();
    if ($sql) {
        $tmp = substr($sql->no_laporan, 9, 5);
        $x = ((int)$tmp) + 1;
        $lastKode = sprintf("%05s", $x);
        $kd = $prefix . '-' . $tahun . '-' . $lastKode;
    } else {
        $kd = $prefix . '-' . $tahun . '-' . "00001";
    }
    return $kd;
}


// =======================payload data kinerja===================

function akurasi_tekanan($request)
{
    $data_laporan = [
        'percobaan0_1_naik' => $request->percobaan0_1_naik,
        'percobaan0_1_turun' => $request->percobaan0_1_turun,
        'percobaan0_2_naik' => $request->percobaan0_2_naik,
        'percobaan0_2_turun' => $request->percobaan0_2_turun,
        'percobaan0_3_naik' => $request->percobaan0_3_naik,
        'percobaan0_3_turun' => $request->percobaan0_3_turun,
        'percobaan50_1_naik' => $request->percobaan50_1_naik,
        'percobaan50_1_turun' => $request->percobaan50_1_turun,
        'percobaan50_2_naik' => $request->percobaan50_2_naik,
        'percobaan50_2_turun' => $request->percobaan50_2_turun,
        'percobaan50_3_naik' => $request->percobaan50_3_naik,
        'percobaan50_3_turun' => $request->percobaan50_3_turun,
        'percobaan100_1_naik' => $request->percobaan100_1_naik,
        'percobaan100_1_turun' => $request->percobaan100_1_turun,
        'percobaan100_2_naik' => $request->percobaan100_2_naik,
        'percobaan100_2_turun' => $request->percobaan100_2_turun,
        'percobaan100_3_naik' => $request->percobaan100_3_naik,
        'percobaan100_3_turun' => $request->percobaan100_3_turun,
        'percobaan150_1_naik' => $request->percobaan150_1_naik,
        'percobaan150_1_turun' => $request->percobaan150_1_turun,
        'percobaan150_2_naik' => $request->percobaan150_2_naik,
        'percobaan150_2_turun' => $request->percobaan150_2_turun,
        'percobaan150_3_naik' => $request->percobaan150_3_naik,
        'percobaan150_3_turun' => $request->percobaan150_3_turun,
        'percobaan200_1_naik' => $request->percobaan200_1_naik,
        'percobaan200_1_turun' => $request->percobaan200_1_turun,
        'percobaan200_2_naik' => $request->percobaan200_2_naik,
        'percobaan200_2_turun' => $request->percobaan200_2_turun,
        'percobaan200_3_naik' => $request->percobaan200_3_naik,
        'percobaan200_3_turun' => $request->percobaan200_3_turun,
        'percobaan250_1_naik' => $request->percobaan250_1_naik,
        'percobaan250_1_turun' => $request->percobaan250_1_turun,
        'percobaan250_2_naik' => $request->percobaan250_2_naik,
        'percobaan250_2_turun' => $request->percobaan250_2_turun,
        'percobaan250_3_naik' => $request->percobaan250_3_naik,
        'percobaan250_3_turun' => $request->percobaan250_3_turun,
    ];
    return json_encode($data_laporan);
}

function kebocoran_tekanan($request)
{
    $data_laporan = [
        'value' => $request->kebocoran_tekanan,
    ];
    return json_encode($data_laporan);
}

function laju_buang_cepat($request)
{
    $data_laporan = [
        'value' => $request->laju_buang_cepat,
    ];
    return json_encode($data_laporan);
}

function laporan_occlusion($request)
{
    $data_laporan = [
        'percobaan_1' => $request->percobaan_1,
        'percobaan_2' => $request->percobaan_2,
        'percobaan_3' => $request->percobaan_3,
        'percobaan_4' => $request->percobaan_4,
        'percobaan_5' => $request->percobaan_5,
        'percobaan_6' => $request->percobaan_6,
    ];
    return json_encode($data_laporan);
}

function laporan_flow_rate($request)
{
    $data_laporan = [
        'percobaan1_1' => $request->percobaan1_1,
        'percobaan1_2' => $request->percobaan1_2,
        'percobaan1_3' => $request->percobaan1_3,
        'percobaan1_4' => $request->percobaan1_4,
        'percobaan1_5' => $request->percobaan1_5,
        'percobaan1_6' => $request->percobaan1_6,
        'percobaan2_1' => $request->percobaan2_1,
        'percobaan2_2' => $request->percobaan2_2,
        'percobaan2_3' => $request->percobaan2_3,
        'percobaan2_4' => $request->percobaan2_4,
        'percobaan2_5' => $request->percobaan2_5,
        'percobaan2_6' => $request->percobaan2_6,
        'percobaan3_1' => $request->percobaan3_1,
        'percobaan3_2' => $request->percobaan3_2,
        'percobaan3_3' => $request->percobaan3_3,
        'percobaan3_4' => $request->percobaan3_4,
        'percobaan3_5' => $request->percobaan3_5,
        'percobaan3_6' => $request->percobaan3_6,
        'percobaan4_1' => $request->percobaan4_1,
        'percobaan4_2' => $request->percobaan4_2,
        'percobaan4_3' => $request->percobaan4_3,
        'percobaan4_4' => $request->percobaan4_4,
        'percobaan4_5' => $request->percobaan4_5,
        'percobaan4_6' => $request->percobaan4_6,
    ];
    return json_encode($data_laporan);
}

function laporan_kondisi_lingkungan($request)
{
    $data_laporan = [
        'suhu_awal' => $request->lingkungan_suhu_awal ?: null,
        'suhu_akhir' => $request->lingkungan_suhu_akhir ?: null,
        'kelembapan_ruangan_awal' => $request->lingkungan_kelembapan_ruangan_awal ? $request->lingkungan_kelembapan_ruangan_awal :  null,
        'kelembapan_ruangan_akhir' => $request->lingkungan_kelembapan_ruangan_akhir ? $request->lingkungan_kelembapan_ruangan_akhir : null,
    ];
    return json_encode($data_laporan);
}
