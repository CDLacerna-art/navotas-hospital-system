@extends('layouts.app')

@section('content')
<div class="auth-wrap">
    <div class="card auth-card">
        <x-avatar name="Guest User" :size="72" />
        <h2>Login</h2>

        <form action="{{ route('home') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="form-actions">
                <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
