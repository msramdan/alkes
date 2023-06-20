@extends('layouts.app')

@section('title', __('Digital Pressure Meter'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Digital Pressure Meter') }}</h3>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('inventaris.index') }}">{{ __('Inventaris') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Create') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                @method('POST')
                                {{-- form --}}
                                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
