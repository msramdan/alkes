@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/pemeriksaan-fisik-fungsi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @foreach ($telaah_teknis as $data)
                    <div class="col mb-2">
                        <label for="" style=" font-size: 12px;">{{ $data->field_telaah_teknis }}</label>
                        <select class="form-control select2" readonly id="{{ $data->slug }}"
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
                <div class="col mb-2">
                    <label for="" style=" font-size: 12px;">Catatan</label> <br>
                    <textarea name="catatan_kesimpulan_telaah_teknis" class="form-control" @readonly(true) id="catatan_kesimpulan_telaah_teknis" required>{{ $kesimpulan_telaah_teknis->catatan }}</textarea>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


