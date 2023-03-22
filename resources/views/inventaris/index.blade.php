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
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Kode Inventaris') }}</th>
                                            <th>{{ __('Kode') }}</th>
                                            <th>{{ __('Tahun Pembelian') }}</th>
                                            <th>{{ __('Ruangan') }}</th>
                                            <th>{{ __('Jenis Alat') }}</th>
                                            <th>{{ __('Merek') }}</th>
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
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inventaris.index') }}",
            columns: [{
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
                    data: 'type',
                    name: 'type.jenis_alat'
                },
                {
                    data: 'brand',
                    name: 'brand.nama_merek'
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
            ],
        });
    </script>
@endpush
