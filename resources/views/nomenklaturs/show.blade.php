@extends('layouts.app')

@section('title', __('Jenis Alat Yang Dipakai'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Nomenklaturs') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail Jenis Alat Yang Dipakai') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('nomenklaturs.index') }}">{{ __('Nomenklaturs') }}</a>
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
                            <form action="{{ route('nomenklaturs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    @foreach ($jenis_alat as $row)
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" value=""
                                                        name="type_id[]" aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="text" readonly class="form-control"
                                                    value="{{ $row->jenis_alat }}" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
