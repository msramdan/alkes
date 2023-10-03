<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat {{ $laporan->no_laporan }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma35MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('template_sertifikat/assets/css/custom.css') }}">
</head>

@if ($count_laporan_pengukuran_keselamatan_listrik > 0)
    <?php
    $cek = json_decode(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->data_sertifikat);
    $hitungPhaseNetral = round($cek->intercept1 + $cek->x_variable1 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value, 2);

    $hitungPhaseGround = round($cek->intercept3 + $cek->x_variable3 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value, 2);

    $hitungGroundNetral = round($cek->intercept2 + $cek->x_variable2 * get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value, 2);

    $dps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-dapat-dilepas-dps')->value;
    $nps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-tidak-dapat-dilepas-nps')->value;
    $isolasi = get_data_litsrik($laporan->no_laporan, 'slug', 'resistansi-isolasi')->value;
    $bf = get_data_litsrik($laporan->no_laporan, 'slug', 'kelas-i-tipe-bbfcf')->value;
    $lulus = 0;
    if ($hitungPhaseNetral > 198) {
        $lulus = $lulus + 1;
    }

    if ($hitungPhaseGround > 198) {
        $lulus = $lulus + 1;
    }
    if ($hitungGroundNetral < 5) {
        $lulus = $lulus + 1;
    }
    if ($dps <= 0.2) {
        $lulus = $lulus + 1;
    }
    if ($nps <= 0.3) {
        $lulus = $lulus + 1;
    }
    if ($isolasi > 2) {
        $lulus = $lulus + 1;
    }
    if ($bf <= 500) {
        $lulus = $lulus + 1;
    }

    $point = round(($lulus / 7) * 40);
    ?>
@endif
@if ($nomenklatur->id == config('nomenklatur.INFUSION_PUMP') || $nomenklatur->id == config('nomenklatur.SYRINGE_PUMP'))
    <?php
    $laporan_occlusion = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'laporan_occlusion')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
    $flow_rate = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'laporan_flow_rate')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();

    $dataFlowRate = json_decode($flow_rate->data_sertifikat);
    $flow_rate = json_decode($flow_rate->data_laporan);
    $laporan_occlusion = json_decode($laporan_occlusion->data_laporan);



    // get chanel IDA
    $ida = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'channel-ida')
        ->first();
    $resolusi = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'resolusi')
        ->first();

    if ($ida->value == 1) {
        $slope = $dataFlowRate->slope_1;
        $intercept = $dataFlowRate->intercept_1;
        $uncert = $dataFlowRate->uc_1;
        $drift10 = $dataFlowRate->drift10_1;
        $drift50 = $dataFlowRate->drift50_1;
        $drift100 = $dataFlowRate->drift100_1;
        $drift500 = $dataFlowRate->drift500_1;
    } else {
        $slope = $dataFlowRate->slope_2;
        $intercept = $dataFlowRate->intercept_2;
        $uncert = $dataFlowRate->uc_2;
        $drift10 = $dataFlowRate->drift10_2;
        $drift50 = $dataFlowRate->drift50_2;
        $drift100 = $dataFlowRate->drift100_2;
        $drift500 = $dataFlowRate->drift500_2;
    }
    $satu = $laporan_occlusion->percobaan_1 * 0.0145;
    $dua = $laporan_occlusion->percobaan_2 * 0.0145;
    $tiga = $laporan_occlusion->percobaan_3 * 0.0145;
    $empat = $laporan_occlusion->percobaan_4 * 0.0145;
    $lima = $laporan_occlusion->percobaan_5 * 0.0145;
    $enam = $laporan_occlusion->percobaan_6 * 0.0145;
    $mean_occlusion = round(($satu + $dua + $tiga + $empat + $lima + $enam) / 6, 2);

    $satu1 = $flow_rate->percobaan1_1;
    $dua1 = $flow_rate->percobaan1_2;
    $tiga1 = $flow_rate->percobaan1_3;
    $empat1 = $flow_rate->percobaan1_4;
    $lima1 = $flow_rate->percobaan1_5;
    $enam1 = $flow_rate->percobaan1_6;
    $mean1 = ($satu1 + $dua1 + $tiga1 + $empat1 + $lima1 + $enam1) / 6;

    $meanTerkoreksi1 = $intercept + $slope * $mean1;
    $arr = [];
    array_push($arr, $satu1, $dua1, $tiga1, $empat1, $lima1, $enam1);
    // stdev
    $stdev = standard_deviation($arr);
    $koreksi = $meanTerkoreksi1 - 10;
    // hitung uncertainty
    $u95 = hitung_uncertainty($resolusi->value, $stdev, $uncert, $drift10);
    $absU95 = abs($koreksi) + $u95;
    $score = $absU95 < 1 ? 'Lulus' : 'Tidak';
    // 2
    $satu2 = $flow_rate->percobaan2_1;
    $dua2 = $flow_rate->percobaan2_2;
    $tiga2 = $flow_rate->percobaan2_3;
    $empat2 = $flow_rate->percobaan2_4;
    $lima2 = $flow_rate->percobaan2_5;
    $enam2 = $flow_rate->percobaan2_6;
    $mean2 = ($satu2 + $dua2 + $tiga2 + $empat2 + $lima2 + $enam2) / 6;
    $meanTerkoreksi2 = $intercept + $slope * $mean2;
    $arr2 = [];
    array_push($arr2, $satu2, $dua2, $tiga2, $empat2, $lima2, $enam2);
    // stdev
    $stdev2 = standard_deviation($arr2);
    $koreksi2 = $meanTerkoreksi2 - 50;
    $u952 = hitung_uncertainty($resolusi->value, $stdev2, $uncert, $drift50);
    $absU952 = abs($koreksi2) + $u952;
    $score2 = $absU952 < 5 ? 'Lulus' : 'Tidak';
    // 3
    $satu3 = $flow_rate->percobaan3_1;
    $dua3 = $flow_rate->percobaan3_2;
    $tiga3 = $flow_rate->percobaan3_3;
    $empat3 = $flow_rate->percobaan3_4;
    $lima3 = $flow_rate->percobaan3_5;
    $enam3 = $flow_rate->percobaan3_6;
    $mean3 = ($satu3 + $dua3 + $tiga3 + $empat3 + $lima3 + $enam3) / 6;
    $meanTerkoreksi3 = $intercept + $slope * $mean3;
    $arr3 = [];
    array_push($arr3, $satu3, $dua3, $tiga3, $empat3, $lima3, $enam3);
    // stdev
    $stdev3 = standard_deviation($arr3);
    $koreksi3 = $meanTerkoreksi3 - 100;
    $u953 = hitung_uncertainty($resolusi->value, $stdev3, $uncert, $drift100);
    $absU953 = abs($koreksi3) + $u953;
    $score3 = $absU953 < 10 ? 'Lulus' : 'Tidak';
    // 4 sini
    if ($nomenklatur->id == 10) {
        $satu4 = $flow_rate->percobaan4_1;
        $dua4 = $flow_rate->percobaan4_2;
        $tiga4 = $flow_rate->percobaan4_3;
        $empat4 = $flow_rate->percobaan4_4;
        $lima4 = $flow_rate->percobaan4_5;
        $enam4 = $flow_rate->percobaan4_6;
        $mean4 = ($satu4 + $dua4 + $tiga4 + $empat4 + $lima4 + $enam4) / 6;
        $meanTerkoreksi4 = $intercept + $slope * $mean4;
        $arr4 = [];
        array_push($arr4, $satu4, $dua4, $tiga4, $empat4, $lima4, $enam4);
        $stdev4 = standard_deviation($arr4);
        $koreksi4 = $meanTerkoreksi4 - 500;
        $u954 = hitung_uncertainty($resolusi->value, $stdev4, $uncert, $drift500);
        $absU954 = abs($koreksi4) + $u954;
        $score4 = $absU95 < 50 ? 'Lulus' : 'Tidak';
    }

    if ($nomenklatur->id == 10) {
        $pembagi = 4;
        $initScore = 0;
        if ($score == 'Lulus') {
            $initScore = $initScore + 1;
        }
        if ($score2 == 'Lulus') {
            $initScore = $initScore + 1;
        }
        if ($score3 == 'Lulus') {
            $initScore = $initScore + 1;
        }
        if ($score4 == 'Lulus') {
            $initScore = $initScore + 1;
        }
        $initScore = ($initScore / $pembagi) * 100;
    } elseif ($nomenklatur->id == 11) {
        $pembagi = 3;
        $initScore = 0;
        if ($score == 'Lulus') {
            $initScore = $initScore + 1;
        }
        if ($score2 == 'Lulus') {
            $initScore = $initScore + 1;
        }
        if ($score3 == 'Lulus') {
            $initScore = $initScore + 1;
        }
        $initScore = ($initScore / $pembagi) * 100;
    }
    $scoreOcc = $mean_occlusion < 20 ? 100 : 0;
    $totalAll = $score_fisik + $point + ($kinerja = $scoreOcc + $initScore) / 2 / 2;
    ?>
@elseif ($nomenklatur->id == config('nomenklatur.SPHYGMOMANOMETER'))
    <?php

    $laporan_kebocoran_tekanan = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'kebocoran_tekanan')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $laporan_kebocoran_tekanan = json_decode($laporan_kebocoran_tekanan->data_laporan);
    $resolusi = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'resolusi')
        ->first();

    $tekananHasil = $laporan_kebocoran_tekanan->value <= 15 ? 'Lulus' : 'Tidak Lulus';
    $scoreTekananHasil = $tekananHasil == 'Lulus' ? 20 : 0;
    // =====================
    $laporan_laju_buang_cepat = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'laju_buang_cepat')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $data_sertifikat = json_decode($laporan_laju_buang_cepat->data_sertifikat);
    $laporan_laju_buang_cepat = json_decode($laporan_laju_buang_cepat->data_laporan);

    $hitungLajuHasil = $data_sertifikat->intercept + $data_sertifikat->x_variable * $laporan_laju_buang_cepat->value;
    $lajuHasil = $hitungLajuHasil <= 10 ? 'Lulus' : 'Tidak Lulus';
    $scoreLajuHasil = $lajuHasil == 'Lulus' ? 20 : 0;
    // ======================
    $laporan_akurasi_tekanan = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'akurasi_tekanan')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $data_sertifikat_akurasi_tekanan = json_decode($laporan_akurasi_tekanan->data_sertifikat);
    $laporan_akurasi_tekanan = json_decode($laporan_akurasi_tekanan->data_laporan);
    // naik
    $percobaan0_1_naik = $laporan_akurasi_tekanan->percobaan0_1_naik;
    $percobaan0_2_naik = $laporan_akurasi_tekanan->percobaan0_2_naik;
    $percobaan0_3_naik = $laporan_akurasi_tekanan->percobaan0_3_naik;
    $meanNaik0 = ($percobaan0_1_naik + $percobaan0_2_naik + $percobaan0_3_naik) / 3;
    $meanterkoreksi0 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik0;

    $koreksi = $meanNaik0 - 0;
    // stdev
    $arr = [];
    array_push($arr, $percobaan0_1_naik, $percobaan0_2_naik, $percobaan0_3_naik);
    $stdev = standard_deviation($arr);
    // hitung uncertainty
    $u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_naik);
    $absU95 = abs($koreksi) + $u95;
    $score = $absU95 < 4 ? 'Lulus' : 'Tidak';

    $percobaan50_1_naik = $laporan_akurasi_tekanan->percobaan50_1_naik;
    $percobaan50_2_naik = $laporan_akurasi_tekanan->percobaan50_2_naik;
    $percobaan50_3_naik = $laporan_akurasi_tekanan->percobaan50_3_naik;
    $meanNaik50 = ($percobaan50_1_naik + $percobaan50_2_naik + $percobaan50_3_naik) / 3;
    $meanterkoreksi50 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik50;

    // stdev
    $arr2 = [];
    array_push($arr2, $percobaan50_1_naik, $percobaan50_2_naik, $percobaan50_3_naik);
    $stdev2 = standard_deviation($arr2);
    $koreksi2 = $meanterkoreksi50 - 50;
    // hitung uncertainty
    $u952 = hitung_uncertainty($resolusi->value, $stdev2, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_naik);
    $absU952 = abs($koreksi2) + $u952;
    $score2 = $absU952 < 4 ? 'Lulus' : 'Tidak';

    $percobaan100_1_naik = $laporan_akurasi_tekanan->percobaan100_1_naik;
    $percobaan100_2_naik = $laporan_akurasi_tekanan->percobaan100_2_naik;
    $percobaan100_3_naik = $laporan_akurasi_tekanan->percobaan100_3_naik;
    $meanNaik100 = ($percobaan100_1_naik + $percobaan100_2_naik + $percobaan100_3_naik) / 3;
    $meanterkoreksi100 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik100;
    // stdev
    $arr3 = [];
    array_push($arr3, $percobaan100_1_naik, $percobaan100_2_naik, $percobaan100_3_naik);
    $stdev3 = standard_deviation($arr3);
    $koreksi3 = $meanterkoreksi100 - 100;
    // hitung uncertainty
    $u953 = hitung_uncertainty($resolusi->value, $stdev3, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_naik);
    $absU953 = abs($koreksi3) + $u953;
    $score3 = $absU953 < 4 ? 'Lulus' : 'Tidak';

    $percobaan150_1_naik = $laporan_akurasi_tekanan->percobaan150_1_naik;
    $percobaan150_2_naik = $laporan_akurasi_tekanan->percobaan150_2_naik;
    $percobaan150_3_naik = $laporan_akurasi_tekanan->percobaan150_3_naik;
    $meanNaik150 = ($percobaan150_1_naik + $percobaan150_2_naik + $percobaan150_3_naik) / 3;
    $meanterkoreksi150 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik150;
    // stdev
    $arr4 = [];
    array_push($arr4, $percobaan150_1_naik, $percobaan150_2_naik, $percobaan150_3_naik);
    $stdev4 = standard_deviation($arr4);
    $koreksi4 = $meanterkoreksi150 - 150;
    // hitung uncertainty
    $u954 = hitung_uncertainty($resolusi->value, $stdev4, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_naik);
    $absU954 = abs($koreksi4) + $u954;
    $score4 = $absU954 < 4 ? 'Lulus' : 'Tidak';

    $percobaan200_1_naik = $laporan_akurasi_tekanan->percobaan200_1_naik;
    $percobaan200_2_naik = $laporan_akurasi_tekanan->percobaan200_2_naik;
    $percobaan200_3_naik = $laporan_akurasi_tekanan->percobaan200_3_naik;
    $meanNaik200 = ($percobaan200_1_naik + $percobaan200_2_naik + $percobaan200_3_naik) / 3;
    $meanterkoreksi200 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik200;
    // stdev
    $arr5 = [];
    array_push($arr5, $percobaan200_1_naik, $percobaan200_2_naik, $percobaan200_3_naik);
    $stdev5 = standard_deviation($arr5);
    $koreksi5 = $meanterkoreksi200 - 200;
    // hitung uncertainty
    $u955 = hitung_uncertainty($resolusi->value, $stdev5, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_naik);
    $absU955 = abs($koreksi5) + $u955;
    $score5 = $absU955 < 4 ? 'Lulus' : 'Tidak';

    $percobaan250_1_naik = $laporan_akurasi_tekanan->percobaan250_1_naik;
    $percobaan250_2_naik = $laporan_akurasi_tekanan->percobaan250_2_naik;
    $percobaan250_3_naik = $laporan_akurasi_tekanan->percobaan250_3_naik;
    $meanNaik250 = ($percobaan250_1_naik + $percobaan250_2_naik + $percobaan250_3_naik) / 3;
    $meanterkoreksi250 = $data_sertifikat_akurasi_tekanan->intercept_naik + $data_sertifikat_akurasi_tekanan->x_variable_naik * $meanNaik250;
    // stdev
    $arr6 = [];
    array_push($arr6, $percobaan250_1_naik, $percobaan250_2_naik, $percobaan250_3_naik);
    $stdev6 = standard_deviation($arr6);
    $koreksi6 = $meanterkoreksi250 - 250;
    // hitung uncertainty
    $u956 = hitung_uncertainty($resolusi->value, $stdev6, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_naik);
    $absU956 = abs($koreksi6) + $u956;
    $score6 = $absU956 < 4 ? 'Lulus' : 'Tidak';

    // turun
    $percobaan250_1_turun = $laporan_akurasi_tekanan->percobaan250_1_turun;
    $percobaan250_2_turun = $laporan_akurasi_tekanan->percobaan250_2_turun;
    $percobaan250_3_turun = $laporan_akurasi_tekanan->percobaan250_3_turun;
    $meanTurun250 = ($percobaan250_1_turun + $percobaan250_2_turun + $percobaan250_3_turun) / 3;
    $meanterkoreksiTurun250 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun250;
    // stdev
    $arr7 = [];
    array_push($arr7, $percobaan250_1_turun, $percobaan250_2_turun, $percobaan250_3_turun);
    $stdev7 = standard_deviation($arr7);
    $koreksi7 = $meanterkoreksiTurun250 - 250;
    // hitung uncertainty
    $u957 = hitung_uncertainty($resolusi->value, $stdev7, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_turun);
    $absU957 = abs($koreksi7) + $u957;
    $score7 = $absU957 < 4 ? 'Lulus' : 'Tidak';

    $percobaan200_1_turun = $laporan_akurasi_tekanan->percobaan200_1_turun;
    $percobaan200_2_turun = $laporan_akurasi_tekanan->percobaan200_2_turun;
    $percobaan200_3_turun = $laporan_akurasi_tekanan->percobaan200_3_turun;
    $meanTurun200 = ($percobaan200_1_turun + $percobaan200_2_turun + $percobaan200_3_turun) / 3;
    $meanterkoreksiTurun200 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun200;
    // stdev
    $arr8 = [];
    array_push($arr8, $percobaan200_1_turun, $percobaan200_2_turun, $percobaan200_3_turun);
    $stdev8 = standard_deviation($arr8);
    $koreksi8 = $meanterkoreksiTurun200 - 200;
    // hitung uncertainty
    $u958 = hitung_uncertainty($resolusi->value, $stdev8, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_turun);
    $absU958 = abs($koreksi8) + $u958;
    $score8 = $absU958 < 4 ? 'Lulus' : 'Tidak';

    $percobaan150_1_turun = $laporan_akurasi_tekanan->percobaan150_1_turun;
    $percobaan150_2_turun = $laporan_akurasi_tekanan->percobaan150_2_turun;
    $percobaan150_3_turun = $laporan_akurasi_tekanan->percobaan150_3_turun;
    $meanTurun150 = ($percobaan150_1_turun + $percobaan150_2_turun + $percobaan150_3_turun) / 3;
    $meanterkoreksiTurun150 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun150;
    // stdev
    $arr9 = [];
    array_push($arr9, $percobaan150_1_turun, $percobaan150_2_turun, $percobaan150_3_turun);
    $stdev9 = standard_deviation($arr9);
    $koreksi9 = $meanterkoreksiTurun150 - 150;
    // hitung uncertainty
    $u959 = hitung_uncertainty($resolusi->value, $stdev9, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_turun);
    $absU959 = abs($koreksi9) + $u959;
    $score9 = $absU959 < 4 ? 'Lulus' : 'Tidak';

    $percobaan100_1_turun = $laporan_akurasi_tekanan->percobaan100_1_turun;
    $percobaan100_2_turun = $laporan_akurasi_tekanan->percobaan100_2_turun;
    $percobaan100_3_turun = $laporan_akurasi_tekanan->percobaan100_3_turun;
    $meanTurun100 = ($percobaan100_1_turun + $percobaan100_2_turun + $percobaan100_3_turun) / 3;
    $meanterkoreksiTurun100 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun100;
    // stdev
    $arr10 = [];
    array_push($arr10, $percobaan100_1_turun, $percobaan100_2_turun, $percobaan100_3_turun);
    $stdev10 = standard_deviation($arr10);
    $koreksi10 = $meanterkoreksiTurun100 - 100;
    // hitung uncertainty
    $u9510 = hitung_uncertainty($resolusi->value, $stdev10, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_turun);
    $absU9510 = abs($koreksi10) + $u9510;
    $score10 = $absU9510 < 4 ? 'Lulus' : 'Tidak';

    $percobaan50_1_turun = $laporan_akurasi_tekanan->percobaan50_1_turun;
    $percobaan50_2_turun = $laporan_akurasi_tekanan->percobaan50_2_turun;
    $percobaan50_3_turun = $laporan_akurasi_tekanan->percobaan50_3_turun;
    $meanTurun50 = ($percobaan50_1_turun + $percobaan50_2_turun + $percobaan50_3_turun) / 3;
    $meanterkoreksiTurun50 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun50;
    // stdev
    $arr11 = [];
    array_push($arr11, $percobaan50_1_turun, $percobaan50_2_turun, $percobaan50_3_turun);
    $stdev11 = standard_deviation($arr11);
    $koreksi11 = $meanterkoreksiTurun50 - 50;
    // hitung uncertainty
    $u9511 = hitung_uncertainty($resolusi->value, $stdev11, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_turun);
    $absU9511 = abs($koreksi11) + $u9511;
    $score11 = $absU9511 < 4 ? 'Lulus' : 'Tidak';

    $percobaan0_1_turun = $laporan_akurasi_tekanan->percobaan0_1_turun;
    $percobaan0_2_turun = $laporan_akurasi_tekanan->percobaan0_2_turun;
    $percobaan0_3_turun = $laporan_akurasi_tekanan->percobaan0_3_turun;
    $meanTurun0 = ($percobaan0_1_turun + $percobaan0_2_turun + $percobaan0_3_turun) / 3;
    $meanterkoreksiTurun0 = $data_sertifikat_akurasi_tekanan->intercept_turun + $data_sertifikat_akurasi_tekanan->x_variable_turun * $meanTurun0;
    // stdev
    $arr12 = [];
    array_push($arr12, $percobaan0_1_turun, $percobaan0_2_turun, $percobaan0_3_turun);
    $stdev12 = standard_deviation($arr12);
    $koreksi12 = $meanterkoreksiTurun0 - 00;
    // hitung uncertainty
    $u9512 = hitung_uncertainty($resolusi->value, $stdev12, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_turun);
    $absU9512 = abs($koreksi12) + $u9512;
    $score12 = $absU9512 < 4 ? 'Lulus' : 'Tidak';

    $pembagi = 12;
    $initScore = 0;
    if ($score == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score2 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score3 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score4 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score5 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score6 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score7 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score8 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score9 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score10 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score11 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    if ($score12 == 'Lulus') {
        $initScore = $initScore + 1;
    }
    $initScore = (($initScore / $pembagi) * 100) / 2;
    $totalAll = $score_fisik + $scoreTekananHasil + $scoreLajuHasil + $initScore;
    ?>
@elseif($nomenklatur->id == config('nomenklatur.INKUBATOR_LABORATORIUM'))
@if ($count_laporan_pengukuran_keselamatan_listrik > 0)
    <?php
    $cek = json_decode(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->data_sertifikat);
    $hitungPhaseNetral = round($cek->intercept1 + $cek->x_variable1 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value, 2);

    $hitungPhaseGround = round($cek->intercept3 + $cek->x_variable3 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value, 2);

    $hitungGroundNetral = round($cek->intercept2 + $cek->x_variable2 * get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value, 2);

    $dps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-dapat-dilepas-dps')->value;
    $nps = get_data_litsrik($laporan->no_laporan, 'slug', 'kabel-tidak-dapat-dilepas-nps')->value;
    $isolasi = get_data_litsrik($laporan->no_laporan, 'slug', 'resistansi-isolasi')->value;
    $bf = get_data_litsrik($laporan->no_laporan, 'slug', 'kelas-i-tipe-bbfcf')->value;

    $lulus = 0;
    if ($hitungPhaseNetral > 198) {
        $lulus = $lulus + 1;
    }

    if ($hitungPhaseGround > 198) {
        $lulus = $lulus + 1;
    }
    if ($hitungGroundNetral < 5) {
        $lulus = $lulus + 1;
    }
    if ($dps <= 0.2) {
        $lulus = $lulus + 1;
    }
    if ($nps <= 0.3) {
        $lulus = $lulus + 1;
    }
    if ($isolasi > 2) {
        $lulus = $lulus + 1;
    }
    if ($bf <= 500) {
        $lulus = $lulus + 1;
    }

    $point = round(($lulus / 7) * 40);
    ?>
    <?php

    $resolusi = DB::table('laporan_pendataan_administrasi')
        ->where('no_laporan', $laporan->no_laporan)
        ->where('slug', 'resolusi')
        ->first();
    // ======================
    $laporan_sensor_recorder = DB::table('laporan_kinerja')
        ->where('type_laporan_kinerja', 'sensor_recorder')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $data_sertifikat = json_decode($laporan_sensor_recorder->data_sertifikat);
    $data_laporan = json_decode($laporan_sensor_recorder->data_laporan);
    // start from Min
    $posisi_sensor = $data_laporan->posisi_sensor;
    $setting_1_min = $data_laporan->posisi_sensor;
    $setting_1_max = $data_laporan->posisi_sensor;
    $setting_2_min = $data_laporan->posisi_sensor;
    $setting_2_max = $data_laporan->posisi_sensor;
    $setting_3_min = $data_laporan->posisi_sensor;
    $setting_3_max = $data_laporan->posisi_sensor;
    $setting_mean_min = ($setting_1_min + $setting_2_min + $setting_3_min  )/3;
    $setting_mean_max = ($setting_1_max + $setting_2_max + $setting_3_max  )/3;

    // 1
    // Min
    $percobaan1_1_min = $data_laporan->percobaan1_1_min;
    $percobaan1_2_min = $data_laporan->percobaan1_2_min;
    $percobaan1_3_min = $data_laporan->percobaan1_3_min;
    $mean_1_min = ($percobaan1_1_min + $percobaan1_2_min + $percobaan1_3_min) / 3;
    $mean_terkoreksi_1_min = $data_sertifikat->intercept_1 + $data_sertifikat->slope_1 * $mean_1_min;
    // Max
    $percobaan1_1_max = $data_laporan->percobaan1_1_max;
    $percobaan1_2_max = $data_laporan->percobaan1_2_max;
    $percobaan1_3_max = $data_laporan->percobaan1_3_max;
    $mean_1_max = ($percobaan1_1_max + $percobaan1_2_max + $percobaan1_3_max) / 3;
    $mean_terkoreksi_1_max = $data_sertifikat->intercept_1 + $data_sertifikat->slope_1 * $mean_1_max;
    $t1 =$mean_terkoreksi_1_max - $mean_terkoreksi_1_min;
    $mid1 =($mean_terkoreksi_1_max + $mean_terkoreksi_1_min)/2;
    // 2
    // Min
    $percobaan2_1_min = $data_laporan->percobaan2_1_min;
    $percobaan2_2_min = $data_laporan->percobaan2_2_min;
    $percobaan2_3_min = $data_laporan->percobaan2_3_min;
    $mean_2_min = ($percobaan2_1_min + $percobaan2_2_min + $percobaan2_3_min) / 3;
    $mean_terkoreksi_2_min = $data_sertifikat->intercept_2 + $data_sertifikat->slope_2 * $mean_2_min;
    // Max
    $percobaan2_1_max = $data_laporan->percobaan2_1_max;
    $percobaan2_2_max = $data_laporan->percobaan2_2_max;
    $percobaan2_3_max = $data_laporan->percobaan2_3_max;
    $mean_2_max = ($percobaan2_1_max + $percobaan2_2_max + $percobaan2_3_max) / 3;
    $mean_terkoreksi_2_max = $data_sertifikat->intercept_2 + $data_sertifikat->slope_2 * $mean_2_max;
    $t2 =$mean_terkoreksi_2_max - $mean_terkoreksi_2_min;
    $mid2 =($mean_terkoreksi_2_max + $mean_terkoreksi_2_min)/2;

    // 3
    // Min
    $percobaan3_1_min = $data_laporan->percobaan3_1_min;
    $percobaan3_2_min = $data_laporan->percobaan3_2_min;
    $percobaan3_3_min = $data_laporan->percobaan3_3_min;
    $mean_3_min = ($percobaan3_1_min + $percobaan3_2_min + $percobaan3_3_min) / 3;
    $mean_terkoreksi_3_min = $data_sertifikat->intercept_3 + $data_sertifikat->slope_3 * $mean_3_min;
    // Max
    $percobaan3_1_max = $data_laporan->percobaan3_1_max;
    $percobaan3_2_max = $data_laporan->percobaan3_2_max;
    $percobaan3_3_max = $data_laporan->percobaan3_3_max;
    $mean_3_max = ($percobaan3_1_max + $percobaan3_2_max + $percobaan3_3_max) / 3;
    $mean_terkoreksi_3_max = $data_sertifikat->intercept_3 + $data_sertifikat->slope_3 * $mean_3_max;
    $t3 =$mean_terkoreksi_3_max - $mean_terkoreksi_3_min;
    $mid3 =($mean_terkoreksi_3_max + $mean_terkoreksi_3_min)/2;

    // 4
    // Min
    $percobaan4_1_min = $data_laporan->percobaan4_1_min;
    $percobaan4_2_min = $data_laporan->percobaan4_2_min;
    $percobaan4_3_min = $data_laporan->percobaan4_3_min;
    $mean_4_min = ($percobaan4_1_min + $percobaan4_2_min + $percobaan4_3_min) / 3;
    $mean_terkoreksi_4_min = $data_sertifikat->intercept_4 + $data_sertifikat->slope_4 * $mean_4_min;
    // Max
    $percobaan4_1_max = $data_laporan->percobaan4_1_max;
    $percobaan4_2_max = $data_laporan->percobaan4_2_max;
    $percobaan4_3_max = $data_laporan->percobaan4_3_max;
    $mean_4_max = ($percobaan4_1_max + $percobaan4_2_max + $percobaan4_3_max) / 3;
    $mean_terkoreksi_4_max = $data_sertifikat->intercept_4 + $data_sertifikat->slope_4 * $mean_4_max;
    $t4 =$mean_terkoreksi_4_max - $mean_terkoreksi_4_min;
    $mid4 =($mean_terkoreksi_4_max + $mean_terkoreksi_4_min)/2;

    // 5
    // Min
    $percobaan5_1_min = $data_laporan->percobaan5_1_min;
    $percobaan5_2_min = $data_laporan->percobaan5_2_min;
    $percobaan5_3_min = $data_laporan->percobaan5_3_min;
    $mean_5_min = ($percobaan5_1_min + $percobaan5_2_min + $percobaan5_3_min) / 3;
    $mean_terkoreksi_5_min = $data_sertifikat->intercept_5 + $data_sertifikat->slope_5 * $mean_5_min;
    // Max
    $percobaan5_1_max = $data_laporan->percobaan5_1_max;
    $percobaan5_2_max = $data_laporan->percobaan5_2_max;
    $percobaan5_3_max = $data_laporan->percobaan5_3_max;
    $mean_5_max = ($percobaan5_1_max + $percobaan5_2_max + $percobaan5_3_max) / 3;
    $mean_terkoreksi_5_max = $data_sertifikat->intercept_5 + $data_sertifikat->slope_5 * $mean_5_max;
    $t5 =$mean_terkoreksi_5_max - $mean_terkoreksi_5_min;
    $mid5 =($mean_terkoreksi_5_max + $mean_terkoreksi_5_min)/2;

    // 6
    // Min
    $percobaan6_1_min = $data_laporan->percobaan6_1_min;
    $percobaan6_2_min = $data_laporan->percobaan6_2_min;
    $percobaan6_3_min = $data_laporan->percobaan6_3_min;
    $mean_6_min = ($percobaan6_1_min + $percobaan6_2_min + $percobaan6_3_min) / 3;
    $mean_terkoreksi_6_min = $data_sertifikat->intercept_6 + $data_sertifikat->slope_6 * $mean_6_min;
    // Max
    $percobaan6_1_max = $data_laporan->percobaan6_1_max;
    $percobaan6_2_max = $data_laporan->percobaan6_2_max;
    $percobaan6_3_max = $data_laporan->percobaan6_3_max;
    $mean_6_max = ($percobaan6_1_max + $percobaan6_2_max + $percobaan6_3_max) / 3;
    $mean_terkoreksi_6_max = $data_sertifikat->intercept_6 + $data_sertifikat->slope_6 * $mean_6_max;
    $t6 =$mean_terkoreksi_6_max - $mean_terkoreksi_6_min;
    $mid6 =($mean_terkoreksi_6_max + $mean_terkoreksi_6_min)/2;

    // 7
    // Min
    $percobaan7_1_min = $data_laporan->percobaan7_1_min;
    $percobaan7_2_min = $data_laporan->percobaan7_2_min;
    $percobaan7_3_min = $data_laporan->percobaan7_3_min;
    $mean_7_min = ($percobaan7_1_min + $percobaan7_2_min + $percobaan7_3_min) / 3;
    $mean_terkoreksi_7_min = $data_sertifikat->intercept_7 + $data_sertifikat->slope_7 * $mean_7_min;
    // Max
    $percobaan7_1_max = $data_laporan->percobaan7_1_max;
    $percobaan7_2_max = $data_laporan->percobaan7_2_max;
    $percobaan7_3_max = $data_laporan->percobaan7_3_max;
    $mean_7_max = ($percobaan7_1_max + $percobaan7_2_max + $percobaan7_3_max) / 3;
    $mean_terkoreksi_7_max = $data_sertifikat->intercept_7 + $data_sertifikat->slope_7 * $mean_7_max;
    $t7 =$mean_terkoreksi_7_max - $mean_terkoreksi_7_min;
    $mid7 =($mean_terkoreksi_7_max + $mean_terkoreksi_7_min)/2;

    // 8
    // Min
    $percobaan8_1_min = $data_laporan->percobaan8_1_min;
    $percobaan8_2_min = $data_laporan->percobaan8_2_min;
    $percobaan8_3_min = $data_laporan->percobaan8_3_min;
    $mean_8_min = ($percobaan8_1_min + $percobaan8_2_min + $percobaan8_3_min) / 3;
    $mean_terkoreksi_8_min = $data_sertifikat->intercept_8 + $data_sertifikat->slope_8 * $mean_8_min;
    // Max
    $percobaan8_1_max = $data_laporan->percobaan8_1_max;
    $percobaan8_2_max = $data_laporan->percobaan8_2_max;
    $percobaan8_3_max = $data_laporan->percobaan8_3_max;
    $mean_8_max = ($percobaan8_1_max + $percobaan8_2_max + $percobaan8_3_max) / 3;
    $mean_terkoreksi_8_max = $data_sertifikat->intercept_8 + $data_sertifikat->slope_8 * $mean_8_max;
    $t8 =$mean_terkoreksi_8_max - $mean_terkoreksi_8_min;
    $mid8 =($mean_terkoreksi_8_max + $mean_terkoreksi_8_min)/2;

    // 9
    // Min
    $percobaan9_1_min = $data_laporan->percobaan9_1_min;
    $percobaan9_2_min = $data_laporan->percobaan9_2_min;
    $percobaan9_3_min = $data_laporan->percobaan9_3_min;
    $mean_9_min = ($percobaan9_1_min + $percobaan9_2_min + $percobaan9_3_min) / 3;
    $mean_terkoreksi_9_min = $data_sertifikat->intercept_9 + $data_sertifikat->slope_9 * $mean_9_min;
    // Max
    $percobaan9_1_max = $data_laporan->percobaan9_1_max;
    $percobaan9_2_max = $data_laporan->percobaan9_2_max;
    $percobaan9_3_max = $data_laporan->percobaan9_3_max;
    $mean_9_max = ($percobaan9_1_max + $percobaan9_2_max + $percobaan9_3_max) / 3;
    $mean_terkoreksi_9_max = $data_sertifikat->intercept_9 + $data_sertifikat->slope_9 * $mean_9_max;
    $t9 =$mean_terkoreksi_9_max - $mean_terkoreksi_9_min;
    $mid9 =($mean_terkoreksi_9_max + $mean_terkoreksi_9_min)/2;

    // analisa
    $arryMid =[];
    array_push($arryMid,$mid1,$mid2,$mid3,$mid4,$mid5,$mid6,$mid7,$mid8,$mid9);
    $maxArr = max($arryMid);
    $minArr = min($arryMid);

    $suhu_alat_dari_penunjukan_indikator = ($setting_mean_min + $setting_mean_max )/2;
    $suhu_alat_dari_hasil_pengukuran =($maxArr + $minArr ) /2 ;
    $variasi_suhu_spasial =$maxArr - $minArr ;

    $arryT =[];
    array_push($arryT,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9);
    $variasi_suhu_temporal = max($arryT) ;
    $arryMeanMax = [];
    array_push($arryMeanMax,$mean_terkoreksi_1_max,$mean_terkoreksi_2_max,$mean_terkoreksi_3_max,$mean_terkoreksi_4_max,$mean_terkoreksi_5_max,$mean_terkoreksi_6_max,$mean_terkoreksi_7_max,$mean_terkoreksi_8_max,$mean_terkoreksi_9_max);
    $arryMeanMin = [];
    array_push($arryMeanMin,$mean_terkoreksi_1_min,$mean_terkoreksi_2_min,$mean_terkoreksi_3_min,$mean_terkoreksi_4_min,$mean_terkoreksi_5_min,$mean_terkoreksi_6_min,$mean_terkoreksi_7_min,$mean_terkoreksi_8_min,$mean_terkoreksi_9_min);
    $variasi_suhu_total = max($arryMeanMax) - min($arryMeanMin);

    $x = json_decode($laporan_kondisi_lingkungan->data_laporan);
    $y = json_decode($laporan_kondisi_lingkungan->data_sertifikat);
    $suhu_ruang = ($x->suhu_awal + $x->suhu_akhir) / 2 ;
    $abs_suhu_ruangan = abs($variasi_suhu_total);
    $koreksi =round($y->intercept_suhu + ($y->x_variable_suhu * $suhu_ruang), 2);
    $abs_koreksi = abs($koreksi);
    $score_abs_suhu_ruangan = $abs_suhu_ruangan < 3 ? 100 : 0;
    $score_abs_koreksi = $abs_koreksi < 1.5 ? 100 : 0;
    $score_kinerja = ($score_abs_suhu_ruangan + $score_abs_koreksi ) /2;

    $totalAll = $score_fisik + $point + $score_kinerja;

    ?>
@endif

@endif
<body>
    <img src="{{ asset('template_sertifikat/assets/img/logo-bg.jpg') }}" class="img-fluid" width="590"
        style="position: absolute; top: 350px; left: 40px; z-index: -1; opacity: 0.05;" alt="Responsive image">
    <div class="wrapper">
        <img src="{{ asset('template_sertifikat/assets/img/header-icon-2.png') }}" class="img-fluid" width="350"
            alt="Responsive image">
        <div>
            <h3 class="mt-3 mb-0 w-100"
                style="letter-spacing: 2px; font-size: 40px; font-weight: bold; text-align: center; display: inline-block;transform: scale(.85, 1); color: #6f4a13; text-decoration: underline;">
                SERTIFIKAT KALIBRASI</h3>
            <p class="text-center mt-0 mb-1" style="font-size: 20px;">Sertificate Of Calibration</p>
            <h4 class="text-center w-100"
                style="font-family: 'Times New Roman', Times, serif; font-size: 30px; font-weight: bold; text-align: center;">
                {{ $laporan->no_laporan }}</h4>
        </div>

        <div class="mt-4">
            <table style="font-family: 'Times New Roman', Times, serif;" style="width: 100%">
                <tr>
                    <td colspan="3">
                        <h4 class="title-row mb-0" style="text-decoration: underline;">IDENTITAS PEMILIK</h4>
                        <p class="subtitle-row mt-0">Owner Identification</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Nama</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Name</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">{{ $faskes->nama_faskes }}</td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Alamat</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Address</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">{{ $faskes->alamat }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-3">
                        <h4 class="title-row mb-0" style="text-decoration: underline;">IDENTITAS ALAT</h4>
                        <p class="subtitle-row mt-0">Instrument Identification</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Nama</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Name</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">{{ $nomenklatur->nama_nomenklatur }}
                    </td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Merk/Tipe</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Brand/Type</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">{{ $merk }}</td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Nomor Seri</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Serial Number</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">{{ $sn }}</td>
                </tr>
                <tr>
                    <td class="va-top" width="37%">
                        <h4 class="data-title-row mb-0 ml-4">Hasil Pengujian/Kalibrasi</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Result</p>
                    </td>
                    <td class="va-top" width="3%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">
                        @if ($totalAll >= 70)
                            LAIK PAKAI
                            <br>berlaku s/d :
                            {{ tanggal_indonesia(date('Y-m-d', strtotime('+1 year', strtotime($tgl)))) }}
                        @else
                            <span style="color: red">TIDAK LAIK PAKAI</span>
                        @endif
                    </td>
                </tr>
            </table>

            <table class="w-50 ml-auto mt-4" style="font-family: 'Times New Roman', Times, serif;">
                <tr>
                    <td class="va-top p-0" width="30%">
                        <h4 class="data-title-row mb-0 ml-4">Sertifikat ini terdiri dari : 1 Halaman</h4>
                        <p class="data-subtitle-row mt-0 ml-4">This certificate comprises of x pages</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top p-0">
                        <h4 class="data-title-row mb-0 ml-4">Diterbitkan tanggal {{ tanggal_indonesia($tgl) }}</h4>
                        <p class="data-subtitle-row mt-0 ml-4">Date of issue</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top text-center">
                        <h4 class="data-title-row mb-0 ml-4">Direktur</h4>
                    </td>
                </tr>
                <tr>
                    <td class="text-center p-2">
                        <img src="{{ asset('template_sertifikat/assets/img/logo-head.webp') }}" class="img-fluid ml-4"
                            width="200" style="opacity: 0.5;" alt="Responsive image">
                    </td>
                </tr>
                <tr>
                    <td class="va-top text-center">
                        <h4 class="data-title-row mb-0 ml-4">YUDI SUSANTO, ST</h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="position: absolute; bottom: 0; width: 100%;">
        <p style="font-size: 10px;" class="text-center mb-0">Tidak dibenarkan mengutip/memperbanyak dan/atau
            mempublikasikan sebagian sertifikat ini tanpa izin PT. Mitra Tera Akurasi</p>
        <p style="font-size: 10px;" class="text-center font-italic">Not allowed to quote/reproduce and/or publish part
            of the contents of this certificate without permission of PT. Mitra Tera Akurasi</p>
        <p class="mt-2 text-center" style="line-spacing: 0; font-size: 14px; font-weight: semi-bold;">
            Graha Mas Fatmawati Blok A.35 Jl. RS. Fatmawati, Kebayoran Baru, Jakarta Selatan 12150<br>
            Telp : 021-29126198, Fax : 021-29126199, Email : info.mitrateraakurasi@gmail.com
        </p>
    </div>
    <div class="bar-left-top-1 bar"></div>
    <div class="bar-left-top-2 bar"></div>
    <div class="bar-right-top-1 bar"></div>
    <div class="bar-right-top-2 bar"></div>
    <div class="bar-right-bottom-1 bar"></div>
    <div class="bar-right-bottom-2 bar"></div>
    <div class="bar-left-bottom-1 bar"></div>
    <div class="bar-left-bottom-2 bar"></div>
</body>

</html>
