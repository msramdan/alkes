@extends('layouts.app')

@section('title', __('Inventaris'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Inventaris') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all inventaris.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Inventaris') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('inventari create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Create a new inventari') }}
                    </a>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="row g-3">
                                        <div class="col-md-2">
                                            <select name="ruangan" id="ruangan" class="form-control select2-form">
                                                <option value="All">All Ruangan
                                                </option>
                                                @foreach ($rooms as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_ruangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="merek" id="merek" class="form-control select2-form">
                                                <option value="All">All Merek
                                                </option>
                                                @foreach ($brands as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_merek }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="jenis_alat" id="jenis_alat" class="form-control select2-form">
                                                <option value="All">All Jenis Alat
                                                </option>
                                                @foreach ($types as $row)
                                                    <option value="{{ $row->id }}">{{ $row->jenis_alat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="vendor" id="vendor" class="form-control select2-form">
                                                <option value="All">All Vendor
                                                </option>
                                                @foreach ($vendors as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_vendor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button id="btnExport" class="btn btn-success"><i class='fas fa-file-excel'></i>
                                                {{ __('Export') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Kode Inventaris') }}</th>
                                            <th>{{ __('Kode') }}</th>
                                            <th>{{ __('Tahun Pembelian') }}</th>
                                            <th>{{ __('Ruangan') }}</th>
                                            <th>{{ __('Merek') }}</th>
                                            <th>{{ __('Jenis Alat') }}</th>
                                            <th>{{ __('Tipe') }}</th>
                                            <th>{{ __('Serial Number') }}</th>
                                            <th>{{ __('Vendor') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-form').select2();
        });
        let columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'kode_inventaris',
                name: 'kode_inventaris',
            },
            {
                data: 'kode',
                name: 'kode',
            },
            {
                data: 'tahun_pembelian',
                name: 'tahun_pembelian',
            },
            {
                data: 'room',
                name: 'room.nama_ruangan'
            },
            {
                data: 'brand',
                name: 'brand.nama_merek'
            },
            {
                data: 'type',
                name: 'type.jenis_alat'
            },
            {
                data: 'tipe',
                name: 'tipe',
            },
            {
                data: 'serial_number',
                name: 'serial_number',
            },
            {
                data: 'vendor',
                name: 'vendor.nama_vendor'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ];

        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        let query = params.parsed_data;
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('inventaris.index') }}",
                data: function(s) {
                    s.parsed_data = query
                    s.ruangan = $('select[name=ruangan] option').filter(':selected').val()
                    s.merek = $('select[name=merek] option').filter(':selected').val()
                    s.jenis_alat = $('select[name=jenis_alat] option').filter(':selected').val()
                    s.vendor = $('select[name=vendor] option').filter(':selected').val()
                }
            },
            columns: columns
        });

        $('#ruangan').change(function() {
            table.draw();
        })
        $('#merek').change(function() {
            table.draw();
        })
        $('#jenis_alat').change(function() {
            table.draw();
        })
        $('#vendor').change(function() {
            table.draw();
        })
    </script>

    <script>
        const showLoading = function() {
            swal({
                title: 'Now loading',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 2000,
                onOpen: () => {
                    swal.showLoading();
                }
            }).then(
                () => {},
                (dismiss) => {
                    if (dismiss === 'timer') {
                        console.log('closed by timer!!!!');
                        swal({
                            title: 'Finished!',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        })
                    }
                }
            )
        };

        $(document).on('click', '#btnExport', function(event) {
            event.preventDefault();
            exportData();

        });
        var exportData = function() {
            var ruangan = $('#ruangan').val();
            var merek = $('#merek').val();
            var jenis_alat = $('#jenis_alat').val();
            var vendor = $('#vendor').val();
            var url = '/export-data/' + ruangan + '/' + merek + '/' + jenis_alat + '/' + vendor;
            var d = new Date(); // 1-Feb-2011

            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: {},
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'Sedang melakukan proses export data', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                },
                success: function(data) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    var nameFile = 'Report-Inventory.xlsx'
                    console.log(nameFile)
                    link.download = nameFile;
                    link.click();
                    swal.close()
                },
                error: function(data) {
                    console.log(data)
                    Swal.fire({
                        icon: 'error',
                        title: "Data export failed",
                        text: "Please check",
                        allowOutsideClick: false,
                    })
                }
            });
        }
    </script>
@endpush
