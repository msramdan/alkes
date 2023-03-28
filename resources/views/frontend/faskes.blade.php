@extends('layouts.master-frontend')
@section('title', 'Kontak')
@section('content')
    <div class="page-content-wrapper">
        <br>
        @foreach ($faskesdata as $faskesdata)
          <div class="card ms-3 mb-3" style="width: 20rem;">
            <h5 class="card-header">{{ $faskesdata->nama_faskes }}</h5>
            <div class="card-body">
                <p class="card-text">Jenis Faskes : {{ $faskesdata->nama_jenis_faskes }}</p>
                <p class="card-text">provinces : {{ $faskesdata->provinsi }}</p>
                <p class="card-text">kabkots : {{ $faskesdata->kabupaten_kota }}</p>
                <p class="card-text">kecamatans : {{ $faskesdata->kecamatan }}</p>
                <p class="card-text">kelurahans : {{ $faskesdata->kelurahan }}</p>
                <p class="card-text">zip_kode : {{ $faskesdata->alamat }}</p>
                <p class="card-text">alamat : {{ $faskesdata->zip_kode }}</p>
            </div>
          </div>
        @endforeach
    </div>
@endsection
