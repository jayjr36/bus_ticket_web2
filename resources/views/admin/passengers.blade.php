<!-- resources/views/admin/passengers.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mt-4">Passengers for Bus: {{ $bus->name }}</h1>
    <form action="{{ url("/admin/buses/{$bus->id}/passengers") }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="date">Select Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $date }}">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Route</th>
                        <th>Fare</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->user->email }}</td>
                        <td>{{ $ticket->route->name }}</td>
                        <td>{{ $ticket->fare }}</td>
                        <td>{{ $ticket->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
