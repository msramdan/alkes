@extends('layouts.app')

@section('title', __('Jenis Alat Yang Dipakai'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Nomenklaturs') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Setup Nomenklaturs') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('nomenklaturs.index') }}">{{ __('Nomenklaturs') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>PENDATAAN ADMINISTRASI</h6>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}" readonly>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Merk"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Merk" aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Tipe / Model"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Tipe / Model"
                                            aria-label="">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Nomor Seri"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Nomor Seri"
                                            aria-label="">
                                    </div>
                                </div>


                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Resolusi"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Resolusi" aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="" aria-label=""
                                            placeholder="Satuan">
                                    </div>
                                </div>


                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Rentang Ukur"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Rentang Ukur"
                                            aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">

                                        <input type="text" class="form-control" value="" aria-label=""
                                            placeholder="Satuan">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Kapasitas"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Kapasitas"
                                            aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">

                                        <input type="text" class="form-control" value="" aria-label=""
                                            placeholder="Satuan">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Faskes Pemilik"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Faskes Pemilik"
                                            aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Ruangan"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Ruangan"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Tempat Kalibrasi"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Tempat Kalibrasi"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Tanggal Penerimaan"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Tanggal Penerimaan"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Tanggal Kalibrasi"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Tanggal Kalibrasi"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Channel IDA"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Channel IDA"
                                            aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox"
                                                name="pendataan_administrasi[]" value="Jenis Timbangan"
                                                aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Jenis Timbangan"
                                            aria-label="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>DAFTAR ALAT UKUR</h2>
                                <hr>
                                <form action="{{ route('save_equipment_type') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}"
                                            readonly>
                                        @foreach ($jenis_alat as $row)
                                            <div class="col-md-3">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text">
                                                        <input class="form-check-input mt-0" type="checkbox"
                                                            name="type_id[]" value="{{ $row->id }}"
                                                            {{ checked_box($nomenklatur->id, $row->id) }}
                                                            aria-label="Checkbox for following text input">
                                                    </div>
                                                    <input type="text" readonly class="form-control"
                                                        value="{{ $row->jenis_alat }}" aria-label="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <button type="submit" id="submit"
                                        class="btn btn-primary">{{ __('Save') }}</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a> --}}
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>PENGUKURAN KONDISI LINGKUNGAN</h6>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}" readonly>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Suhu"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Kelembaban Ruangan"
                                            aria-label="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>PEMERIKSAAAN KONDISI FISIK DAN FUNGSI ( CEK KUALITATIF)</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button style="margin-bottom: 10px;" type="button" name="add_berkas"
                                        id="add_berkas" class="btn btn-success btn-sm"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Add </button>
                                    <table class="table table-bordered" id="dynamic_field">
                                        <thead>
                                            <tr>
                                                <th>Bagian Alat</th>
                                                <th>Batasan Pemeriksaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>PENGUKURAN KESELAMATAN LISTRIK
                            </h6>
                            <hr>
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Phase - Netral
                                        </td>
                                        <td rowspan="3">Tegangan Input (Main Voltage)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Phase - Ground</td>

                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Ground - Netral
                                        </td>

                                    </tr>


                                    {{-- == --}}
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Kabel dapat dilepas (DPS)
                                        </td>

                                        <td rowspan="2">Resistansi pembumian protektif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Kabel tidak dapat dilepas (NPS)</td>

                                    </tr>
                                    {{-- == --}}
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td colspan="2">Resistansi isolasi</td>
                                    </tr>
                                    {{-- === --}}
                                    <tr>
                                        <td><input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input"></td>
                                        <td>Kelas I tipe B/BF/CF

                                        </td>

                                        <td rowspan="1">Arus bocor peralatan metode langsung/diferensial
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>PENGUKURAN KINERJA</h6> <span style="color: red"> Template Pengukuran kinerja automatis
                                Nomenklaturs
                                sesuai
                                terpilih</span>
                            </span>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}" readonly>
                                @foreach ($nomenklaturs as $row)
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-text">
                                                <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                    disabled value="{{ $row->id }}" {{-- {{ checked_box($nomenklatur->id, $row->id) }} --}}
                                                    aria-label="Checkbox for following text input">
                                            </div>
                                            <input type="text" readonly class="form-control"
                                                value="{{ $row->nama_nomenklatur }}" aria-label="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>G. TELAAH TEKNIS</h6>
                            <hr>
                            <div class="row">
                                <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}" readonly>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Fisik dan Fungs"
                                            aria-label="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Keselamatan Listrik"
                                            aria-label="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <input type="text" readonly class="form-control" value="Kinerja"
                                            aria-label="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    </section>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add_berkas').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '"><td><input required type="text" name="name[]" placeholder="" class="form-control " /></td><td><input required style="" type="text" name="phone[]" placeholder="" class="form-control " /></td><td><button type="button" name="remove" id="' +
                    i +
                    '" class="btn btn-danger btn_remove"><i class="bi bi-trash"></i></button></td></tr>'
                );
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            $(document).on('click', '.btn_remove_data', function() {
                var bid = this.id;
                var trid = $(this).closest('tr').attr('id');
                $('#' + trid + '').remove();
            });
        });
    </script>
@endpush
