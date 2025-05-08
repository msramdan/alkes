@extends('layouts.app')

@section('title', __('Solar Power Meter'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h5>{{ __('Solar Power Meter') }} {{ $data->kode_inventaris }}</h5>
                </div>
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

                                    <div class="card-header">
                                        <h6 class="card-title">BPM Parameters</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="slope_bpm">{{ __('Slope BPM') }}</label>
                                            <input type="number" step="0.00000000000000001" class="form-control"
                                                placeholder="" name="slope_bpm" id="slope_bpm" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="intercept_bpm">{{ __('Intercept BPM') }}</label>
                                            <input type="number" step="0.00000000000000001" class="form-control"
                                                placeholder="" name="intercept_bpm" id="intercept_bpm" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="u_bpm">{{ __('Uncertainty (U) BPM') }}</label>
                                            <input type="number" step="0.00000000000000001" name="u_bpm" id="u_bpm"
                                                class="form-control" value="" required />
                                        </div>
                                    </div>

                                    <div class="card-header mt-3">
                                        <h6 class="card-title">O2 Parameters</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="slope_o2">{{ __('Slope O2') }}</label>
                                            <input type="number" step="0.00000000000000001" class="form-control"
                                                placeholder="" name="slope_o2" id="slope_o2" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="intercept_o2">{{ __('Intercept O2') }}</label>
                                            <input type="number" step="0.00000000000000001" class="form-control"
                                                placeholder="" name="intercept_o2" id="intercept_o2" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="u_o2">{{ __('Uncertainty (U) O2') }}</label>
                                            <input type="number" step="0.00000000000000001" name="u_o2" id="u_o2"
                                                class="form-control" value="" required />
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="file">{{ __('File Excel') }}</label>
                                        <input type="file" name="file" id="file" class="form-control"
                                            value="" required onchange="return validasiEkstensi()" />
                                    </div>
                                </div>
                                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
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
                                    $dataSertifikat = DB::table('sertifikat_inventaris')
                                        ->where('inventaris_id', $data->id)
                                        ->get();
                                @endphp
                                <table class="table table-xs table-bordered" id="data-table" width="100%"
                                    style="text-align: center; vertical-align: middle;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">{{ __('Tahun') }}</th>
                                            <th colspan="3">BPM</th>
                                            <th colspan="3">O2</th>
                                            <th rowspan="2">{{ __('File') }}</th>
                                            <th rowspan="2">{{ __('Action') }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intercept') }}</th>
                                            <th>{{ __('Uncertainty') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intercept') }}</th>
                                            <th>{{ __('Uncertainty') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataSertifikat as $row)
                                            @php
                                                $data = json_decode($row->data);
                                            @endphp
                                            <tr>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $data->slope_bpm ?? '-' }}</td>
                                                <td>{{ $data->intercept_bpm ?? '-' }}</td>
                                                <td>{{ $data->u_bpm ?? '-' }}</td>
                                                <td>{{ $data->slope_o2 ?? '-' }}</td>
                                                <td>{{ $data->intercept_o2 ?? '-' }}</td>
                                                <td>{{ $data->u_o2 ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('getDownload', ['inventaris_id' => $row->inventaris_id, 'id' => $row->id]) }}">
                                                        <i class="ace-icon fa fa-file"></i> Download
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('SertifikatDelete', $row->id) }}" method="post"
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
    <style>
        .card-header {
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }
        .card-header h6 {
            margin-bottom: 0;
            font-weight: 600;
        }
    </style>
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
