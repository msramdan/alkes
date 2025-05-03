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
$setting_mean_min = ($setting_1_min + $setting_2_min + $setting_3_min) / 3;
$setting_mean_max = ($setting_1_max + $setting_2_max + $setting_3_max) / 3;

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
$t1 = $mean_terkoreksi_1_max - $mean_terkoreksi_1_min;
$mid1 = ($mean_terkoreksi_1_max + $mean_terkoreksi_1_min) / 2;
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
$t2 = $mean_terkoreksi_2_max - $mean_terkoreksi_2_min;
$mid2 = ($mean_terkoreksi_2_max + $mean_terkoreksi_2_min) / 2;

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
$t3 = $mean_terkoreksi_3_max - $mean_terkoreksi_3_min;
$mid3 = ($mean_terkoreksi_3_max + $mean_terkoreksi_3_min) / 2;

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
$t4 = $mean_terkoreksi_4_max - $mean_terkoreksi_4_min;
$mid4 = ($mean_terkoreksi_4_max + $mean_terkoreksi_4_min) / 2;

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
$t5 = $mean_terkoreksi_5_max - $mean_terkoreksi_5_min;
$mid5 = ($mean_terkoreksi_5_max + $mean_terkoreksi_5_min) / 2;

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
$t6 = $mean_terkoreksi_6_max - $mean_terkoreksi_6_min;
$mid6 = ($mean_terkoreksi_6_max + $mean_terkoreksi_6_min) / 2;

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
$t7 = $mean_terkoreksi_7_max - $mean_terkoreksi_7_min;
$mid7 = ($mean_terkoreksi_7_max + $mean_terkoreksi_7_min) / 2;

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
$t8 = $mean_terkoreksi_8_max - $mean_terkoreksi_8_min;
$mid8 = ($mean_terkoreksi_8_max + $mean_terkoreksi_8_min) / 2;

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
$t9 = $mean_terkoreksi_9_max - $mean_terkoreksi_9_min;
$mid9 = ($mean_terkoreksi_9_max + $mean_terkoreksi_9_min) / 2;

// analisa
$arryMid = [];
array_push($arryMid, $mid1, $mid2, $mid3, $mid4, $mid5, $mid6, $mid7, $mid8, $mid9);
$maxArr = max($arryMid);
$minArr = min($arryMid);

$suhu_alat_dari_penunjukan_indikator = ($setting_mean_min + $setting_mean_max) / 2;
$suhu_alat_dari_hasil_pengukuran = ($maxArr + $minArr) / 2;
$variasi_suhu_spasial = $maxArr - $minArr;

$arryT = [];
array_push($arryT, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9);
$variasi_suhu_temporal = max($arryT);
$arryMeanMax = [];
array_push($arryMeanMax, $mean_terkoreksi_1_max, $mean_terkoreksi_2_max, $mean_terkoreksi_3_max, $mean_terkoreksi_4_max, $mean_terkoreksi_5_max, $mean_terkoreksi_6_max, $mean_terkoreksi_7_max, $mean_terkoreksi_8_max, $mean_terkoreksi_9_max);
$arryMeanMin = [];
array_push($arryMeanMin, $mean_terkoreksi_1_min, $mean_terkoreksi_2_min, $mean_terkoreksi_3_min, $mean_terkoreksi_4_min, $mean_terkoreksi_5_min, $mean_terkoreksi_6_min, $mean_terkoreksi_7_min, $mean_terkoreksi_8_min, $mean_terkoreksi_9_min);
$variasi_suhu_total = max($arryMeanMax) - min($arryMeanMin);

$x = json_decode($laporan_kondisi_lingkungan->data_laporan);
$y = json_decode($laporan_kondisi_lingkungan->data_sertifikat);
$suhu_ruang = ($x->suhu_awal + $x->suhu_akhir) / 2;
$abs_suhu_ruangan = abs($variasi_suhu_total);
$koreksi = round($y->intercept_suhu + $y->x_variable_suhu * $suhu_ruang, 2);
$abs_koreksi = abs($koreksi);
$score_abs_suhu_ruangan = $abs_suhu_ruangan < 3 ? 100 : 0;
$score_abs_koreksi = $abs_koreksi < 1.5 ? 100 : 0;
$score_kinerja = ($score_abs_suhu_ruangan + $score_abs_koreksi) / 2;
$totalAll = $score_fisik + $point + $score_kinerja;
?>
@endif
<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat {{ $laporan->no_sertifikat ?? '-' }}</title>
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
                {{ $laporan->no_sertifikat ?? '-' }}</h4>
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
