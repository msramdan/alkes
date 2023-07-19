<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{ asset('template_sertifikat/assets/css/custom.css') }}">
</head>
<body>
    <img src="{{ asset('template_sertifikat/assets/img/logo-bg.jpg') }}" class="img-fluid" width="590" style="position: absolute; top: 350px; left: 40px; z-index: -1; opacity: 0.05;" alt="Responsive image">
    <div class="wrapper">
        <img src="{{ asset('template_sertifikat/assets/img/header-icon-2.png') }}" class="img-fluid" width="340" alt="Responsive image">
        <div>
            <h3 class="mt-3 mb-0 w-100" style="letter-spacing: 2px; font-size: 40px; font-weight: bold; text-align: center; display: inline-block;transform: scale(.85, 1); color: #6f4a13; text-decoration: underline;">SERTIFIKAT KALIBRASI</h3>
            <p class="text-center mt-0 mb-1" style="font-size: 20px;">Sertificate Of Calibration</p>
            <h4 class="text-center w-100" style="font-family: 'Times New Roman', Times, serif; font-size: 30px; font-weight: bold; text-align: center;">C.MTA 23 002 0861</h4>
        </div>

        <div class="mt-3">
            <table style="font-family: 'Times New Roman', Times, serif;">
                <tr>
                    <td colspan="3">
                        <h4 class="title-row mb-0" style="text-decoration: underline;">IDENTITAS PEMILIK</h4>
                        <p class="subtitle-row mt-0">Owner Identification</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Nama</h4><p class="data-subtitle-row mt-0 ml-4">Name</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">RUMAH SAKIT YASMIN BANYUWANGI</td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Alamat</h4><p class="data-subtitle-row mt-0 ml-4">Address</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">JL. LETKOL ISTIGLAH NO. E0-84 STNGONEGARAN, KEC. BANYUWANGI, JAWA TIMUR</td>
                </tr>
                <tr>
                    <td colspan="3" class="pt-3">
                        <h4 class="title-row mb-0" style="text-decoration: underline;">IDENTITAS ALAT</h4>
                        <p class="subtitle-row mt-0">Instrument Identification</p>
                    </td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Nama</h4><p class="data-subtitle-row mt-0 ml-4">Name</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">VENTILATOR</td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Merk/Tipe</h4><p class="data-subtitle-row mt-0 ml-4">Brand/Type</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">Siare/Sirio Plus</td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Nomor Seri</h4><p class="data-subtitle-row mt-0 ml-4">Serial Number</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">50907</td>
                </tr>
                <tr>
                    <td class="va-top" width="34%"><h4 class="data-title-row mb-0 ml-4">Hasil Pengujian/Kalibrasi</h4><p class="data-subtitle-row mt-0 ml-4">Result</p></td>
                    <td class="va-top" width="5%">:</td>
                    <td class="va-top" style="font-weight: bold; font-size: 16px;">LAIK PAKAI<br>berlaku s/d : 02 Februari 2024</td>
                </tr>
            </table>

            <table class="w-50 ml-auto" style="font-family: 'Times New Roman', Times, serif;">
                <tr>
                    <td class="va-top p-0" width="30%"><h4 class="data-title-row mb-0 ml-4">Sertifikat ini terdiri dari : x Halaman</h4><p class="data-subtitle-row mt-0 ml-4">This certificate comprises of x pages</p></td>
                </tr>
                <tr>
                    <td class="va-top p-0"><h4 class="data-title-row mb-0 ml-4">Diterbitkan tanggal 06 Februari 2023</h4><p class="data-subtitle-row mt-0 ml-4">Date of issue</p></td>
                </tr>
                <tr>
                    <td class="va-top text-center"><h4 class="data-title-row mb-0 ml-4">Direktur</h4></td>
                </tr>
                <tr>
                    <td class="text-center p-2">
                        <img src="{{ asset('template_sertifikat/assets/img/logo-head.webp') }}" class="img-fluid ml-4" width="200" style="opacity: 0.5;" alt="Responsive image">
                    </td>
                </tr>
                <tr>
                    <td class="va-top text-center"><h4 class="data-title-row mb-0 ml-4">YUDI SUSANTO, ST</h4></td>
                </tr>
            </table>
        </div>
    </div>
    <div style="position: absolute; bottom: 0; width: 100%;">
        <p style="font-size: 10px;" class="text-center mb-0">Tidak dibenarkan mengutip/memperbanyak dan/atau mempublikasikan sebagian sertifikat ini tanpa izin PT. Mitra Tera Akurasi</p>
        <p style="font-size: 10px;" class="text-center font-italic">Not allowed to quote/reproduce and/or publish part of the contents of this certificate without permission of PT. Mitra Tera Akurasi</p>
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
