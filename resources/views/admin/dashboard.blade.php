<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mt-4">Admin Dashboard</h1>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="{{ route('admin.users') }}" class="text-white">View Users</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="{{ route('admin.buses') }}" class="text-white">View Buses</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="{{ route('top-up') }}" class="text-white">Wallet Topup</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <a href="{{ route('add-user') }}" class="text-white">Add users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
