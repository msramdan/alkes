@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/daftar_alat_ukur') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @foreach ($alat_ukur as $alat)
                    @php
                    $inventaris = DB::table('inventaris')
                        ->where('jenis_alat_id', $alat->type_id)
                        ->get();
                    @endphp
                    <div class="col mb-2">
                        <label for="" style=" font-size: 12px;">{{ $alat->jenis_alat }}</label>
                        <select class="form-control select2" @readonly(true) id="type_select-{{ $alat->id }}"
                            name="{{ $alat->id }}" required style="width: 100%;" required>
                            <option selected disabled value="">-- Pilih --</option>
                            @foreach ($inventaris as $data)
                                <option value="{{ $data->id }}" {{ $alat->inventaris_id == $data->id ? 'selected' : ''}}>{{ $data->kode_inventaris }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid option.
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection


