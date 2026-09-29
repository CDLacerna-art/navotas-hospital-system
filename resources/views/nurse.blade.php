@extends('layouts.app')

@section('content')

<x-page-header title="Nursing Directory"
               subtitle="Our licensed nurses by role, department and shift."
               crumb="Nurse" />

<div class="grid g-4" style="margin-bottom:24px">
    <x-stat-card icon="fa-user-nurse" tone="violet" :value="count($nurses)" label="Nurses listed" />
    <x-stat-card icon="fa-circle-check" tone="green" :value="collect($nurses)->where('status', 'On Duty')->count()" label="On duty now" />
    <x-stat-card icon="fa-people-arrows" tone="amber" :value="collect($nurses)->where('status', 'On Rounds')->count()" label="On rounds" />
    <x-stat-card icon="fa-building" tone="blue" :value="count($departments)" label="Departments covered" />
</div>

<div data-filter-scope>
    <div class="toolbar">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" data-filter-input placeholder="Search by name, role or department..." aria-label="Search nurses">
        </div>
        <select class="select" data-filter-select aria-label="Filter by status">
            <option value="all">All statuses</option>
            <option>On Duty</option>
            <option>On Rounds</option>
            <option>Off Duty</option>
            <option>On Leave</option>
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
        @foreach ($nurses as $nurse)
            <x-person-card :person="$nurse" type="nurse" />
        @endforeach
    </div>

    <div class="empty-state" data-filter-empty>
        <i class="fa-solid fa-user-nurse"></i>
        <p>No nurses match your filters.</p>
    </div>
</div>

@endsection
