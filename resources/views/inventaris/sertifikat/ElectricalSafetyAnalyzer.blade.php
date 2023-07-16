@extends('layouts.app')

@section('title', __('Sertifikat Thermohygrometer'))

@push('css')
@endpush

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h5>{{ __('Electrical Safety Analyzer') }} {{ $data->kode_inventaris }}</h5>
                </div>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('inventarisSertifikatSave') }}" method="POST"
                                enctype="multipart/form-data">
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

                                    <div class="alert alert-success" role="alert">
                                        <i class="fa fa-arrow-down" aria-hidden="true"></i> LIVE TO NETRAL
                                    </div>

                                    <div class="form-group">
                                        <label for="intercept1">{{ __('Intercept') }}</label>
                                        <input type="number" step="0.000000001" name="intercept1" id="intercept1"
                                            class="form-control" value="" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="x_variable1">{{ __('X Variable') }}</label>
                                        <input type="number" step="0.000000001" name="x_variable1" id="x_variable1"
                                            class="form-control" value="" required />
                                    </div>

                                    <div class="alert alert-success" role="alert">
                                        <i class="fa fa-arrow-down" aria-hidden="true"></i> EARTH TO NETRAL
                                    </div>

                                    <div class="form-group">
                                        <label for="intercept2">{{ __('Intercept') }}</label>
                                        <input type="number" step="0.000000001" name="intercept2" id="intercept2"
                                            class="form-control" value="" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="x_variable2">{{ __('X Variable') }}</label>
                                        <input type="number" step="0.000000001" name="x_variable2" id="x_variable2"
                                            class="form-control" value="" required />
                                    </div>
                                    <div class="alert alert-success" role="alert">
                                        <i class="fa fa-arrow-down" aria-hidden="true"></i> LIVE TO EARTH
                                    </div>
                                    <div class="form-group">
                                        <label for="intercept3">{{ __('Intercept') }}</label>
                                        <input type="number" step="0.000000001" name="intercept3" id="intercept3"
                                            class="form-control" value="" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="x_variable3">{{ __('X Variable') }}</label>
                                        <input type="number" step="0.000000001" name="x_variable3" id="x_variable3"
                                            class="form-control" value="" required />
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
                                    $dataSertifikat = DB::table('sertifikat_electrical_safety_analyzer')
                                        ->where('inventaris_id', $data->id)
                                        ->get();
                                @endphp
                                <table class="table table-bordered" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align: center">{{ __('Tahun') }}</th>
                                            <th colspan="2" style="text-align: center">{{ __('LIVE TO NETRAL') }}</th>
                                            <th colspan="2" style="text-align: center">{{ __('EARTH TO NETRAL') }}
                                            </th>
                                            <th colspan="2" style="text-align: center">{{ __('LIVE TO EARTH') }}</th>
                                            <th rowspan="2" style="text-align: center">{{ __('File') }}</th>
                                            <th rowspan="2" style="text-align: center">{{ __('Action') }}</th>
                                        </tr>
                                        <tr>

                                            <th style="text-align: center">{{ __('Intercept') }}</th>
                                            <th style="text-align: center">{{ __('X Variable') }}</th>

                                            <th style="text-align: center">{{ __('Intercept') }}</th>
                                            <th style="text-align: center">{{ __('X Variable') }}</th>

                                            <th style="text-align: center">{{ __('Intercept') }}</th>
                                            <th style="text-align: center">{{ __('X Variable') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataSertifikat as $row)
                                            <tr>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $row->intercept1 }}</td>
                                                <td>{{ $row->x_variable1 }}</td>
                                                <td>{{ $row->intercept2 }}</td>
                                                <td>{{ $row->x_variable2 }}</td>
                                                <td>{{ $row->intercept3 }}</td>
                                                <td>{{ $row->x_variable3 }}</td>
                                                <td><a href=""><i class="ace-icon fa fa-file"></i> Download</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('EsaDelete', $row->id) }}" method="post"
                                                        title="Hapus" class="d-inline"
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
