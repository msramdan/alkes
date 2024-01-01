@extends('layouts.app')

@section('title', __('Detail of Pelaksana Teknisis'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Pelaksana Teknisis') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of pelaksana teknisi.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pelaksana-teknis.index') }}">{{ __('Pelaksana Teknisis') }}</a>
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
                                        <td class="fw-bold">{{ __('Nama') }}</td>
                                        <td>{{ $pelaksanaTeknisi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Jenis Kelamin') }}</td>
                                        <td>{{ $pelaksanaTeknisi->jenis_kelamin == 1 ? 'True' : 'False' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('No Telpon') }}</td>
                                        <td>{{ $pelaksanaTeknisi->no_telpon }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Email') }}</td>
                                        <td>{{ $pelaksanaTeknisi->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tempat Lahir') }}</td>
                                        <td>{{ $pelaksanaTeknisi->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tangal Lahir') }}</td>
                                        <td>{{ isset($pelaksanaTeknisi->tangal_lahir) ? $pelaksanaTeknisi->tangal_lahir->format('d/m/Y') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Photo') }}</td>
                                        <td>{{ $pelaksanaTeknisi->photo }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Password') }}</td>
                                        <td>{{ $pelaksanaTeknisi->password }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $pelaksanaTeknisi->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $pelaksanaTeknisi->updated_at->format('d/m/Y H:i') }}</td>
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
