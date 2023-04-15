@extends('layouts.master-frontend')
@section('title', 'Edit History Laporan')
@section('content')
<div class="page-content-wrapper">
    <div class="py-3">
        <div class="container">
            <form action="{{ url('/web/history_laporan/pendataan_administrasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="no_laporan" value="{{ $laporan->no_laporan }}">
                @foreach ($pendataan_administrasi as $administrasi)
                    @if ($administrasi->slug ==  'merk')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Merek</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="merk" placeholder="" name="merk"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'tipe-model')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Tipe / Model</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="tipe-model" placeholder="" name="tipe-model"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'nomor-seri')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Nomor Seri</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="nomor-seri" placeholder="" name="nomor-seri"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'resolusi')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Resolusi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" readonly placeholder="" id="resolusi" name="resolusi" value="{{ $administrasi->value }}"
                                required>
                            <span class="input-group-text" id=""
                                style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Resolusi') }}</span>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid nomenklatur.
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'rentang-ukur')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Rentang Ukur</label>
                        <div class="input-group">
                            <input type="text" class="form-control" readonly placeholder="" value="{{ $administrasi->value }}" name="rentang-ukur" required>
                            <span class="input-group-text" style="width: 70px"
                                id="">{{ cek_satuan($nomenklatur_id, 'Rentang Ukur') }}</span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'kapasitas')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Kapasitas</label>
                        <div class="input-group">
                            <input type="text" class="form-control" readonly name="kapasitas" aria-describedby="" value="{{ $administrasi->value }}" required>
                            <span class="input-group-text" id=""
                                style="width: 70px">{{ cek_satuan($nomenklatur_id, 'Kapasitas') }}</span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'faskes-pemilik')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Faskes Pemilik</label>
                        <select class="form-control select2" readonly id="faskes" name="faskes-pemilik" required style="width: 100%;"
                            required>
                            <option selected disabled value="">--
                                Pilih --</option>
                            @foreach ($faskes as $row)
                                <option value="{{ $row->id }}" {{ $administrasi->value == $row->id ? 'selected' : ''}}>{{ $row->nama_faskes }}
                                </option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'ruangan')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Ruangan</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" name="ruangan"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'tempat-kalibrasi')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Tempat Kalibrasi</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" name="tempat-kalibrasi"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'tanggal-penerimaan')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Tanggal Penerimaan</label>
                        <input type="date" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" name="tanggal-penerimaan"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'tanggal-kalibrasi')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Tanggal Kalibrasi</label>
                        <input type="date" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" name="tanggal-kalibrasi"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'channel-ida')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Channel IDA</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" name="channel-ida"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif

                    @if ($administrasi->slug == 'jenis-timbangan')
                    <div class="col">
                        <label for="" style=" font-size: 12px;">Jenis Timbangan</label>
                        <input type="text" class="form-control" readonly value="{{ $administrasi->value }}" id="" placeholder="" required
                            name="jenis-timbangan">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid nomenklatur.
                        </div>
                    </div>
                    @endif
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection


