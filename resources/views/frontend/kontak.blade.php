@extends('layouts.master-frontend')
@section('title', 'Kontak')
@section('content')
    <div class="page-content-wrapper">
        <!-- Google Maps-->
        <div class="google-maps-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.992393635513!2d106.79580661458898!3d-6.264729595465527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1992f4bd57d%3A0x2d2b8d3950f0d2b1!2sINFORMA%20-%20FATMAWATI!5e0!3m2!1sen!2sid!4v1679674519597!5m2!1sen!2sid"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

        </div>
        <div class="container">
            <div class="mt-3 rtl-text-right">
                <h5 class="mb-1">Kontak Kami</h5>
                <p class="mb-4">Untuk pertanyaan/saran seputar aplikasi DiGi Form, hubungi kami dengan mengisi form
                    dibawah
                    ini.
                </p>
            </div>
            <!-- Contact Form-->
            <div class="contact-form mt-3 pb-3">
                <form action="{{ route('web-kontak-store') }}" method="POST">
                    @csrf
                    <input class="form-control mb-3" id="" type="text" placeholder="Nama"
                        value="{{ get_data_teknisi()->nama }}" readonly>
                    <input class="form-control mb-3" id="" type="email" placeholder="Email"
                        value="{{ get_data_teknisi()->no_telpon }}" readonly>
                    <input class="form-control mb-3" id="" type="email" placeholder="Email"
                        value="{{ get_data_teknisi()->email }}" readonly>

                    <input class="form-control mb-3" id="pelaksana_teknis_id" type="hidden" name="pelaksana_teknis_id"
                        placeholder="" value="{{ get_data_teknisi()->id }}">
                    <input class="form-control mb-3" id="judul" type="text" placeholder="Judul" name="judul"
                        required>
                    <textarea class="form-control mb-3" id="deksiprsi" cols="30" rows="5" placeholder="Deskripsi"
                        name="deksiprsi" required></textarea>
                    <button class="btn btn-success btn-lg w-100" type="submit">Send Now</button>
                </form>
            </div>
        </div>
    </div>
@endsection
