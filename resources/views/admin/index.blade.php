@extends('admin.layout.app')
@section('title','Dashboard')
@section('content')
@php

use App\Models\Lelang;
use App\Models\Barang;
use App\Models\User;
use App\Models\HistoryLelang;
@endphp
<section class="content">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard v2</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
      <!-- /.content-header -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cubes"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Barang</span>
                  <span class="info-box-number">
                    {{ Barang::count() }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">On Sales</span>
                  <span class="info-box-number">{{ Lelang::where('status','dibuka')->count() }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-coins"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Sold Barang</span>
                  <span class="info-box-number">{{ Lelang::where('status','ditutup')->count() }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">User Masyarakat</span>
                  <span class="info-box-number">{{ User::where('level','masyarakat')->count() }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <a href="/admin/laporan" class="btn btn-primary float-right"><i class="fas fa-folder-open"></i> Laporan</a>
    </div><!--/. container-fluid -->
  </section>
@endsection
