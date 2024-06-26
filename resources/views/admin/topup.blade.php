@extends('layouts.admin')

@section('content')

<div class="card mb-4 col-6">
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

@endsection