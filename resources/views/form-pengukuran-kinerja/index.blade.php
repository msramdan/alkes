@extends('layouts.app')

@section('title', __('Form Pengukuran Kinerja'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Form Pengukuran Kinerja') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all Form Pengukuran Kinerja available for use when creating nomenlakture.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Form Pengukuran Kinerja') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            <div class="d-flex justify-content-end">
                <a href="{{ route('form-pengukuran-kinerjas.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i>
                    {{ __('Create a new Form Pengukuran Kinerjai') }}
                </a>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Nama') }}</th>
                                            <th>{{ __('Dibuat Pada') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('form-pengukuran-kinerjas.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    </script>

    <script>
        const showLoading = function() {
            swal({
                title: 'Now loading',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 2000,
                onOpen: () => {
                    swal.showLoading();
                }
            }).then(
                () => {},
                (dismiss) => {
                    if (dismiss === 'timer') {
                        console.log('closed by timer!!!!');
                        swal({
                            title: 'Finished!',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        })
                    }
                }
            )
        };

        // $(document).on('click', '#btnExport', function(event) {
        //     event.preventDefault();
        //     exportData();

        // });
        // var exportData = function() {
        //     var url = '/export-data-teknisi';
        //     $.ajax({
        //         url: url,
        //         type: 'GET',
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //         },
        //         data: {},
        //         xhrFields: {
        //             responseType: 'blob'
        //         },
        //         beforeSend: function() {
        //             Swal.fire({
        //                 title: 'Please Wait !',
        //                 html: 'Sedang melakukan proses export data', // add html attribute if you want or remove
        //                 allowOutsideClick: false,
        //                 onBeforeOpen: () => {
        //                     Swal.showLoading()
        //                 },
        //             });

        //         },
        //         success: function(data) {
        //             var link = document.createElement('a');
        //             link.href = window.URL.createObjectURL(data);
        //             var nameFile = 'Daftar-Teknisi.xlsx'
        //             console.log(nameFile)
        //             link.download = nameFile;
        //             link.click();
        //             swal.close()
        //         },
        //         error: function(data) {
        //             console.log(data)
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: "Data export failed",
        //                 text: "Please check",
        //                 allowOutsideClick: false,
        //             })
        //         }
        //     });
        // }
    </script>
@endpush
