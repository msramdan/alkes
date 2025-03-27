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
<div id="step-{{ $count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5' }}" class="tab-pane" role="tabpanel"
    aria-labelledby="step-{{ $count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5' }}">
    <form id="form-{{ $count_nomenklatur_keselamatan_listrik > 0 ? '6' : '5' }}">
        {{-- INFUSION PUMP & SYRINGE PUMP --}}
        @if ($nomenklatur_id == config('nomenklatur.INFUSION_PUMP') || $nomenklatur_id == config('nomenklatur.SYRINGE_PUMP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.infusion_pump')
        @elseif($nomenklatur_id == config('nomenklatur.SPHYGMOMANOMETER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.sphygmomanometer')
        @elseif($nomenklatur_id == config('nomenklatur.SUCTION_PUMP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.suction_pump')
        @elseif($nomenklatur_id == config('nomenklatur.INKUBATOR_LABORATORIUM'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.inkubator_laboratorium')
        @elseif($nomenklatur_id == config('nomenklatur.CONTACT_TACHOMETER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.contact_tachometer')
        @elseif($nomenklatur_id == config('nomenklatur.ELECTROCARDIOGRAPH'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.electrocardiograph')
        @elseif($nomenklatur_id == config('nomenklatur.CARDIOTOCOGRAPH'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.cardiotocograph')
        @elseif($nomenklatur_id == config('nomenklatur.FETAL_DOPPLER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.fetal_doppler')
        @elseif($nomenklatur_id == config('nomenklatur.DENTAL_UNIT'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.dental_unit')
        @elseif($nomenklatur_id == config('nomenklatur.ROLLER_MIXER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.roller_mixer')
        @elseif($nomenklatur_id == config('nomenklatur.EXAMINATION_LAMP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.examination_lamp')
        @elseif($nomenklatur_id == config('nomenklatur.ROTATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.rotator')
        @elseif($nomenklatur_id == config('nomenklatur.BEDSIDE_MONITOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.bedside_monitor')
        @elseif($nomenklatur_id == config('nomenklatur.ELEKTROSURGERY_UNIT'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.elektrosurgery_unit')
        @elseif($nomenklatur_id == config('nomenklatur.FLOWMETER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.flowmeter')
        @elseif($nomenklatur_id == config('nomenklatur.CPAP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.cpap')
        @elseif($nomenklatur_id == config('nomenklatur.OKSIGEN_CONCENTRATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.oksigen_concentrator')
        @elseif($nomenklatur_id == config('nomenklatur.NEBULIZER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.nebulizer')
        @elseif($nomenklatur_id == config('nomenklatur.BLOOD_BANK_REFRIGERATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.blood_bank_refrigerator')
        @elseif($nomenklatur_id == config('nomenklatur.OVEN'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.oven')
        @elseif($nomenklatur_id == config('nomenklatur.MEDICAL_FREEZER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.medical_freezer')
        @elseif($nomenklatur_id == config('nomenklatur.BREAST_PUMP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.breast_pump')
        @elseif($nomenklatur_id == config('nomenklatur.WATERBATH'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.waterbath')
        @elseif($nomenklatur_id == config('nomenklatur.PARAFFIN_BATH'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.paraffin_bath')
        @elseif($nomenklatur_id == config('nomenklatur.TERMOMETER_KLINIK'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.termometer_klinik')
        @elseif($nomenklatur_id == config('nomenklatur.BLOOD_WARMER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.blood_warmer')
        @elseif($nomenklatur_id == config('nomenklatur.AUTOCLAVE'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.autoclave')
        @elseif($nomenklatur_id == config('nomenklatur.DEFIBRILLATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.defibrillator')
        @elseif($nomenklatur_id == config('nomenklatur.HFNC'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.HFNC')
        @elseif($nomenklatur_id == config('nomenklatur.ELECTROSTIMULATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.ELECTROSTIMULATOR')
        @elseif($nomenklatur_id == config('nomenklatur.PULSE_OXYMETER'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.PULSE_OXYMETER')
        @elseif($nomenklatur_id == config('nomenklatur.AUTOREFRAKTOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.AUTOREFRAKTOR')
        @elseif($nomenklatur_id == config('nomenklatur.Bed_Electric'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.Bed_Electric')
        @elseif($nomenklatur_id == config('nomenklatur.BIOMETRI'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.BIOMETRI')
        @elseif($nomenklatur_id == config('nomenklatur.OPERATING_LAMP'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.OPERATING_LAMP')
        @elseif($nomenklatur_id == config('nomenklatur.Meja_Operasi'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.Meja_Operasi')
        @elseif($nomenklatur_id == config('nomenklatur.Microwave_Diathermy'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.Microwave_Diathermy')
        @elseif($nomenklatur_id == config('nomenklatur.NEOPUFF'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.NEOPUFF')
        @elseif($nomenklatur_id == config('nomenklatur.PLATELET_AGITAROR_INKUBATOR'))
            @include('frontend.create-laporan.step.pengukuran_kinerja.PLATELET_AGITAROR_INKUBATOR')
        @endif
    </form>
</div>
