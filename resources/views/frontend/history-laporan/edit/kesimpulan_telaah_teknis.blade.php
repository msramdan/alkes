@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/kesimpulan-telaah_teknis') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                <div class="col mb-2">
                    <label for="" style=" font-size: 12px;">Berdasarkan hasil pengujian
                        dan/ atau hasil kalibrasi, alat
                        ini dinyatakan </label> <br>
                    <small>Catatan : Pilih Hasil kalibrasi laik atau tidak laik pakai</small>
                    <select class="form-control select2" id="kesimpulan-telaah-teknis"
                        name="kesimpulan_telaah_teknis" required style="width: 100%;" required>
                        <option selected disabled value="">-- Pilih --</option>
                        <option value="baik" {{ $kesimpulan_telaah_teknis->value == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="tidak-baik" {{ $kesimpulan_telaah_teknis->value == 'tidak-baik' ? 'selected' : '' }}>Tidak baik</option>
                    </select>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please select a valid Condition.
                    </div>
                </div>
                <a class="btn btn-danger mt-2" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-success mt-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection


