@extends('layouts.app')

@section('content')
<x-page-header title="Personal Information" subtitle="User profile information details." crumb="Information" />

<div class="card" style="max-width:560px">
    <div class="person-head" style="margin-bottom:18px">
        <x-avatar name="Guest User" :size="72" />
        <div>
            <h3>Guest User</h3>
            <x-badge tone="slate">Not signed in</x-badge>
        </div>
    </div>
    <p style="color:var(--muted);margin-bottom:18px">Sign in to view and update your profile, appointments and medical records.</p>
    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
</div>
@endsection
