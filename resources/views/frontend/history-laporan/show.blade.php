@extends('layouts.master-frontend')
@section('title', 'History Laporan')
@section('content')
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <ul class="list-group">
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/pendataan_administrasi/'.$laporan->no_laporan) }}">Pendataan Administrasi </a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/daftar_alat_ukur/'.$laporan->no_laporan) }}">Daftar Alat Ukur</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/kondisi-lingkungan/'.$laporan->no_laporan) }}">Kondisi Lingkungan</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/pemeriksaan-fisik-fungsi/'.$laporan->no_laporan) }}">Pemeriksaan Fisik & Fungsi Alat</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/keselamatan-listrik/'.$laporan->no_laporan) }}">Pengukuran Keselamatan Listrik</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="#">Pengukuran Kinerja</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                    <li class="list-group-item">
                        <nav class="navbar bg-body-tertiary">
                            <div class="container-fluid d-flex">
                              <a class="navbar-brand" href="{{ url('/web/show/history_laporan/telaah-teknis/'.$laporan->no_laporan) }}">Telaah Teknis</a>
                              <i class="fa-solid fa-angle-right ms-auto"></i>
                            </div>
                        </nav>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
