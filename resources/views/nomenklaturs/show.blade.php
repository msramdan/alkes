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
                            <form action="{{ route('save_equipment_type') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <input type="hidden" name="nomenklatur_id" value="{{ $nomenklatur->id }}" readonly>
                                    @foreach ($jenis_alat as $row)
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" name="type_id[]"
                                                        value="{{ $row->id }}"
                                                        {{ checked_box($nomenklatur->id, $row->id) }}
                                                        aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="text" readonly class="form-control"
                                                    value="{{ $row->jenis_alat }}" aria-label="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" id="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
{{--
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var tmp = [];
            $("input[type='checkbox']").change(function() {
                var checked = $(this).val();
                if ($(this).is(':checked')) {
                    tmp.push(checked);
                } else {
                    tmp.splice($.inArray(checked, tmp), 1);
                }
                var res = tmp.length;
                // console.log(res);
                if (res > 0) {
                    $('#submit').prop('disabled', false);
                } else if (res == 0) {
                    $('#submit').prop('disabled', true);
                }
            });
        });
    </script>
@endpush --}}
