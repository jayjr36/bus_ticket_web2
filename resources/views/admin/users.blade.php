<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">All Users</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Card Number</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->card->card_number }}</td> 
                        <td>{{ $user->card->balance }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection