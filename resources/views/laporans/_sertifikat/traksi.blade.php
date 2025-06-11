{{-- tekanan_traksi --}}
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$tekanan_traksi = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'tekanan_traksi')->where('no_laporan', $laporan->no_laporan)->first();
$data_sertifikat = json_decode($tekanan_traksi->data_sertifikat);
$data_laporan = json_decode($tekanan_traksi->data_laporan);

$tekananTraksi = [1, 2, 3];
$tekananTraksiData = [];
$tekananTraksiScore = 0;

foreach ($tekananTraksi as $tekanan) {
    $prefix = "traction_{$tekanan}";
    $measurements = [];

    // Collect all 6 measurements
    for ($i = 1; $i <= 6; $i++) {
        $field = "{$prefix}_{$i}";
        $measurements[$i] = $data_laporan->$field;
    }
    // Calculate statistics
    $mean = array_sum($measurements) / count($measurements);
    $mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $mean;
    $stdev = standard_deviation($measurements);
    $tekanan_real = $data_laporan->$prefix;
    if ($tekanan == 1) {
        $drift = $data_sertifikat->drift_10;
    } elseif ($tekanan == 2) {
        $drift = $data_sertifikat->drift_50;
    } else {
        $drift = $data_sertifikat->drift_100;
    }

    $u95 = hitung_uncertainty($resolusi->value, $stdev, $data_sertifikat->u, $drift, 6);

    $correction = $mean_terkoreksi - $tekanan_real;
    $cu95 = $correction + $u95;
    $tolerance = 0.1 * $tekanan_real;
    $result = abs($correction) <= $tolerance ? 'Lulus' : 'Tidak';

    if ($result == 'Lulus') {
        $tekananTraksiScore++;
    }

    $tekananTraksiData[] = [
        'tekanan' => $tekanan_real,
        'measurements' => $measurements,
        'mean' => $mean,
        'mean_terkoreksi' => $mean_terkoreksi,
        'stdev' => $stdev,
        'correction' => $correction,
        'u95' => $u95,
        'cu95' => $cu95,
        'tolerance' => $tolerance,
        'result' => $result,
    ];
}

$tekananTraksiFinalScore = ($tekananTraksiScore / count($tekananTraksi)) * 100;
$tekananTraksiRequirement = $tekananTraksiFinalScore >= 50 ? 'Lulus' : 'Tidak';
?>

{{-- timer_traksi --}}
<?php
$resolusi = DB::table('laporan_pendataan_administrasi')->where('no_laporan', $laporan->no_laporan)->where('slug', 'resolusi')->first();
$timer_traksi = DB::table('laporan_kinerja')->where('type_laporan_kinerja', 'timer_traksi')->where('no_laporan', $laporan->no_laporan)->first();
$data_sertifikat = json_decode($timer_traksi->data_sertifikat);
$data_laporan = json_decode($timer_traksi->data_laporan);

$timerTraksi = [1, 2, 3];
$timerTraksiData = [];
$timerTraksiScore = 0;

foreach ($timerTraksi as $timer) {
    $prefix = "timer_{$timer}";
    $mean = $data_laporan->$prefix;
    $mean_terkoreksi = $data_sertifikat->intercept + $data_sertifikat->x_variable * $mean;
    if ($timer == 1) {
        $timer_real = 300;
        $label_timer_real = 'Waktu Therapy 5 Menit (300 detik)									';
    } elseif ($timer == 2) {
        $timer_real = 20;
        $label_timer_real = 'Waktu Hold 20 detik									';
    } else {
        $timer_real = 20;
        $label_timer_real = 'Waktu Rest 20 detik';
    }

    $correction = $mean - $timer_real;
    $tolerance = 0.1 * $timer_real;
    $result = abs($correction) <= $tolerance ? 'Lulus' : 'Tidak';

    if ($result == 'Lulus') {
        $timerTraksiScore++;
    }

    $timerTraksiData[] = [
        'label_timer_real' => $label_timer_real,
        'timer_real' => $timer_real,
        'data_laporan' => $mean,
        'mean_terkoreksi' => $mean_terkoreksi,
        'correction' => $correction,
        'tolerance' => $tolerance,
        'result' => $result,
    ];
}

$timerTraksiFinalScore = ($timerTraksiScore / count($timerTraksi)) * 100;
$timerTraksiRequirement = $timerTraksiFinalScore >= 50 ? 'Lulus' : 'Tidak';
$score_kinerja = (($tekananTraksiFinalScore + $timerTraksiFinalScore) / 2) * 0.5;
$totalAll = $score_fisik + $point + $score_kinerja;
?>

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
