@extends('frontend.layout.app')
@section('title','Lelang')
@section('content')
    <div class="container-fluid text-light">
        <div class="card" style="background-color:#858585;">
            <div class="card-header">
                <h3 class="text-center my-2">History Lelang</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($lelang as $row)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="/item_lelang/{{ $row->id_lelang }}" >
                                <div class="card" style="background-color:#616161;height:400px">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-center my-3">
                                            <img src="{{ asset("barang_lelang/$row->image_barang") }}" alt="" style="width:200px">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $row->nama_barang }}</h4>
                                        @if ($row->harga_akhir == null)
                                            <h5>Belum ada penawar</h5>
                                        @else
                                            <h5>Tertinggi : Rp.{{ number_format($row->harga_akhir) }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
