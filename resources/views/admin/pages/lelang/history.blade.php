@extends('admin.layout.app')
@section('title',"History Lelang #$id_lelang Table")
@section('content')
@php
    use App\Models\User;
@endphp

<section class="content">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">History Lelang #{{ $id_lelang }}</h1>
            </div>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Masyarakat</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Penawaran Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1
                        @endphp
                        @foreach ($history as $row)
                            @php
                                $user = User::where('id',$row->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
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
                                <td>{{ $row->telp }}</td>
                                <td>{{ $row->email }}</td>
                                <td>Rp.{{ number_format($row->penawaran_harga) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
