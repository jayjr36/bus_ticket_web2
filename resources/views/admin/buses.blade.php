<!-- resources/views/admin/buses.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mt-4">All Buses</h1>
    <a href="{{route('admin.addBusForm')}}" class="btn btn-sm btn-success-outline">New Bus</a>
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bus Name</th>
                        <th>Routes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buses as $bus)
                    <tr>
                        <td>{{ $bus->name }}</td>
                        <td>
                            <ul>
                                @foreach ($bus->routes as $route)
                                <li>{{ $route->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ url("/admin/buses/{$bus->id}/passengers") }}" class="btn btn-primary">View Passengers</a>
                            <a href="{{ url("/admin/buses/{$bus->id}/fare-collection") }}" class="btn btn-success">View Fare Collection</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
