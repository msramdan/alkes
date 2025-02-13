
<html>

<head>
    <title>Sertifikat {{ $laporan->no_sertifikat ?? '-' }}</title>
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
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')
    ->where('no_laporan', $laporan->no_laporan)
    ->where('slug', 'resolusi')
    ->first();

// ======================
$heart_rate = DB::table('laporan_kinerja')
    ->where('type_laporan_kinerja', 'heart_rate')
    ->where('no_laporan', $laporan->no_laporan)
    ->first();
$data_sertifikat = json_decode($heart_rate->data_sertifikat);
$data_laporan = json_decode($heart_rate->data_laporan);
$arr = [60, 90, 120, 150, 180, 210];
$myArray = [];
$initScore = 0;

foreach ($arr as $value) {
    // 1000
    $a = 'percobaan' . $value . '_1';
    $$a = $data_laporan->$a;

    $b = 'percobaan' . $value . '_2';
    $$b = $data_laporan->$b;

    $c = 'percobaan' . $value . '_3';
    $$c = $data_laporan->$c;

    $d = 'percobaan' . $value . '_4';
    $$d = $data_laporan->$d;

    $e = 'percobaan' . $value . '_5';
    $$e = $data_laporan->$e;

    $f = 'percobaan' . $value . '_6';
    $$f = $data_laporan->$f;

    // mean
    $mean = 'mean_' . $value;
    $$mean = ($$a + $$b + $$c + $$d + $$e + $$f) / 6;

    // mean terkoreksi
    $mean_terkoreksi = 'mean_terkoreksi_' . $value;
    $$mean_terkoreksi = $$mean + ($data_sertifikat->intercept + $data_sertifikat->slope * $$mean);

    // stdev
    $arrData = [];
    array_push($arrData, $$a, $$b, $$c, $$d, $$e, $$f);
    $stdev = standard_deviation($arrData);
    $var_stdev = 'stdev' . $value;
    $$var_stdev = $stdev;

    // koreksi
    $koreksi = 'koreksi_' . $value;
    $$koreksi = $$mean_terkoreksi - $value;

    // U95
    $u95 = 'u95' . $value . '_naik';
    $drift = 'drift_' . $value;
    $uc = $data_sertifikat->uc;
    // U95
    $$u95 = hitung_uncertainty($resolusi->value, $$var_stdev, $uc, 0, 6);

    // cu95
    $cu95 = 'abs95' . $value;
    $$cu95 = $$koreksi + $$u95;

    // toleransi
    $toleransi = 'toleransi' . $value;
    $$toleransi = 0.05 * $value;

    // hasil
    $hasil = 'hasil' . $value;
    $$hasil = $$cu95 <= $$toleransi ? 'Lulus' : 'Tidak';
    if ($$hasil == 'Lulus') {
        $initScore = $initScore + 1;
    }

    $data = [
        'percobaan_1' => $$a,
        'percobaan_2' => $$b,
        'percobaan_3' => $$c,
        'percobaan_4' => $$d,
        'percobaan_5' => $$e,
        'percobaan_6' => $$f,
        'mean' => $$mean,
        'mean_terkoreksi' => $$mean_terkoreksi,
        'stdev' => $$var_stdev,
        'koreksi' => $$koreksi,
        'u95' => $$u95,
        'cu95' => $$cu95,
        'tol' => $$toleransi,
        'hasil' => $$hasil,
    ];
    $myArray[$value] = $data;
    $arrData = [];
}

$score = round(($initScore / 6) * 100, 2);
$persyaratan = $score >= 70 ? 'Lulus' : 'Tidak';

if ($score < 70) {
    $scoreKinerja = 0;
} else {
    $scoreKinerja = $score / 2;
}
$totalAll = $score_fisik + $point + $scoreKinerja;
?>
<!DOCTYPE html>


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
