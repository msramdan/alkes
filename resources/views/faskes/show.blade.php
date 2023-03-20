@extends('layouts.app')

@section('title', __('Detail of Faskes'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Faskes') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of faske.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('faskes.index') }}">{{ __('Faskes') }}</a>
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
                                            <td class="fw-bold">{{ __('Nama Faskes') }}</td>
                                            <td>{{ $faske->nama_faskes }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Jenis Faske') }}</td>
                                        <td>{{ $faske->jenis_faske ? $faske->jenis_faske->nama_jenis_faskes : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Province') }}</td>
                                        <td>{{ $faske->province ? $faske->province->provinsi : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Kabkot') }}</td>
                                        <td>{{ $faske->kabkot ? $faske->kabkot->provinsi_id : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Kecamatan') }}</td>
                                        <td>{{ $faske->kecamatan ? $faske->kecamatan->kabkot_id : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Kelurahan') }}</td>
                                        <td>{{ $faske->kelurahan ? $faske->kelurahan->kecamatan_id : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Alamat') }}</td>
                                            <td>{{ $faske->alamat }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $faske->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $faske->updated_at->format('d/m/Y H:i') }}</td>
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
