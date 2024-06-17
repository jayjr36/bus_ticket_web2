<!-- resources/views/admin/add-bus.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Add New Bus and Route</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.storeBus') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="bus_name" class="form-label">Bus Name</label>
                <input type="text" class="form-control" id="bus_name" name="bus_name" required>
                @error('bus_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="route_name" class="form-label">Route Name</label>
                <input type="text" class="form-control" id="route_name" name="route_name" required>
                @error('route_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="fare" class="form-label">Fare</label>
                <input type="number" class="form-control" id="fare" name="fare" step="0.01" required>
                @error('fare')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Bus and Route</button>
        </form>
    </div>
@endsection
