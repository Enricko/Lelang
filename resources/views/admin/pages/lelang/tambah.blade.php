@extends('admin.layout.app')
@section('title','Tambah Lelang')
@section('content')

<section class="content">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Lelang Terbuka Table</h1>
            </div>
          </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <form action="/admin/tambah_open_lelang" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="image_barang">Image</label>
                        <input type="file" class="form-control @error('image_barang') is-invalid @enderror" id="image_barang" name="image_barang" placeholder="Image..." required>

                        @error('image_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" placeholder="Nama Barang..." required>

                        @error('nama_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="harga_awal">Harga Awal</label>
                        <input type="number" class="form-control @error('harga_awal') is-invalid @enderror" id="harga_awal" name="harga_awal" placeholder="Harga Awal..." required>

                        @error('harga_awal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="lama_lelang">Lama Lelang</label>
                        <input type="number" class="form-control @error('lama_lelang') is-invalid @enderror" id="lama_lelang" name="lama_lelang" placeholder="Lama Lelang..." required max='10' oninput="if(value >= 10){ value = 10 }">

                        @error('lama_lelang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="deskripsi_barang">Deskripsi Barang</label>
                        <input type="text" class="form-control @error('deskripsi_barang') is-invalid @enderror" id="deskripsi_barang" name="deskripsi_barang" placeholder="Deskripsi Barang..." required>

                        @error('deskripsi_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-success float-right" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
