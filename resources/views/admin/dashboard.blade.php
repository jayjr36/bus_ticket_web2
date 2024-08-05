<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container" style="position: relative; z-index: 1;">

    <!-- Background Image -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-image: url('{{ asset('bg.jpg') }}');
        background-size: cover;
        background-position: center;
        z-index: -2;
    "></div>

    <!-- Dark Overlay -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay with 50% opacity */
        z-index: -1;
    "></div>

    <!-- Page Content -->
    <h1 class="mt-4 text-white text-center">Admin Dashboard</h1>
    
    <div class="row justify-content-center mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white shadow" style="background-color: #FF5722;">
                <div class="card-body" style="text-transform: uppercase;">
                    <a href="{{ route('admin.users') }}" class="text-white" style="color: white;">View Users</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white shadow" style="background-color: #FF5722;">
                <div class="card-body" style="text-transform: uppercase;">
                    <a href="{{ route('admin.buses') }}" class="text-white" style="color: white;">View Buses</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white shadow" style="background-color: #FF5722;">
                <div class="card-body" style="text-transform: uppercase;">
                    <a href="{{ route('top-up') }}" class="text-white" style="color: white;">Wallet Topup</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-white shadow" style="background-color: #FF5722;">
                <div class="card-body" style="text-transform: uppercase;">
                    <a href="{{ route('add-user') }}" class="text-white" style="color: white;">Add Users</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
