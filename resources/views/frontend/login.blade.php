<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designing-world.com/suha-v3.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Nov 2022 08:16:58 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Aplikasi DiGi FOrm">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags -->
    <!-- Title -->
    <title>DiGi Form - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="icon" href="img/icons/icon-72x72.png">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }} ">
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
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only"></div>
        </div>
    </div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
        <!-- Background Shape-->
        <div class="background-shape"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-lg-8">
                    <div class="register-form mt-5">
                        <form action="{{ route('auth-user') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group text-start mb-4"><span>Email</span>
                                <label for="email"><i class="fa-solid fa-user"></i></label>
                                <input class="form-control" id="email" type="email" name="email" required
                                    placeholder="account@example.com" autocomplete="off">
                                @error('email')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group text-start mb-4"><span>Password</span>
                                <label for="password"><i class="fa-solid fa-key"></i></label>
                                <input class="form-control" id="password" name="password" type="password" required
                                    placeholder="Password">
                                @error('password')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-warning btn-lg w-100" type="submit">Log In</button>
                        </form>
                    </div>
                    <div class="login-meta-data"><a class="forgot-password d-block mt-3 mb-1" href="">Forgot
                            Password?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.passwordstrength.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('frontend/js/theme-switching.js') }}"></script>
        <script src="{{ asset('frontend/js/active.js') }}"></script>
        <script src="{{ asset('frontend/js/pwa.js') }}"></script>
        @include('sweetalert::alert')
</body>

</html>
