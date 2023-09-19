@extends('layouts.app')

@section('title', __('Faskes'))

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Faskes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('action-import-faskes') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" id="import_faskes" aria-describedby="import_faskes"
                                name="import_faskes" accept=".xlsx" required>
                            <div id="downloadFormat" class="form-text"> <a href="#"><i class="fa fa-download"
                                        aria-hidden="true"></i> Download Format Import</a> </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Faskes') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all faskes.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Faskes') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('faske create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('faskes.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Create a new faske') }}
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
                                        <div class="col-md-3">
                                            <select name="jenisFaskes" id="jenisFaskes" class="form-control select2-form">
                                                <option value="All">All Jenis Faskes
                                                </option>
                                                @foreach ($jenisFaskes as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_jenis_faskes }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="kabkots" id="kabkots" class="form-control select2-form">
                                                <option value="All">All Kabupaten/Kota
                                                </option>
                                                @foreach ($kabkots as $row)
                                                    <option value="{{ $row->id }}">{{ $row->kabupaten_kota }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="btnExport" class="btn btn-success"><i class='fas fa-file-excel'></i>
                                                {{ __('Export') }}</button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i class='fa fa-upload'></i>
                                                Import
                                            </button>
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
                                            <th>{{ __('Nama Faskes') }}</th>
                                            <th>{{ __('Jenis Faske') }}</th>
                                            <th>{{ __('Provinsi') }}</th>
                                            <th>{{ __('Kabupaten/Kota') }}</th>
                                            <th>{{ __('Kecamatan') }}</th>
                                            <th>{{ __('Kelurahan') }}</th>
                                            <th>{{ __('Alamat') }}</th>
                                            <th>{{ __('PIN') }}</th>
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
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .border-pin {
            display: flex;
        }

        .num {
            color: #000;
            background-color: transparent;
            width: 17%;
            height: 90px;
            text-align: center;
            outline: none;
            padding: 1rem 1rem;
            margin: 0 1px;
            font-size: 24px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: .5rem;
            color: rgba(0, 0, 0, 0.5);
        }

        .num:focus,
        .num:valid {
            box-shadow: 0 0 .5rem rgba(20, 3, 255, 0.5);
            inset 0 0 .5rem rgba(20, 3, 255, 0.5);
            border-color: rgba(20, 3, 255, 0.5);
        }
    </style>
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
                data: 'nama_faskes',
                name: 'nama_faskes',
            },
            {
                data: 'jenis_faske',
                name: 'jenis_faske.nama_jenis_faskes'
            },
            {
                data: 'province',
                name: 'province.provinsi'
            },
            {
                data: 'kabkot',
                name: 'kabkot.provinsi_id'
            },
            {
                data: 'kecamatan',
                name: 'kecamatan.kabkot_id'
            },
            {
                data: 'kelurahan',
                name: 'kelurahan.kecamatan_id'
            },
            {
                data: 'alamat',
                name: 'alamat',
            },
            {
                data: 'pin',
                name: 'pin',
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
                url: "{{ route('faskes.index') }}",
                data: function(s) {
                    s.parsed_data = query
                    s.jenisFaskes = $('select[name=jenisFaskes] option').filter(':selected').val()
                    s.kabkots = $('select[name=kabkots] option').filter(':selected').val()
                }
            },
            columns: columns
        });

        $('#jenisFaskes').change(function() {
            table.draw();
        })
        $('#kabkots').change(function() {
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
            var jenisFaskes = $('#jenisFaskes').val();
            var kabkots = $('#kabkots').val();
            var url = '/export-data-faskes/' + jenisFaskes + '/' + kabkots;
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

    <script>
        $(".num").keyup(function() {
            if (this.value.length == this.maxLength) {
                $(this).next('.num').focus();
            }
        });
    </script>

<script>
    $(document).on('click', '#downloadFormat', function(event) {
        event.preventDefault();
        downloadFormat();

    });

    var downloadFormat = function() {
        var url = '../download-format-faskes';
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
                    html: 'Sedang melakukan download format import',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });

            },
            success: function(data) {
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(data);
                var nameFile = 'import_faskes.xlsx'
                console.log(nameFile)
                link.download = nameFile;
                link.click();
                swal.close()
            },
            error: function(data) {
                console.log(data)
                Swal.fire({
                    icon: 'error',
                    title: "Download Format Import failed",
                    text: "Please check",
                    allowOutsideClick: false,
                })
            }
        });
    }
</script>

@endpush
