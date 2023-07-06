@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-xl-3 col-sm-6 box-col-3">
                <div class="card radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Faskes</p>
                                <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                        data-bs-target="#modalBrancError">
                                        {{ App\Models\Faske::count() }} Data </a>
                                </h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3">
                <div class="card radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Inventaris Alat</p>
                                <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                        data-bs-target="#modalBrancError">
                                        {{ App\Models\Inventari::count() }} Data </a>
                                </h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3">
                <div class="card radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pelaksana Teknisi</p>
                                <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                        data-bs-target="#modalBrancError">
                                        {{ App\Models\PelaksanaTeknisi::count() }} Data </a>
                                </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 box-col-3">
                <div class="card radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">User</p>
                                <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                        data-bs-target="#modalBrancError">
                                        {{ App\Models\User::count() }} Data </a>
                                </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
