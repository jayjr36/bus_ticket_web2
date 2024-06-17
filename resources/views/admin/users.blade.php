<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mt-4">Manage Users</h1>
    <div class="card mb-4">
        <div class="card-header">Register New User</div>
        <div class="card-body">
            <form action="{{ url('/admin/users') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" name="card_number" class="form-control" id="card_number" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Top Up User Balance</div>
        <div class="card-body">
            <form action="{{ url('/admin/users/topup') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Select User</label>
                    <select name="user_id" class="form-control" id="user_id" required>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" id="amount" required>
                </div>
                <button type="submit" class="btn btn-primary">Top Up</button>
            </form>
        </div>
    </div>

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
