<style>
    th,
    td {
        text-align: center;
        vertical-align: middle;
    }

    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
</style>

@php
    $stepNumber = $count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5';
    $nomenklaturMap = [
        config('nomenklatur.INFUSION_PUMP') => 'infusion_pump',
        config('nomenklatur.SYRINGE_PUMP') => 'infusion_pump',
        config('nomenklatur.SPHYGMOMANOMETER') => 'sphygmomanometer',
        config('nomenklatur.SUCTION_PUMP') => 'suction_pump',
        config('nomenklatur.INKUBATOR_LABORATORIUM') => 'inkubator_laboratorium',
        config('nomenklatur.CENTRIFUGE') => 'CENTRIFUGE',
        config('nomenklatur.ELECTROCARDIOGRAPH') => 'electrocardiograph',
        config('nomenklatur.CARDIOTOCOGRAPH') => 'cardiotocograph',
        config('nomenklatur.FETAL_DOPPLER') => 'fetal_doppler',
        config('nomenklatur.DENTAL_UNIT') => 'dental_unit',
        config('nomenklatur.ROLLER_MIXER') => 'roller_mixer',
        config('nomenklatur.EXAMINATION_LAMP') => 'examination_lamp',
        config('nomenklatur.ROTATOR') => 'rotator',
        config('nomenklatur.BEDSIDE_MONITOR') => 'bedside_monitor',
        config('nomenklatur.ELEKTROSURGERY_UNIT') => 'elektrosurgery_unit',
        config('nomenklatur.FLOWMETER') => 'flowmeter',
        config('nomenklatur.CPAP') => 'cpap',
        config('nomenklatur.OKSIGEN_CONCENTRATOR') => 'oksigen_concentrator',
        config('nomenklatur.NEBULIZER') => 'nebulizer',
        config('nomenklatur.BLOOD_BANK_REFRIGERATOR') => 'blood_bank_refrigerator',
        config('nomenklatur.OVEN') => 'oven',
        config('nomenklatur.MEDICAL_FREEZER') => 'medical_freezer',
        config('nomenklatur.BREAST_PUMP') => 'breast_pump',
        config('nomenklatur.WATERBATH') => 'waterbath',
        config('nomenklatur.PARAFFIN_BATH') => 'paraffin_bath',
        config('nomenklatur.TERMOMETER_KLINIK') => 'termometer_klinik',
        config('nomenklatur.BLOOD_WARMER') => 'blood_warmer',
        config('nomenklatur.AUTOCLAVE') => 'autoclave',
        config('nomenklatur.DEFIBRILLATOR') => 'defibrillator',
        config('nomenklatur.HFNC') => 'HFNC',
        config('nomenklatur.ELECTROSTIMULATOR') => 'ELECTROSTIMULATOR',
        config('nomenklatur.PULSE_OXYMETER') => 'PULSE_OXYMETER',
        config('nomenklatur.AUTOREFRAKTOR') => 'AUTOREFRAKTOR',
        config('nomenklatur.Bed_Electric') => 'Bed_Electric',
        config('nomenklatur.BIOMETRI') => 'BIOMETRI',
        config('nomenklatur.OPERATING_LAMP') => 'OPERATING_LAMP',
        config('nomenklatur.Meja_Operasi') => 'Meja_Operasi',
        config('nomenklatur.Microwave_Diathermy') => 'Microwave_Diathermy',
        config('nomenklatur.NEOPUFF') => 'NEOPUFF',
        config('nomenklatur.PLATELET_AGITAROR_INKUBATOR') => 'PLATELET_AGITAROR_INKUBATOR',
        config('nomenklatur.STERILLISATOR') => 'STERILLISATOR',
        config('nomenklatur.STIRER') => 'STIRER',
        config('nomenklatur.TREADMILL') => 'TREADMILL',
        config('nomenklatur.UV_STERILIZER') => 'UV_STERILIZER',
        config('nomenklatur.VEIN_FINDER') => 'VEIN_FINDER',
        config('nomenklatur.MEDICAL_REFRIGERATOR') => 'MEDICAL_REFRIGERATOR',
        config('nomenklatur.ULTRA_SOUND_THERAPY') => 'ULTRA_SOUND_THERAPY',
        config('nomenklatur.PHOTOTHERAPY') => 'PHOTOTHERAPY',
        config('nomenklatur.TRAKSI') => 'TRAKSI',
        config('nomenklatur.INFANT_WARMER') => 'INFANT_WARMER',
        config('nomenklatur.VITAL_SIGN_MONITOR') => 'VITAL_SIGN_MONITOR',
        config('nomenklatur.MIKROPIPET_FIXED_VOLUME') => 'MIKROPIPET_FIXED_VOLUME',
        config('nomenklatur.LAPAROSCOPY') => 'LAPAROSCOPY',
        config('nomenklatur.HUMIDIFIER') => 'HUMIDIFIER',
        config('nomenklatur.SPIROMETER') => 'SPIROMETER',
        config('nomenklatur.ULTRASONOGRAPHY') => 'ULTRASONOGRAPHY',
        config('nomenklatur.MIKROSKOP') => 'MIKROSKOP',
    ];
@endphp

<div id="step-{{ $stepNumber }}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{ $stepNumber }}">
    <form id="form-{{ $stepNumber }}">
        @if (isset($nomenklaturMap[$nomenklatur_id]))
            @include('frontend.create-laporan.step.pengukuran_kinerja.' . $nomenklaturMap[$nomenklatur_id])
        @endif
    </form>
</div>
