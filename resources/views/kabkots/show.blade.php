@extends('layouts.app')

@section('title', __('Detail of Kabkots'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Kabkots') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of kabkot.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kabkots.index') }}">{{ __('Kabkots') }}</a>
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
                                        <td class="fw-bold">{{ __('Province') }}</td>
                                        <td>{{ $kabkot->province ? $kabkot->province->provinsi : '' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Kabupaten Kota') }}</td>
                                            <td>{{ $kabkot->kabupaten_kota }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Ibukota') }}</td>
                                            <td>{{ $kabkot->ibukota }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('K Bsni') }}</td>
                                            <td>{{ $kabkot->k_bsni }}</td>
                                        </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $kabkot->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $kabkot->updated_at->format('d/m/Y H:i') }}</td>
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
