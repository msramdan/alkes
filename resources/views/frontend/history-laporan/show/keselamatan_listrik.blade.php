@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/keselamatan-listrik') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @foreach ($keselamatan_listrik as $listrik)
                    <div class="col">
                        <label for="" style=" font-size: 12px;">{{ $listrik->field_keselamatan_listrik }}</label>
                        <input type="text" class="form-control" readonly value="{{ $listrik->value }}" id="{{ $listrik->field_keselamatan_listrik }}" placeholder="" name="{{ $listrik->field_keselamatan_listrik }}"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection


