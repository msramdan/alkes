@extends('layouts.app')

@section('title', __('Infusion Device Analyzer'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h5>{{ __('Infusion Device Analyzer') }} {{ $data->kode_inventaris }}</h5>
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

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 1') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" step="0.000000001" class="form-control"
                                                    placeholder="Slope" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" step="0.000000001" class="form-control"
                                                    placeholder="Intersept" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 2') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" step="0.000000001" class="form-control"
                                                    placeholder="Slope" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" step="0.000000001" class="form-control"
                                                    placeholder="Intersept" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Drift Channel') }}</label>
                                        <table class="table table-xs table-bordered" style="text-align: center; vertical-align: middle;">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Setting</th>
                                                    <th colspan="2">akurasi alat = 0.1 ml/h</th>
                                                </tr>
                                                <tr>
                                                    <th>Channel 1</th>
                                                    <th>Channel 2</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>10</th>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                </tr>
                                                <tr>
                                                    <th>50</th>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                </tr>
                                                <tr>
                                                    <th>100</th>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                </tr>
                                                <tr>
                                                    <th>500</th>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                    <td><input type="text" step="0.000000001" class="form-control"
                                                            placeholder="" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
                                    $dataSertifikat = DB::table('sertifikat_thermohygrometer')
                                        ->where('inventaris_id', $data->id)
                                        ->get();
                                @endphp
                                <table class="table table-xs table-bordered" id="data-table" width="100%" style="text-align: center; vertical-align: middle;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">{{ __('Tahun') }}</th>
                                            <th colspan="2">{{ __('Channel 1') }}</th>
                                            <th colspan="2">{{ __('Channel 2') }}</th>
                                            <th colspan="2">{{ __('Drift Channel') }}</th>
                                            <th rowspan="2">{{ __('File') }}</th>
                                            <th rowspan="2">{{ __('Action') }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Channel 1') }}</th>
                                            <th>{{ __('Channel 2') }}</th>
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
