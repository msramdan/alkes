@extends('layouts.app')

@section('title', __('Digital Pressure Meter'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Digital Pressure Meter') }}</h3>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('inventaris.index') }}">{{ __('Inventaris') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Create') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('sertifikatSave') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mb-2">
                                    <input type="hidden" name="inventaris_id" id="inventaris_id" class="form-control"
                                        value="{{ $data->id }}" required />
                                    <div class="form-group">
                                        <label for="tahun">{{ __('Tahun') }}</label>
                                        <select name="tahun" id="tahun" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Naik') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_naik" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="X Variable" name="x_variable_naik" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Turun') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_turun" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="X Variable" name="x_variable_turun" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">{{ __('File Excel') }}</label>
                                        <input type="file" name="file" id="file" class="form-control"
                                            value="" required onchange="return validasiEkstensi()" />
                                    </div>
                                </div>
                                <a href="{{ route('inventaris.index') }}"
                                    class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                @php
                                    $sertifikat_inventaris = DB::table('sertifikat_inventaris')
                                        ->where('inventaris_id', $data->id)
                                        ->get();
                                @endphp
                                <table class="table table-bordered" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" rowspan="2">{{ __('Tahun') }}</th>
                                            <th style="text-align: center" colspan="2">{{ __('Naik') }}</th>
                                            <th style="text-align: center" colspan="2">{{ __('Turun') }}</th>
                                            <th style="text-align: center" rowspan="2">{{ __('File') }}</th>
                                            <th style="text-align: center" rowspan="2">{{ __('Action') }}</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center">{{ __('Intersept') }}</th>
                                            <th style="text-align: center">{{ __('X Variable') }}</th>
                                            <th style="text-align: center">{{ __('Intersept') }}</th>
                                            <th style="text-align: center">{{ __('X Variable') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sertifikat_inventaris as $row)
                                            @php
                                                $data = json_decode($row->data);
                                            @endphp
                                            <tr>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $data->intercept_naik }}</td>
                                                <td>{{ $data->intercept_turun }}</td>
                                                <td>{{ $data->x_variable_naik }}</td>
                                                <td>{{ $data->x_variable_turun }}</td>
                                                <td><a
                                                        href="{{ route('getDownload', ['inventaris_id' => $row->inventaris_id, 'id' => $row->id]) }}"><i
                                                            class="ace-icon fa fa-file"></i> Download</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('SertifikatDelete', $row->id) }}"
                                                        method="post" title="Hapus" class="d-inline"
                                                        onsubmit="return confirm('Yakin hapus data?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-outline-danger btn-sm">
                                                            <i class="ace-icon fa fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
    <link href="{{ asset('frontend/css/select2.css') }}" rel="stylesheet" />
@endpush


@push('js')
    <script type="text/javascript">
        function validasiEkstensi() {
            var inputFile = document.getElementById('file');
            var pathFile = inputFile.value;
            var ekstensiOk = /(\.xlsx)$/i;
            if (!ekstensiOk.exec(pathFile)) {
                alert('Silakan upload file yang memiliki ekstensi .xlsx');
                inputFile.value = '';
                return false;
            } else {
                // Preview file
                if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview').innerHTML = '<iframe src="' + e.target.result +
                            '" style="height:400px; width:600px"/>';
                    };
                    reader.readAsDataURL(inputFile.files[0]);
                }
            }
        }
    </script>
@endpush
