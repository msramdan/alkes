@extends('layouts.auth')

@section('title', __('Log in'))

@push('css')
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/auth.css">
@endpush

@section('content')
    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">

                <h1 class="auth-title">{{ __('Log in.') }}</h1>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible show fade">
                        <ul class="ms-0 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    <p>{{ $error }}</p>
                                </li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror"
                            name="email" autocomplete="email" placeholder="Email" required autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" autocomplete="current-password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">{{ __('Log in') }}</button>
                </form>

                <div class="text-center mt-4 text-lg fs-4">
                    @if (Route::has('password.request'))
                        <p>
                            <a class="font-bold" href="{{ route('password.request') }}">
                                {{ __('Forgot password') }}?
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right">
            </div>
        </div>
    </div>
@endsection
