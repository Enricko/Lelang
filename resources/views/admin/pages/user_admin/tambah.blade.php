@extends('admin.layout.app')
@section('title','Tambah User Petugas')
@section('content')
    <div class="container-fluid">
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
            <div class="card-body">
                <form action="/admin/tambah_data_petugas" method="POST">
                    @csrf
                    <div class="form-group my-2">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name..." required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control @error('level') is-invalid @enderror" required>
                            <option value="">=== Select Level ===</option>
                            <option value="petugas">Petugas</option>
                            <option value="administrasi">Administrasi</option>
                        </select>

                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email..." required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password..." required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                    <button class="btn btn-success float-right" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
