@extends('admin.layout.app')
@section('title','User Petugas Table')
@section('content')

<section class="content">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">User Masyarakat Table</h1>
            </div>
          </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <a href="/admin/tambah_user_petugas" class="btn btn-primary float-right">Tambah</a>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($user as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->id_petugas }}</td>
                            <td>{{ $row->name }}</td>
                            <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
