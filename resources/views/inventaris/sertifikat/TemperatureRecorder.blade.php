@extends('layouts.app')

@section('title', __('Temperature Recorder'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h5>{{ __('Temperature Recorder') }} {{ $data->kode_inventaris }}</h5>
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

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 1') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_1" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_1" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 2') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_2" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_2" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_2" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 3') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_3" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_3" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_3" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 4') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_4" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_4" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_4" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 5') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_5" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_5" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_5" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 6') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_6" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_6" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_6" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 6') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_7" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_7" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_7" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 8') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_8" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_8" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_8" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 9') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_9" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_9" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_9" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="uc_suhu">{{ __('Channel 10') }}</label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Slope" name="slope_10" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Intersept" name="intercept_10" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" step="0.00000000000000001" class="form-control"
                                                    placeholder="Uc" name="uc_10" required>
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
                                    $dataSertifikat = DB::table('sertifikat_inventaris')
                                        ->where('inventaris_id', $data->id)
                                        ->get();
                                @endphp
                                <table class="table table-xs table-bordered" id="data-table" width="100%"
                                    style="text-align: center; vertical-align: middle;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">{{ __('Tahun') }}</th>
                                            <th colspan="3">{{ __('Channel 1') }}</th>
                                            <th colspan="3">{{ __('Channel 2') }}</th>
                                            <th colspan="3">{{ __('Channel 3') }}</th>
                                            <th colspan="3">{{ __('Channel 4') }}</th>
                                            <th colspan="3">{{ __('Channel 5') }}</th>
                                            <th colspan="3">{{ __('Channel 6') }}</th>
                                            <th colspan="3">{{ __('Channel 7') }}</th>
                                            <th colspan="3">{{ __('Channel 8') }}</th>
                                            <th colspan="3">{{ __('Channel 9') }}</th>
                                            <th colspan="3">{{ __('Channel 10') }}</th>
                                            <th rowspan="2">{{ __('File') }}</th>
                                            <th rowspan="2">{{ __('Action') }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                            <th>{{ __('Slope') }}</th>
                                            <th>{{ __('Intersept') }}</th>
                                            <th>{{ __('Uc') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataSertifikat as $row)
                                            @php
                                                $data = json_decode($row->data);
                                            @endphp
                                            <tr>
                                                <td>{{ $row->tahun }}</td>
                                                <td>{{ $data->slope_1 }}</td>
                                                <td>{{ $data->intercept_1 }}</td>
                                                <td>{{ $data->uc_1 }}</td>
                                                <td>{{ $data->slope_2 }}</td>
                                                <td>{{ $data->intercept_2 }}</td>
                                                <td>{{ $data->uc_2 }}</td>

                                                <td>{{ $data->slope_3 }}</td>
                                                <td>{{ $data->intercept_3 }}</td>
                                                <td>{{ $data->uc_3 }}</td>

                                                <td>{{ $data->slope_4 }}</td>
                                                <td>{{ $data->intercept_4 }}</td>
                                                <td>{{ $data->uc_4 }}</td>

                                                <td>{{ $data->slope_5 }}</td>
                                                <td>{{ $data->intercept_5 }}</td>
                                                <td>{{ $data->uc_5 }}</td>

                                                <td>{{ $data->slope_6 }}</td>
                                                <td>{{ $data->intercept_6 }}</td>
                                                <td>{{ $data->uc_6 }}</td>

                                                <td>{{ $data->slope_7 }}</td>
                                                <td>{{ $data->intercept_7 }}</td>
                                                <td>{{ $data->uc_7 }}</td>

                                                <td>{{ $data->slope_8 }}</td>
                                                <td>{{ $data->intercept_8 }}</td>
                                                <td>{{ $data->uc_8 }}</td>

                                                <td>{{ $data->slope_9 }}</td>
                                                <td>{{ $data->intercept_9 }}</td>
                                                <td>{{ $data->uc_9 }}</td>

                                                <td>{{ $data->slope_10 }}</td>
                                                <td>{{ $data->intercept_10 }}</td>
                                                <td>{{ $data->uc_10 }}</td>
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
