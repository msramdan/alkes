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
    @include('laporans._sertifikat.infusion_pump')
@elseif ($nomenklatur->id == config('nomenklatur.SPHYGMOMANOMETER'))
    @include('laporans._sertifikat.sphygmomanometer')
@elseif($nomenklatur->id == config('nomenklatur.INKUBATOR_LABORATORIUM'))
    @include('laporans._sertifikat.inkubator_laboratorium')
@elseif ($nomenklatur->id == config('nomenklatur.SUCTION_PUMP'))
    @include('laporans._sertifikat.suction_pump')
@elseif ($nomenklatur->id == config('nomenklatur.CENTRIFUGE'))
    @include('laporans._sertifikat.centrifuge')
@elseif ($nomenklatur->id == config('nomenklatur.ELECTROCARDIOGRAPH'))
    @include('laporans._sertifikat.electrocardiograph')
@elseif ($nomenklatur->id == config('nomenklatur.CARDIOTOCOGRAPH'))
    @include('laporans._sertifikat.cardiotocograph')
@elseif ($nomenklatur->id == config('nomenklatur.FETAL_DOPPLER'))
    @include('laporans._sertifikat.fetal_doppler')
@elseif ($nomenklatur->id == config('nomenklatur.EXAMINATION_LAMP'))
    @include('laporans._sertifikat.examination_lamp')
@elseif ($nomenklatur->id == config('nomenklatur.DENTAL_UNIT'))
    @include('laporans._sertifikat.dental_unit')
    @elseif ($nomenklatur->id == config('nomenklatur.ROLLER_MIXER'))
    @include('laporans._sertifikat.roller_mixer')
@endif
