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

function hitung_uncertainty($resolusi_uut, $stdev, $uncert, $drift, $n)
{
    // $pembacaan_berulang
    $stdev = $stdev;
    $pembagi = sqrt($n); //2.45
    $v = $n - 1; //5
    $u = $stdev / $pembagi; // 10.36
    $c = 1;
    $uc =  $u * $c; //10.367
    $uc_1 = $uc * $uc;  //107.475
    $ucv_1 = ($uc_1 * $uc_1) / $v;
    // sertifikat Standar
    $stdev2 = $uncert;
    $pembagi2 = 2;
    $v2 = 50;
    $u2 = $stdev2 / $pembagi2; // 0.325
    $c2 = 1;
    $uc2 =  $u2 * $c2; // 0.325
    $uc_2 = $uc2 * $uc2;  //0.106
    $ucv_2 = ($uc_2 * $uc_2) / $v2;

    // Drift
    $stdev3 =  $drift;
    $pembagi3 = sqrt(3);
    $v3 = 50;
    $u3 = $stdev3 / $pembagi3; // 0.006
    $c3 = 1;
    $uc3 = $u3 * $c3; // 0.006
    $uc_3 = $uc3 * $uc3;  // 0
    $ucv_3 = ($uc_3 * $uc_3) / $v3;

    $stdev4 = 0.5 * $resolusi_uut;
    $pembagi4 = sqrt(3);
    $v4 = 50;
    $u4 = $stdev4 / $pembagi4; // 2.887
    $c4 = 1;
    $uc4 = $u4 * $c4; // 2.887
    $uc_4 = $uc4 * $uc4;  // 8.335
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

function hitung_uncertainty2($resolusi_uut, $stdev, $uncert, $drift, $n)
{
    // $pembacaan_berulang
    $stdev = $stdev;
    $pembagi = sqrt($n); //2.45
    $v = $n - 1; //5
    $u = $stdev / $pembagi; // 10.36
    $c = 1;
    $uc =  $u * $c; //10.367
    $uc_1 = $uc * $uc;  //107.475
    $ucv_1 = ($uc_1 * $uc_1) / $v;
    // sertifikat Standar
    $stdev2 = $uncert;
    $pembagi2 = 2;
    $v2 = 50;
    $u2 = $stdev2 / $pembagi2; // 0.325
    $c2 = 1;
    $uc2 =  $u2 * $c2; // 0.325
    $uc_2 = $uc2 * $uc2;  //0.106
    $ucv_2 = ($uc_2 * $uc_2) / $v2;

    // Drift
    $stdev3 =  $drift;
    $pembagi3 = sqrt(3);
    $v3 = 50;
    $u3 = $stdev3 / $pembagi3; // 0.006
    $c3 = 1;
    $uc3 = $u3 * $c3; // 0.006
    $uc_3 = $uc3 * $uc3;  // 0
    $ucv_3 = ($uc_3 * $uc_3) / $v3;

    // Resolusi UUT
    $stdev4 = 0.5 * $resolusi_uut;
    $pembagi4 = sqrt(3);
    $v4 = 50;
    $u4 = $stdev4 / $pembagi4; // 2.887
    $c4 = 1;
    $uc4 = $u4 * $c4; // 2.887
    $uc_4 = $uc4 * $uc4;  // 8.335
    $ucv_4 = ($uc_4 * $uc_4) / $v4;
    // ==============================================

    // Pembacaan Operator
    $stdev5 = 0.23;
    $pembagi5 = 1;
    $v5 = 50;
    $u5 = $stdev5 / $pembagi5;
    $c5 = 1;
    $uc5 = $u5 * $c5;
    $uc_5 = $uc5 * $uc5;
    $ucv_5 = ($uc_5 * $uc_5) / $v5;

    $jumlah_uc =  $uc_1  + $uc_2 + $uc_3 + $uc_4 + $uc_5;
    $jumlah_ucv =  $ucv_1  + $ucv_2 + $ucv_3 + $ucv_4 + $ucv_5;
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


function sensor_recorder($request)
{
    $data_laporan = [
        'posisi_sensor' => $request->posisi_sensor,
        'percobaan1_1_min' => $request->percobaan1_1_min,
        'percobaan1_1_max' => $request->percobaan1_1_max,
        'percobaan1_2_min' => $request->percobaan1_2_min,
        'percobaan1_2_max' => $request->percobaan1_2_max,
        'percobaan1_3_min' => $request->percobaan1_3_min,
        'percobaan1_3_max' => $request->percobaan1_3_max,
        'percobaan2_1_min' => $request->percobaan2_1_min,
        'percobaan2_1_max' => $request->percobaan2_1_max,
        'percobaan2_2_min' => $request->percobaan2_2_min,
        'percobaan2_2_max' => $request->percobaan2_2_max,
        'percobaan2_3_min' => $request->percobaan2_3_min,
        'percobaan2_3_max' => $request->percobaan2_3_max,
        'percobaan3_1_min' => $request->percobaan3_1_min,
        'percobaan3_1_max' => $request->percobaan3_1_max,
        'percobaan3_2_min' => $request->percobaan3_2_min,
        'percobaan3_2_max' => $request->percobaan3_2_max,
        'percobaan3_3_min' => $request->percobaan3_3_min,
        'percobaan3_3_max' => $request->percobaan3_3_max,
        'percobaan4_1_min' => $request->percobaan4_1_min,
        'percobaan4_1_max' => $request->percobaan4_1_max,
        'percobaan4_2_min' => $request->percobaan4_2_min,
        'percobaan4_2_max' => $request->percobaan4_2_max,
        'percobaan4_3_min' => $request->percobaan4_3_min,
        'percobaan4_3_max' => $request->percobaan4_3_max,
        'percobaan5_1_min' => $request->percobaan5_1_min,
        'percobaan5_1_max' => $request->percobaan5_1_max,
        'percobaan5_2_min' => $request->percobaan5_2_min,
        'percobaan5_2_max' => $request->percobaan5_2_max,
        'percobaan5_3_min' => $request->percobaan5_3_min,
        'percobaan5_3_max' => $request->percobaan5_3_max,
        'percobaan6_1_min' => $request->percobaan6_1_min,
        'percobaan6_1_max' => $request->percobaan6_1_max,
        'percobaan6_2_min' => $request->percobaan6_2_min,
        'percobaan6_2_max' => $request->percobaan6_2_max,
        'percobaan6_3_min' => $request->percobaan6_3_min,
        'percobaan6_3_max' => $request->percobaan6_3_max,
        'percobaan7_1_min' => $request->percobaan7_1_min,
        'percobaan7_1_max' => $request->percobaan7_1_max,
        'percobaan7_2_min' => $request->percobaan7_2_min,
        'percobaan7_2_max' => $request->percobaan7_2_max,
        'percobaan7_3_min' => $request->percobaan7_3_min,
        'percobaan7_3_max' => $request->percobaan7_3_max,
        'percobaan8_1_min' => $request->percobaan8_1_min,
        'percobaan8_1_max' => $request->percobaan8_1_max,
        'percobaan8_2_min' => $request->percobaan8_2_min,
        'percobaan8_2_max' => $request->percobaan8_2_max,
        'percobaan8_3_min' => $request->percobaan8_3_min,
        'percobaan8_3_max' => $request->percobaan8_3_max,
        'percobaan9_1_min' => $request->percobaan9_1_min,
        'percobaan9_1_max' => $request->percobaan9_1_max,
        'percobaan9_2_min' => $request->percobaan9_2_min,
        'percobaan9_2_max' => $request->percobaan9_2_max,
        'percobaan9_3_min' => $request->percobaan9_3_min,
        'percobaan9_3_max' => $request->percobaan9_3_max,
    ];
    return json_encode($data_laporan);
}

function suction_pump($request)
{
    $data_laporan = [
        'percobaan100_1_naik' => $request->percobaan100_1_naik,
        'percobaan100_1_turun' => $request->percobaan100_1_turun,
        'percobaan100_2_naik' => $request->percobaan100_2_naik,
        'percobaan100_2_turun' => $request->percobaan100_2_turun,
        'percobaan100_3_naik' => $request->percobaan100_3_naik,
        'percobaan100_3_turun' => $request->percobaan100_3_turun,
        'percobaan200_1_naik' => $request->percobaan200_1_naik,
        'percobaan200_1_turun' => $request->percobaan200_1_turun,
        'percobaan200_2_naik' => $request->percobaan200_2_naik,
        'percobaan200_2_turun' => $request->percobaan200_2_turun,
        'percobaan200_3_naik' => $request->percobaan200_3_naik,
        'percobaan200_3_turun' => $request->percobaan200_3_turun,
        'percobaan300_1_naik' => $request->percobaan300_1_naik,
        'percobaan300_1_turun' => $request->percobaan300_1_turun,
        'percobaan300_2_naik' => $request->percobaan300_2_naik,
        'percobaan300_2_turun' => $request->percobaan300_2_turun,
        'percobaan300_3_naik' => $request->percobaan300_3_naik,
        'percobaan300_3_turun' => $request->percobaan300_3_turun,
        'percobaan400_1_naik' => $request->percobaan400_1_naik,
        'percobaan400_1_turun' => $request->percobaan400_1_turun,
        'percobaan400_2_naik' => $request->percobaan400_2_naik,
        'percobaan400_2_turun' => $request->percobaan400_2_turun,
        'percobaan400_3_naik' => $request->percobaan400_3_naik,
        'percobaan400_3_turun' => $request->percobaan400_3_turun,
        'percobaan500_1_naik' => $request->percobaan500_1_naik,
        'percobaan500_1_turun' => $request->percobaan500_1_turun,
        'percobaan500_2_naik' => $request->percobaan500_2_naik,
        'percobaan500_2_turun' => $request->percobaan500_2_turun,
        'percobaan500_3_naik' => $request->percobaan500_3_naik,
        'percobaan500_3_turun' => $request->percobaan500_3_turun,
        'percobaan600_1_naik' => $request->percobaan600_1_naik,
        'percobaan600_1_turun' => $request->percobaan600_1_turun,
        'percobaan600_2_naik' => $request->percobaan600_2_naik,
        'percobaan600_2_turun' => $request->percobaan600_2_turun,
        'percobaan600_3_naik' => $request->percobaan600_3_naik,
        'percobaan600_3_turun' => $request->percobaan600_3_turun,
        'nilai_max' => $request->nilai_max,
        'max1' => $request->max1,
        'max2' => $request->max2,
        'max3' => $request->max3,
    ];
    return json_encode($data_laporan);
}

function contact_tachometer($request)
{
    $data_laporan = [
        'percobaan_1000_1' => $request->percobaan_1000_1,
        'percobaan_1000_2' => $request->percobaan_1000_2,
        'percobaan_1000_3' => $request->percobaan_1000_3,
        'percobaan_1000_4' => $request->percobaan_1000_4,
        'percobaan_1000_5' => $request->percobaan_1000_5,
        'percobaan_1000_6' => $request->percobaan_1000_6,
        'percobaan_2000_1' => $request->percobaan_2000_1,
        'percobaan_2000_2' => $request->percobaan_2000_2,
        'percobaan_2000_3' => $request->percobaan_2000_3,
        'percobaan_2000_4' => $request->percobaan_2000_4,
        'percobaan_2000_5' => $request->percobaan_2000_5,
        'percobaan_2000_6' => $request->percobaan_2000_6,
        'percobaan_3000_1' => $request->percobaan_3000_1,
        'percobaan_3000_2' => $request->percobaan_3000_2,
        'percobaan_3000_3' => $request->percobaan_3000_3,
        'percobaan_3000_4' => $request->percobaan_3000_4,
        'percobaan_3000_5' => $request->percobaan_3000_5,
        'percobaan_3000_6' => $request->percobaan_3000_6,
        'percobaan_4000_1' => $request->percobaan_4000_1,
        'percobaan_4000_2' => $request->percobaan_4000_2,
        'percobaan_4000_3' => $request->percobaan_4000_3,
        'percobaan_4000_4' => $request->percobaan_4000_4,
        'percobaan_4000_5' => $request->percobaan_4000_5,
        'percobaan_4000_6' => $request->percobaan_4000_6,
        'min_1' => $request->min_1,
        'min_2' => $request->min_2,
        'min_3' => $request->min_3,
        'min_4' => $request->min_4,
        'min_5' => $request->min_5,
        'min_6' => $request->min_6,
        'medium_1' => $request->medium_1,
        'medium_2' => $request->medium_2,
        'medium_3' => $request->medium_3,
        'medium_4' => $request->medium_4,
        'medium_5' => $request->medium_5,
        'medium_6' => $request->medium_6,
        'max_1' => $request->max_1,
        'max_2' => $request->max_2,
        'max_3' => $request->max_3,
        'max_4' => $request->max_4,
        'max_5' => $request->max_5,
        'max_6' => $request->max_6,
    ];
    return json_encode($data_laporan);
}

function kinerja_waktu($request)
{
    $data_laporan = [
        'second_1' => $request->second_1,
        'second_2' => $request->second_2,
        'second_3' => $request->second_3,
    ];
    return json_encode($data_laporan);
}


function heart_rate($request)
{
    $data_laporan = [
        'percobaan60_1' => $request->percobaan60_1,
        'percobaan60_2' => $request->percobaan60_2,
        'percobaan60_3' => $request->percobaan60_3,
        'percobaan60_4' => $request->percobaan60_4,
        'percobaan60_5' => $request->percobaan60_5,
        'percobaan60_6' => $request->percobaan60_6,
        'percobaan90_1' => $request->percobaan90_1,
        'percobaan90_2' => $request->percobaan90_2,
        'percobaan90_3' => $request->percobaan90_3,
        'percobaan90_4' => $request->percobaan90_4,
        'percobaan90_5' => $request->percobaan90_5,
        'percobaan90_6' => $request->percobaan90_6,
        'percobaan120_1' => $request->percobaan120_1,
        'percobaan120_2' => $request->percobaan120_2,
        'percobaan120_3' => $request->percobaan120_3,
        'percobaan120_4' => $request->percobaan120_4,
        'percobaan120_5' => $request->percobaan120_5,
        'percobaan120_6' => $request->percobaan120_6,
        'percobaan150_1' => $request->percobaan150_1,
        'percobaan150_2' => $request->percobaan150_2,
        'percobaan150_3' => $request->percobaan150_3,
        'percobaan150_4' => $request->percobaan150_4,
        'percobaan150_5' => $request->percobaan150_5,
        'percobaan150_6' => $request->percobaan150_6,
        'percobaan180_1' => $request->percobaan180_1,
        'percobaan180_2' => $request->percobaan180_2,
        'percobaan180_3' => $request->percobaan180_3,
        'percobaan180_4' => $request->percobaan180_4,
        'percobaan180_5' => $request->percobaan180_5,
        'percobaan180_6' => $request->percobaan180_6,
        'percobaan210_1' => $request->percobaan210_1,
        'percobaan210_2' => $request->percobaan210_2,
        'percobaan210_3' => $request->percobaan210_3,
        'percobaan210_4' => $request->percobaan210_4,
        'percobaan210_5' => $request->percobaan210_5,
        'percobaan210_6' => $request->percobaan210_6,
    ];
    return json_encode($data_laporan);
}


function intensitas_cahaya($request)
{
    $data_laporan = [
        'cahaya_1' => $request->cahaya_1,
        'cahaya_2' => $request->cahaya_2,
        'cahaya_3' => $request->cahaya_3,
        'cahaya_4' => $request->cahaya_4,
        'cahaya_5' => $request->cahaya_5,
        'cahaya_6' => $request->cahaya_6,
    ];
    return json_encode($data_laporan);
}

function akurasi_pressure($request)
{
    $data_laporan = [
        'pressure_1' => $request->pressure_1,
        'pressure_2' => $request->pressure_2,
        'pressure_3' => $request->pressure_3,
        'pressure_4' => $request->pressure_4,
        'pressure_5' => $request->pressure_5,
        'pressure_6' => $request->pressure_6,
    ];
    return json_encode($data_laporan);
}

function kecepatan_putaran($request)
{
    $data_laporan = [
        'putaran_50_1' => $request->putaran_50_1,
        'putaran_50_2' => $request->putaran_50_2,
        'putaran_50_3' => $request->putaran_50_3,
        'putaran_50_4' => $request->putaran_50_4,
        'putaran_50_5' => $request->putaran_50_5,
        'putaran_50_6' => $request->putaran_50_6,
        'putaran_100_1' => $request->putaran_100_1,
        'putaran_100_2' => $request->putaran_100_2,
        'putaran_100_3' => $request->putaran_100_3,
        'putaran_100_4' => $request->putaran_100_4,
        'putaran_100_5' => $request->putaran_100_5,
        'putaran_100_6' => $request->putaran_100_6,
        'rpm_max' => $request->rpm_max,
    ];
    return json_encode($data_laporan);
}

function waktu_putaran($request)
{
    $data_laporan = [
        'waktu_putaran_1' => $request->waktu_putaran_1,
        'waktu_putaran_2' => $request->waktu_putaran_2,
        'waktu_putaran_3' => $request->waktu_putaran_3,
    ];
    return json_encode($data_laporan);
}
