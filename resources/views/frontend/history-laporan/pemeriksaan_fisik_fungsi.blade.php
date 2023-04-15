@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/pemeriksaan-fisik-fungsi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @foreach ($fisik_fungsi as $data)
                    <div class="col mb-2">
                        <label for="" style=" font-size: 12px;">{{ $data->field_pemeriksaan_fisik_fungsi }}</label>
                        <select class="form-control select2" id="{{ $data->slug }}"
                            name="{{ $data->slug }}" required style="width: 100%;" required>
                            <option selected disabled value="">-- Pilih --</option>
                            <option value="baik" {{ $data->value == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="tidak-baik" {{ $data->value == 'tidak-baik' ? 'selected' : '' }}>Tidak baik</option>
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid option.
                        </div>
                    </div>
                @endforeach
                <a class="btn btn-danger mt-2" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-success mt-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection


