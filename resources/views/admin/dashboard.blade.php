<!-- resources/views/dashboard.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <!-- <p>Welcome to your Dashboard</p> -->
        <!-- Add your dashboard content here -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Orders</h4>
                  </div>
                  <div id="totalClosing" class="card-body">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Shipping</h4>
                  </div>
                  <div id="totalPotong" class="card-body">
                    0
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Succeded</h4>
                  </div>
                  <div id="totalMasak" class="card-body">
                    0
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Failed</h4>
                  </div>
                  <div id="totalSelesai" class="card-body">
                    0
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
