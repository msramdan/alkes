@extends('layouts.master-frontend')
@section('title', 'List Metode Kerja')
@section('content')
    <div class="page-content-wrapper">
        <div class="py-3">
            <div class="container">
                <div class="row g-2">
                    {{-- mulai --}}
                    @foreach ($metodekerja as $metodekerjas)
                        <div class="col-12" style="background-color: #FFF;  border-radius:5px">
                            <div class="horizontal-product-card">
                                <div class="d-flex align-items-center">
                                    <div class="product-thumbnail-side">
                                        <a class="product-thumbnail shadow-sm d-block" href="#"><img
                                                src="{{ asset('frontend/img/hospital2.png') }}" alt=""
                                                style="width: 80%"></a>
                                    </div>
                                    <div class="product-description" style="margin-top: 5px; margin-bottom:5px">
                                        <a class="product-title d-block" href="#">{{ $metodekerjas->nama_nomenklatur }}</a>
                                        <p class="sale-price"><i class="fa fa-tag" aria-hidden="true"></i>
                                            Jenis Faskes : {{ $metodekerjas->no_dokumen }}</p>
                                        
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Views
                                              </button>

                                            
                                            {{-- <div class="product-rating"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                {{ $faskesdatas->kabupaten_kota }}                                   
                                            </div> --}}




                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="h-100 d-flex align-items-center justify-content-center" style="margin-top: 7px">
                {{ $metodekerja->links() }}
            </div>
            
        </div>
    </div>
  
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
    
    
@endsection
