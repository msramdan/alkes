@extends('layouts.master-frontend')
@section('title', 'Profile')
@section('content')
    <br>
    <div class="page-content-wrapper">
        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">
                <!-- User Information-->
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-profile me-3"><img src="{{ asset('frontend/img/bg-img/9.jpg') }}" alt="">
                        </div>
                        <div class="user-info">
                            <p class="mb-0 text-dark">@Pelaksana Teknis</p>
                            <h5 class="mb-0">Suha Jannat</h5>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa-solid fa-user"></i><span>Nama</span>
                            </div>
                            <div class="data-content">SUHA JANNAT</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa-solid fa-phone"></i><span>No
                                    Telpon</span>
                            </div>
                            <div class="data-content">083874731480</div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i
                                    class="fa-solid fa-envelope"></i><span>Email</span></div>
                            <div class="data-content">care@example.com </div>
                        </div>
                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i
                                    class="fa-solid fa-location-dot"></i><span>Tempat Lahir</span></div>
                            <div class="data-content">Bogor</div>
                        </div>

                        <div class="single-profile-data d-flex align-items-center justify-content-between">
                            <div class="title d-flex align-items-center"><i class="fa fa-calendar"
                                    aria-hidden="true"></i><span>Tangggal Lahir</span></div>
                            <div class="data-content">11-01-1995</div>
                        </div>
                        <!-- Edit Profile-->
                        <div class="edit-profile-btn mt-3"><a class="btn btn-primary w-100" href="edit-profile.html"><i
                                    class="fa-solid fa-pen me-2"></i>Edit Profile</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
