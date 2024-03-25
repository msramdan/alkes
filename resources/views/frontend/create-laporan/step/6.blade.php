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
        @endif
    </form>
</div>
