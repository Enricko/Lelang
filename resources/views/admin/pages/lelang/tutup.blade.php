@extends('admin.layout.app')
@section('title','History Lelang Table')
@section('content')
@php
    use App\Models\User;
@endphp

<section class="content">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">History Lelang Table</h1>
            </div>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <table id="myTable" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Dibuka</th>
                            <th>Tanggal Ditutup</th>
                            <th>Harga Awal</th>
                            <th>Harga Tertinggi</th>
                            <th>Penanggung Jawab</th>
                            <th>History Bidding</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1
                        @endphp
                        @foreach ($lelang as $row)
                            @php
                                $petugas = User::where('id_petugas',$row->id_petugas)->first();
                                if ($row->id != null) {
                                    $user = User::where('id',$row->id)->first();
                                }
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><img src="{{ asset('barang_lelang').'/'.$row->image_barang }}" alt="" style="width: 125px"></td>
                                <td>{{ $row->nama_barang }}</td>
                                <td>{{ date('l, d-m-Y H:i:s',strtotime($row->tgl_dibuka)) }}</td>
                                <td>{{ date('l, d-m-Y H:i:s',strtotime($row->tgl_ditutup)) }}</td>
                                <td>Rp.{{ number_format($row->harga_awal) }}</td>
                                <td>
                                    <div class="row text-center">
                                        @if ($row->id != null)
                                            <div class="col-12">
                                                <img src="{{ $user->image == null ? asset('image/defultProfile.jpeg') : asset("profile/$user->level").'/'.$user->image }}" alt="" class="rounded-circle" style="width:100px">
                                            </div>
                                            <div class="col-12 my-2">
                                                <h6>{{ $user->name }}</h6>
                                            </div>
                                            <div class="col-12">
                                                <p>Rp.{{ number_format($row->harga_akhir) }}</p>
                                            </div>
                                        @else
                                            <div class="col-12">
                                                <p>No Bidding</p>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <img src="{{ $petugas->image == null ? asset('image/defultProfile.jpeg') : asset("profile/$petugas->level").'/'.$petugas->image }}" alt="" class="rounded-circle" style="width:100px">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <h6>{{ $petugas->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/admin/history_bidding/{{ $row->id_lelang }}" class="btn btn-primary">History Bidding</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
