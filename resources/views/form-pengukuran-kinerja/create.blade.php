@extends('layouts.app')

@section('title', __('Buat Form Pengukuran Kinerja'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Form Pengukuran Kinerja') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Buat Baru Form Pengukuran Kinerja.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('form-pengukuran-kinerjas.index') }}">{{ __('Form Pengukuran Kinerja') }}</a>
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
                            <div class="dropdown d-inline-block mb-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Tambah
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item" href="#" id="btn-show-add-single-input-form" data-bs-toggle="modal" data-bs-target="#formSingleInputModal">Single Input</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" id="btn-show-add-table-input-form" data-bs-toggle="modal" data-bs-target="#formTableInputModal">Table Input</a>
                                    </li>
                                </ul>
                            </div>
                            @include('form-pengukuran-kinerja.include.form')
                            <div class="d-flex flex-row gap-2 mb-3">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('form-pengukuran-kinerja.include.modal-form-single-input')
    @include('form-pengukuran-kinerja.include.modal-form-table-input')
@endsection

@push('css')
    <style>
        .flex-row[layout*=row] {
        border: 1px solid red;
        }
        .flex-row[layout*=row] div {
        height: 130px;
        border-right: 1px solid red;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function replaceSpaceWithUnderscore(string) {

            // clean all symbol except alphanumeric and space
            string = string.replace(/[^a-zA-Z0-9 ]/g, '')
            string = string.toLowerCase()

            return string.replaceAll(' ', '_')
        }

        function formTableInputFunction() {
            return {
                isRequired: false,
                position: null,
                title: null,
                rowTotal: 0,
                parameters: [],
                addParameter() {
                    this.$nextTick(() => {
                        this.parameters.push({
                            name: null,
                            subParameters: [],
                            isRequired: false,
                        })
                    })
                },
                addSubParameter(parameterIndex) {
                    this.parameters[parameterIndex].subParameters.push({
                        name: null,
                        subSubParameters: [],
                        isRequired: false,
                    })
                },
                addSubSubParameter(parameterIndex, subParameterIndex) {
                    this.parameters[parameterIndex].subParameters[subParameterIndex].subSubParameters.push({
                        name: null,
                        isRequired: false,
                    })
                },
                removeParameter(index) {
                    this.parameters.splice(index, 1)
                },
                removeSubParameter(parameterIndex, subParameterIndex) {
                    this.parameters[parameterIndex].subParameters.splice(subParameterIndex, 1)
                },
                removeSubSubParameter(parameterIndex, subParameterIndex, subSubParameterIndex) {
                    this.parameters[parameterIndex].subParameters[subParameterIndex].subSubParameters.splice(subSubParameterIndex, 1)
                },
            }
        }

        $(document).ready(function () {
            $('#formSingleInputModal').on('show.bs.modal', function (event) {
                console.log('show.bs.modal')
                // const button = $(event.relatedTarget)
                // const name = button.data('name')
                // const modal = $(this)
                // modal.find('.modal-title').text('Single Input - ' + name)
            })

            $('#formTableInputModal').on('show.bs.modal', function (event) {
                console.log('hide.bs.modal')
                // const button = $(event.relatedTarget)
                // const name = button.data('name')
                // const modal = $(this)
                // modal.find('.modal-title').text('Table Input - ' + name)
            })
        })

    </script>
@endpush
