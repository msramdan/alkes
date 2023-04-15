@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/kondisi_lingkungan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @if (!empty($kondisi_lingkungan->suhu_awal) && !empty($kondisi_lingkungan->suhu_akhir))
                <div class="row mb-2">
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Suhu Awal (°C)</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name" name="suhu_awal" value="{{ $kondisi_lingkungan->suhu_awal }}">
                    </div>
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Suhu Akhir (°C)</label>
                        <input type="text" class="form-control" placeholder="" aria-label="Last name" name="suhu_akhir" value="{{ $kondisi_lingkungan->suhu_akhir }}">
                    </div>
                </div>
                @endif
                @if (!empty($kondisi_lingkungan->kelembapan_ruangan_awal) && !empty($kondisi_lingkungan->kelembapan_ruangan_akhir))
                <div class="row mb-2">
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Kelembapan Ruangan Awal (%)</label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name" name="kelembapan_ruangan_awal" value="{{ $kondisi_lingkungan->kelembapan_ruangan_awal }}">
                    </div>
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Kelembaban Ruangan Akhir (%)</label>
                        <input type="text" class="form-control" placeholder="" aria-label="Last name" name="kelembapan_ruangan_akhir" value="{{ $kondisi_lingkungan->kelembapan_ruangan_akhir }}">
                    </div>
                </div>
                @endif
                <a class="btn btn-danger mt-2" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-success mt-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection


