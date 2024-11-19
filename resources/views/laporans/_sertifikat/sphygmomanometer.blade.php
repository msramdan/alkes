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
$u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_naik,6);
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
$u952 = hitung_uncertainty($resolusi->value, $stdev2, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_naik,6);
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
$u953 = hitung_uncertainty($resolusi->value, $stdev3, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_naik,6);
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
$u954 = hitung_uncertainty($resolusi->value, $stdev4, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_naik,6);
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
$u955 = hitung_uncertainty($resolusi->value, $stdev5, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_naik,6);
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
$u956 = hitung_uncertainty($resolusi->value, $stdev6, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_naik,6);
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
$u957 = hitung_uncertainty($resolusi->value, $stdev7, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift250_turun,6);
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
$u958 = hitung_uncertainty($resolusi->value, $stdev8, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift200_turun,6);
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
$u959 = hitung_uncertainty($resolusi->value, $stdev9, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift150_turun,6);
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
$u9510 = hitung_uncertainty($resolusi->value, $stdev10, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift100_turun,6);
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
$u9511 = hitung_uncertainty($resolusi->value, $stdev11, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift50_turun,6);
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
$u9512 = hitung_uncertainty($resolusi->value, $stdev12, $data_sertifikat_akurasi_tekanan->uc, $data_sertifikat_akurasi_tekanan->drift0_turun,6);
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
<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat {{ $laporan->no_laporan }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma35MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('template_sertifikat/assets/css/custom.css') }}">
</head>
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
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">
                        {{ $nomenklatur->nama_nomenklatur }}
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
                        <img src="{{ asset('template_sertifikat/assets/img/logo-head.webp') }}"
                            class="img-fluid ml-4" width="200" style="opacity: 0.5;" alt="Responsive image">
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
