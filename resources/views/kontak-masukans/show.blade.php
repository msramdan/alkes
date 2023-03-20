@extends('layouts.app')

@section('title', __('Detail of Kontak Masukans'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kontak Masukans') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of kontak masukan.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kontak-masukans.index') }}">{{ __('Kontak Masukans') }}</a>
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
                                        <td class="fw-bold">{{ __('Pelaksana Tekni') }}</td>
                                        <td>{{ $kontakMasukan->pelaksana_tekni ? $kontakMasukan->pelaksana_tekni->id : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Judul') }}</td>
                                            <td>{{ $kontakMasukan->judul }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Deksiprsi') }}</td>
                                            <td>{{ $kontakMasukan->deksiprsi }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $kontakMasukan->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $kontakMasukan->updated_at->format('d/m/Y H:i') }}</td>
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
