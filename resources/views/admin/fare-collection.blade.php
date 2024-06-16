<!-- resources/views/admin/fare-collection.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mt-4">Fare Collection for Bus: {{ $bus->name }}</h1>
    <form action="{{ url("/admin/buses/{$bus->id}/fare-collection") }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="date">Select Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $date }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Total Fare Collected: ${{ $totalFare }}</h5>
        </div>
    </div>
</div>
@endsection
