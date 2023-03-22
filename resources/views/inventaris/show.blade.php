@extends('layouts.app')

@section('title', __('Detail of Inventaris'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Inventaris') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of inventari.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('inventaris.index') }}">{{ __('Inventaris') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                            <td class="fw-bold">{{ __('Kode Inventaris') }}</td>
                                            <td>{{ $inventari->kode_inventaris }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Kode') }}</td>
                                            <td>{{ $inventari->kode }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tahun Pembelian') }}</td>
                                            <td>{{ $inventari->tahun_pembelian }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Room') }}</td>
                                        <td>{{ $inventari->room ? $inventari->room->nama_ruangan : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Type') }}</td>
                                        <td>{{ $inventari->type ? $inventari->type->jenis_alat : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Brand') }}</td>
                                        <td>{{ $inventari->brand ? $inventari->brand->nama_merek : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tipe') }}</td>
                                            <td>{{ $inventari->tipe }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Serial Number') }}</td>
                                            <td>{{ $inventari->serial_number }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Vendor') }}</td>
                                        <td>{{ $inventari->vendor ? $inventari->vendor->nama_vendor : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $inventari->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $inventari->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
