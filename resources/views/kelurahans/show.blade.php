@extends('layouts.app')

@section('title', __('Detail of Kelurahans'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kelurahans') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of kelurahan.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kelurahans.index') }}">{{ __('Kelurahans') }}</a>
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
                                        <td class="fw-bold">{{ __('Kecamatan') }}</td>
                                        <td>{{ $kelurahan->kecamatan ? $kelurahan->kecamatan->kabkot_id : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Kelurahan') }}</td>
                                            <td>{{ $kelurahan->kelurahan }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Kd Pos') }}</td>
                                            <td>{{ $kelurahan->kd_pos }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $kelurahan->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $kelurahan->updated_at->format('d/m/Y H:i') }}</td>
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
