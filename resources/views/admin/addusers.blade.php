@extends('layouts.admin')

@section('content')
<div class="card mb-4 col-6">
    <div class="card-header fs-5">Register New User</div>
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
@endsection