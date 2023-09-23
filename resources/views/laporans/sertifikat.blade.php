<!DOCTYPE html>
<html>

<head>
    <title>Laporan Sertifikat {{ $laporan->no_laporan }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma35MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('template_sertifikat/assets/css/custom.css') }}">
</head>

@if ($count_laporan_pengukuran_keselamatan_listrik > 0)
    <?php
    $hitungPhaseNetral = round(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->intercept1 + get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->x_variable1 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-netral')->value, 2);

    $hitungPhaseGround = round(get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->intercept3 + get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->x_variable3 * get_data_litsrik($laporan->no_laporan, 'slug', 'phase-ground')->value, 2);

    $hitungGroundNetral = round(get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->intercept2 + get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->x_variable2 * get_data_litsrik($laporan->no_laporan, 'slug', 'ground-netral')->value, 2);

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

@if ($nomenklatur->id == 10 || $nomenklatur->id == 11)
    <?php
    $laporan_occlusion = DB::table('laporan_occlusion')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $flow_rate = DB::table('laporan_flow_rate')
        ->where('no_laporan', $laporan->no_laporan)
        ->first();
    $dataFlowRate = json_decode($flow_rate->data_sertifikat);

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
    } else {
        $slope = $dataFlowRate->slope_2;
        $intercept = $dataFlowRate->intercept_2;
        $uncert = $dataFlowRate->uc_2;
    }

    $satu = $laporan_occlusion->percobaan_1 * 0.0145;
    $dua = $laporan_occlusion->percobaan_2 * 0.0145;
    $tiga = $laporan_occlusion->percobaan_3 * 0.0145;
    $empat = $laporan_occlusion->percobaan_4 * 0.0145;
    $lima = $laporan_occlusion->percobaan_5 * 0.0145;
    $enam = $laporan_occlusion->percobaan_6 * 0.0145;
    $mean_occlusion = round(($satu + $dua + $tiga + $empat + $lima + $enam) / 6, 2);

    ?>
    <?php
    // 1
    $satu1 = $flow_rate->percobaan1_1;
    $dua1 = $flow_rate->percobaan1_2;
    $tiga1 = $flow_rate->percobaan1_3;
    $empat1 = $flow_rate->percobaan1_4;
    $lima1 = $flow_rate->percobaan1_5;
    $enam1 = $flow_rate->percobaan1_6;
    $mean1 = round(($satu1 + $dua1 + $tiga1 + $empat1 + $lima1 + $enam1) / 6, 2);

    $meanTerkoreksi1 = round($intercept + $slope * $mean1, 2);
    $arr = [];
    array_push($arr, $satu1, $dua1, $tiga1, $empat1, $lima1, $enam1);
    // stdev
    $stdev = round(standard_deviation($arr), 2);
    $koreksi = $meanTerkoreksi1 - 10;
    // hitung uncertainty
    $u95 = round(hitung_uncertainty($resolusi->value, $stdev,$uncert), 3);
    $absU95 = abs($koreksi) + $u95;
    $score = $absU95 < 1 ? 'Lulus' : 'Tidak';
    // 2
    $satu2 = $flow_rate->percobaan2_1;
    $dua2 = $flow_rate->percobaan2_2;
    $tiga2 = $flow_rate->percobaan2_3;
    $empat2 = $flow_rate->percobaan2_4;
    $lima2 = $flow_rate->percobaan2_5;
    $enam2 = $flow_rate->percobaan2_6;
    $mean2 = round(($satu2 + $dua2 + $tiga2 + $empat2 + $lima2 + $enam2) / 6, 2);
    $meanTerkoreksi2 = round($intercept + $slope * $mean2, 2);
    $arr2 = [];
    array_push($arr2, $satu2, $dua2, $tiga2, $empat2, $lima2, $enam2);
    // stdev
    $stdev2 = round(standard_deviation($arr2), 2);
    $koreksi2 = $meanTerkoreksi2 - 50;
    $u952 = round(hitung_uncertainty($resolusi->value, $stdev2,$uncert), 3);
    $absU952 = abs($koreksi2) + $u952;
    $score2 = $absU952 < 5 ? 'Lulus' : 'Tidak';
    // 3
    $satu3 = $flow_rate->percobaan3_1;
    $dua3 = $flow_rate->percobaan3_2;
    $tiga3 = $flow_rate->percobaan3_3;
    $empat3 = $flow_rate->percobaan3_4;
    $lima3 = $flow_rate->percobaan3_5;
    $enam3 = $flow_rate->percobaan3_6;
    $mean3 = round(($satu3 + $dua3 + $tiga3 + $empat3 + $lima3 + $enam3) / 6, 2);
    $meanTerkoreksi3 = round($intercept + $slope * $mean3, 2);
    $arr3 = [];
    array_push($arr3, $satu3, $dua3, $tiga3, $empat3, $lima3, $enam3);
    // stdev
    $stdev3 = round(standard_deviation($arr3), 2);
    $koreksi3 = $meanTerkoreksi3 - 100;
    $u953 = round(hitung_uncertainty($resolusi->value, $stdev3,$uncert), 3);
    $absU953 = abs($koreksi3) + $u953;
    $score3 = $absU953 < 10 ? 'Lulus' : 'Tidak';

    if ($nomenklatur->id == 10) {
        // 4
        $satu4 = $flow_rate->percobaan4_1;
        $dua4 = $flow_rate->percobaan4_2;
        $tiga4 = $flow_rate->percobaan4_3;
        $empat4 = $flow_rate->percobaan4_4;
        $lima4 = $flow_rate->percobaan4_5;
        $enam4 = $flow_rate->percobaan4_6;
        $mean4 = round(($satu4 + $dua4 + $tiga4 + $empat4 + $lima4 + $enam4) / 6, 2);
        $meanTerkoreksi4 = round($intercept + $slope * $mean4, 2);
        $arr4 = [];
        array_push($arr4, $satu4, $dua4, $tiga4, $empat4, $lima4, $enam4);
        $stdev4 = round(standard_deviation($arr4), 2);
        $koreksi4 = $meanTerkoreksi4 - 500;
        $u954 = round(hitung_uncertainty($resolusi->value, $stdev4,$uncert), 3);
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
    ?>
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
                    <?php
                    $scoreOcc = $mean_occlusion < 20 ? 100 : 0;
                    $totalAll = $score_fisik + $point + ($kinerja = $scoreOcc + $initScore) / 2 / 2;
                    ?>

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
