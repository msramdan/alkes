@extends('layouts.app')

@section('title', __('Laporan'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Laporan') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all laporans.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Laporan') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>
            @can('laporan create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('laporans.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Assign a new laporan') }}
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
                                            <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping"><i
                                                        class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" aria-describedby="addon-wrapping"
                                                    id="daterange-btn" value="">
                                                <input type="hidden" name="start_date" id="start_date"
                                                    value="{{ $microFrom }}">
                                                <input type="hidden" name="end_date" id="end_date"
                                                    value="{{ $microTo }}">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <select name="teknisi" id="teknisi" class="form-control select2-form">
                                                <option value="All">All Penginput
                                                </option>
                                                @foreach ($pelaksanaTeknisis as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="faskes" id="faskes" class="form-control select2-form">
                                                <option value="All">All Faskes
                                                </option>
                                                @foreach ($faskes as $row)
                                                    <option value="{{ $row->id }}">{{ $row->nama_faskes }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="status" id="status" class="form-control select2-form">
                                                <option value="All">All Status Laporan</option>
                                                <option value="Initial">Initial</option>
                                                <option value="Need Review">Need Review</option>
                                                <option value="Approved">Approved</option>
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
                                <table class="table table-striped" id="data-table" width="100%" style="min-height: 200px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('No Laporan') }}</th>
                                            <th>{{ __('Tgl Laporan') }}</th>
                                            <th>{{ __('Penginput') }}</th>
                                            <th>{{ __('Faskes') }}</th>
                                            <th>{{ __('Nomenklatur') }}</th>
                                            <th>{{ __('Status Laporan') }}</th>
                                            <th>{{ __('Reviewer') }}</th>
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
    <link href="{{ asset('mazer/css/daterangepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/select2.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="{{ asset('mazer/js/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mazer/js/daterangepicker.min.js') }}"></script>
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
                data: 'no_laporan',
                name: 'no_laporan',
            },
            {
                data: 'tgl_laporan',
                name: 'tgl_laporan',
            },
            {
                data: 'user_created',
                name: 'user_created'
            },
            {
                data: 'nama_faskes',
                name: 'nama_faskes'
            },
            {
                data: 'nama_nomenklatur',
                name: 'nama_nomenklatur'
            },
            {
                data: 'status_laporan',
                name: 'status_laporan',
            },
            {
                data: 'user_review',
                name: 'user_review.name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ];

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('laporans.index') }}",
                data: function(s) {
                    s.start_date = $("#start_date").val();
                    s.end_date = $("#end_date").val();
                    s.teknisi = $('select[name=teknisi] option').filter(':selected').val()
                    s.faskes = $('select[name=faskes] option').filter(':selected').val()
                    s.status = $('select[name=status] option').filter(':selected').val()
                }
            },
            columns: columns
        });

        $('#teknisi').change(function() {
            table.draw();
        })
        $('#faskes').change(function() {
            table.draw();
        })
        $('#status').change(function() {
            table.draw();
        })

        $('#daterange-btn').change(function() {
            table.draw();
        })
    </script>

    <script>
        var start = {{ $microFrom }}
        var end = {{ $microTo }}
        var label = '';
        $('#daterange-btn').daterangepicker({
                locale: {
                    format: 'DD MMM YYYY'
                },
                startDate: moment(start),
                endDate: moment(end),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')],
                }
            },
            function(start, end, label) {
                $('#start_date').val(Date.parse(start));
                $('#end_date').val(Date.parse(end));
                if (isDate(start)) {
                    $('#daterange-btn span').html(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
                }
            });

        function isDate(val) {
            var d = Date.parse(val);
            return Date.parse(val);
        }
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
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var teknisi = $('#teknisi').val();
            var faskes = $('#faskes').val();
            var status = $('#status').val();
            var url = '/export-data-lk/' + start_date + '/' + end_date + '/' + teknisi + '/' + faskes + '/' +
                status;
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
                        html: 'Sedang melakukan proses export data',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                },
                success: function(data) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    var nameFile = 'Laporan-LK.xlsx'
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
