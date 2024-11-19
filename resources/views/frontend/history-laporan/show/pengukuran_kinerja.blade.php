@extends('layouts.master-frontend')
@section('title', 'View Detail Laporan')
@section('content')
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
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                @if (
                    $laporan->nomenklatur_id == config('nomenklatur.INFUSION_PUMP') ||
                        $laporan->nomenklatur_id == config('nomenklatur.SYRINGE_PUMP'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.infusion_pump')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.SPHYGMOMANOMETER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.sphygmomanometer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.SUCTION_PUMP'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.suction_pump')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.INKUBATOR_LABORATORIUM'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.inkubator_laboratorium')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.CONTACT_TACHOMETER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.contact_tachometer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.ELECTROCARDIOGRAPH'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.electrocardiograph')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.CARDIOTOCOGRAPH'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.cardiotocograph')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.FETAL_DOPPLER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.fetal_doppler')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.DENTAL_UNIT'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.dental_unit')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.ROLLER_MIXER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.roller_mixer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.EXAMINATION_LAMP'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.examination_lamp')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.ROTATOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.rotator')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.BEDSIDE_MONITOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.bedside_monitor')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.ELEKTROSURGERY_UNIT'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.elektrosurgery_unit')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.FLOWMETER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.flowmeter')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.CPAP'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.cpap')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.OKSIGEN_CONCENTRATOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.oksigen_concentrator')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.NEBULIZER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.nebulizer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.BLOOD_BANK_REFRIGERATOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.blood_bank_refrigerator')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.OVEN'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.oven')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.MEDICAL_FREEZER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.medical_freezer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.BREAST_PUMP'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.breast_pump')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.WATERBATH'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.waterbath')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.PARAFFIN_BATH'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.paraffin_bath')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.TERMOMETER_KLINIK'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.termometer_klinik')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.BLOOD_WARMER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.blood_warmer')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.AUTOCLAVE'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.autoclave')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.DEFIBRILLATOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.defibrillator')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.HFNC'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.HFNC')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.ELECTROSTIMULATOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.ELECTROSTIMULATOR')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.PULSE_OXYMETER'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.PULSE_OXYMETER')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.AUTOREFRAKTOR'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.AUTOREFRAKTOR')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.Bed_Electric'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.Bed_Electric')
                @elseif($laporan->nomenklatur_id == config('nomenklatur.BIOMETRI'))
                    @include('frontend.history-laporan.show.pengukuran_kinerja.BIOMETRI')
                @endif
            </div>
        </div>
    </div>
@endsection
