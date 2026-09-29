@extends('layouts.app')

@section('content')

<x-page-header title="Healthcare System Departments"
               subtitle="Hospital A is the COVID-19 center; Hospitals B, C and D are supporting hospitals. Browse services, staff and contact details for every department."
               crumb="Department">
    <a href="{{ route('register') }}" class="btn btn-primary"><i class="fa-regular fa-calendar-check"></i> Request Appointment</a>
</x-page-header>

{{-- Hospital hierarchy --}}
<div class="hierarchy" style="margin-bottom:24px">
    @foreach ($hospitals as $h)
        <div class="hosp-node {{ $h['primary'] ? 'primary' : '' }}">
            <h4><i class="fa-solid fa-hospital"></i> {{ $h['code'] }}</h4>
            <p>{{ $h['role'] }}</p>
            <div class="beds">{{ $h['occupied'] }} / {{ $h['beds'] }} beds occupied</div>
        </div>
    @endforeach
</div>

<div data-filter-scope>

    <div class="toolbar">
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" data-filter-input placeholder="Search departments or services..." aria-label="Search departments">
        </div>
        <div class="chips">
            <button type="button" class="chip active" data-filter-chip="all">All</button>
            @foreach ($hospitals as $h)
                <button type="button" class="chip" data-filter-chip="{{ $h['code'] }}">{{ $h['code'] }}</button>
            @endforeach
        </div>
        <span class="result-count" data-filter-count></span>
    </div>

    <div class="grid g-auto">
        @foreach ($departments as $d)
            @php
                $pct  = $d['beds'] > 0 ? (int) round($d['occupied'] / $d['beds'] * 100) : null;
                $stat = $pct === null ? null : ($pct >= 100 ? 'Full' : ($pct >= 85 ? 'Near Capacity' : 'Normal'));
            @endphp
            <article class="card dept-card hover-lift"
                     data-filter-item
                     data-search="{{ $d['name'] }} {{ $d['description'] }} {{ implode(' ', $d['services']) }} {{ $d['hospital'] }}"
                     data-group="{{ $d['hospital'] }}">

                <div class="dept-top">
                    <div class="service-icon"><i class="fa-solid {{ $d['icon'] }}"></i></div>
                    <div style="flex:1">
                        <h3>{{ $d['name'] }}</h3>
                        <div class="where"><i class="fa-solid fa-hospital"></i> {{ $d['hospital'] }} · Head: {{ $d['head'] }}</div>
                    </div>
                    @if ($stat)<x-badge :status="$stat" />@endif
                </div>

                <div class="dept-body">
                    <p>{{ $d['description'] }}</p>

                    @if ($pct !== null)
                        <x-progress-bar :label="'Bed occupancy (' . $d['occupied'] . '/' . $d['beds'] . ')'" :value="$pct" />
                    @endif

                    <div class="dept-label">Services offered</div>
                    <div class="tag-list">
                        @foreach ($d['services'] as $s)<span class="tag">{{ $s }}</span>@endforeach
                    </div>


            </article>
        @endforeach
    </div>

</div>

@endsection
