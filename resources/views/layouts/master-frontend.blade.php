<!DOCTYPE html>
<html lang="en">
{{-- @php
    $setting_web = DB::table('setting_toko')->first();
@endphp --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
</head>

<body>
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between d-flex rtl-flex-d-row-r">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper"><a href="{{ route('home') }}">
                    {{-- @if ($setting_web->logo != '' || $setting_web->logo != null) --}}
                    <img src="{{ asset('frontend/img/logo.png') }}" alt="" style="width: 70%">
                    {{-- @endif --}}
                </a></div>
            <div class="navbar-logo-container d-flex align-items-center">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" id="darkSwitch" type="checkbox" role="switch">
                    {{-- <label class="form-check-label text-white h6 mb-0" for="darkSwitch">Dark Mode</label> --}}
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="footer-nav-area" id="footerNav">
        <div class="suha-footer-nav">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0 d-flex rtl-flex-d-row-r">
                <li><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href="{{ route('web-profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                <li><a href="{{ route('web-kontak') }}"><i class="fa-solid fa-phone" aria-hidden="true"></i>Kontak</a>
                </li>
                <li><a href="{{ route('signout-user') }}"><i class="fa-solid fa-sign-out"
                            aria-hidden="true"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.passwordstrength.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/theme-switching.js') }}"></script>
    <script src="{{ asset('frontend/js/active.js') }}"></script>
    @stack('js')
    @include('sweetalert::alert')
</body>

</html>
