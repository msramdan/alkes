@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
@php
    $dataLaporan = json_decode($kondisi_lingkungan->data_laporan, true); // Decode JSON menjadi array
@endphp

<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/kondisi-lingkungan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">

                @if (!empty($dataLaporan['suhu_awal']) && !empty($dataLaporan['suhu_akhir']))
                <div class="row mb-2">
                    <div class="col">
                        <label for="" style="font-size: 12px;">Suhu Awal (°C)</label>
                        <input type="number" class="form-control" readonly name="suhu_awal" value="{{ $dataLaporan['suhu_awal'] }}">
                    </div>
                    <div class="col">
                        <label for="" style="font-size: 12px;">Suhu Akhir (°C)</label>
                        <input type="number" class="form-control" readonly name="suhu_akhir" value="{{ $dataLaporan['suhu_akhir'] }}">
                    </div>
                </div>
                @endif

                @if (!empty($dataLaporan['kelembapan_ruangan_awal']) && !empty($dataLaporan['kelembapan_ruangan_akhir']))
                <div class="row mb-2">
                    <div class="col">
                        <label for="" style="font-size: 12px;">Kelembapan Ruangan Awal (%)</label>
                        <input type="number" class="form-control" readonly name="kelembapan_ruangan_awal" value="{{ $dataLaporan['kelembapan_ruangan_awal'] }}">
                    </div>
                    <div class="col">
                        <label for="" style="font-size: 12px;">Kelembapan Ruangan Akhir (%)</label>
                        <input type="number" class="form-control" readonly name="kelembapan_ruangan_akhir" value="{{ $dataLaporan['kelembapan_ruangan_akhir'] }}">
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection


