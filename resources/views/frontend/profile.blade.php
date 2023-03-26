@extends('layouts.master-frontend')
<<<<<<< HEAD
@section('title', 'Toko Online')
@section('content')
    <div class="page-content-wrapper">
        <!-- Hero Wrapper -->
        <div class="hero-wrapper">
            <div class="container">
                <div class="pt-3">
                    <div class="hero-slides owl-carousel">
                        @foreach ($banner as $row)
                            <div class="single-hero-slide"
                                style="background-image: url('{{ asset('storage/img/banner_image/' . $row->banner_image) }}')">
                            </div>
                        @endforeach
=======
@section('title', 'Profile')
@section('content')
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">
                <!-- User Information-->
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-profile me-3">
                            <img src="{{ Storage::url('public/img/teknisi/' . get_data_teknisi()->photo) }}" alt="avatar">

                        </div>
                        <div class="user-info">
                            <p class="mb-0 text-dark">@Pelaksana Teknis</p>
                            <h5 class="mb-0">{{ get_data_teknisi()->nama }}</h5>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa-solid fa-user"></i><span>Nama</span>
                            </div>
                            <div class="data-content">{{ get_data_teknisi()->nama }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i
                                    class="fa-solid fa-person-half-dress"></i><span>Jenis
                                    Kelamin</span>
                            </div>
                            <div class="data-content">{{ get_data_teknisi()->jenis_kelamin }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa-solid fa-phone"></i><span>No
                                    Telpon</span>
                            </div>
                            <div class="data-content">{{ get_data_teknisi()->no_telpon }}</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i
                                    class="fa-solid fa-envelope"></i><span>Email</span></div>
                            <div class="data-content">{{ get_data_teknisi()->email }} </div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i
                                    class="fa-solid fa-location-dot"></i><span>Tempat Lahir</span></div>
                            <div class="data-content">{{ get_data_teknisi()->tempat_lahir }}</div>
                        </div>

                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa fa-calendar"
                                    aria-hidden="true"></i><span>Tangggal Lahir</span></div>
                            <div class="data-content">{{ get_data_teknisi()->tangal_lahir }}</div>
                        </div>
                        <!-- Edit Profile-->
                        <form action="{{ route('auth-update-password') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="mb-2">
                                <div class="title mb-1"><span>Password Lama</span></div>
                                <input class="form-control @error('password_lama') is-invalid @enderror" type="password"
                                    value="{{ old('password_lama') }}" name="password_lama" id="password_lama" required>
                                @error('password_lama')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <div class="title mb-1"><span>Password Baru</span></div>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    value="{{ old('password') }}" id="password" name="password" required>
                                @error('password')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <div class="title mb-1"><span>Konfirmasi Password</span>
                                </div>
                                <input class="form-control @error('konfirmasi_password') is-invalid @enderror"
                                    type="password" value="{{ old('konfirmasi_password') }}" id="konfirmasi_password"
                                    name="konfirmasi_password" required>
                                {{-- @error('password')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <div class="edit-profile-btn">
                                <button type="submit" class="btn btn-success w-100">Update
                                    Password</button>
                            </div>
                        </form>
>>>>>>> 33dd60af9be0542831cc8b9ec0eb1ed15a85fcef
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD

        <div class="container">
            <div class="dark-mode-wrapper mt-3 bg-img p-4 p-lg-5">
                <center>
                    <p class="text-white">AAAA Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </center>
            </div>
        </div>
=======
>>>>>>> 33dd60af9be0542831cc8b9ec0eb1ed15a85fcef
    </div>
@endsection
