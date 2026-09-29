@extends('layouts.app')

@section('content')

<x-page-header title="Doctor Directory"
               subtitle="Find a specialist, check availability and book an appointment."
               crumb="Doctor">
    <div class="rank-legend">
        @foreach ($ranks as $r)<span class="tag">{{ $r }}</span>@endforeach
    </div>
</x-page-header>

<div class="grid g-4" style="margin-bottom:24px">
    <x-stat-card icon="fa-user-doctor" :value="count($doctors)" label="Doctors listed" />
    <x-stat-card icon="fa-circle-check" tone="green" :value="collect($doctors)->where('status', 'Available')->count()" label="Available now" />
    <x-stat-card icon="fa-notes-medical" tone="red" :value="collect($doctors)->where('status', 'In Surgery')->count()" label="In surgery" />
    <x-stat-card icon="fa-building" tone="blue" :value="count($departments)" label="Departments covered" />
</div>

<div data-filter-scope>
    <div class="toolbar">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" data-filter-input placeholder="Search by name, specialty or department..." aria-label="Search doctors">
        </div>
        <select class="select" data-filter-select aria-label="Filter by availability">
            <option value="all">All availability</option>
            <option>Available</option>
            <option>In Consultation</option>
            <option>In Surgery</option>
            <option>Busy</option>
            <option>On Leave</option>
            <option>Off Duty</option>
        </select>
        <span class="result-count" data-filter-count></span>
    </div>

    <div class="chips" style="margin-bottom:20px">
        <button type="button" class="chip active" data-filter-chip="all">All departments</button>
        @foreach ($departments as $dept)
            <button type="button" class="chip" data-filter-chip="{{ $dept }}">{{ $dept }}</button>
        @endforeach
    </div>

    <div class="grid g-auto">
        @foreach ($doctors as $doctor)
            <x-person-card :person="$doctor" type="doctor" />
        @endforeach
    </div>

    <div class="empty-state" data-filter-empty>
        <i class="fa-solid fa-user-doctor"></i>
        <p>No doctors match your filters.</p>
    </div>
</div>

@endsection
