@extends('layouts.app')

@section('content')

<x-page-header title="Monitor Hospital"
               subtitle="Real-time view of admissions, beds, staffing and alerts across all four hospitals."
               crumb="Monitor Hospital">
    <x-badge tone="teal" :live="true">Live Tracking</x-badge>
</x-page-header>

{{-- ============ EMERGENCY STATUS ============ --}}
<div class="status-banner">
    <div class="left">
        <div class="siren"><i class="fa-solid fa-bell"></i></div>
        <div>
            <h3>Emergency Status: <span style="color:var(--red)">{{ $m['emergency']['level'] }}</span></h3>
            <p>{{ $m['emergency']['message'] }}</p>
        </div>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <x-badge tone="red">Avg wait {{ $m['emergency']['waitTime'] }}</x-badge>
        <x-badge tone="blue">Ambulances {{ $m['emergency']['ambulances']['available'] }}/{{ $m['emergency']['ambulances']['total'] }} free</x-badge>
    </div>
</div>

{{-- ============ HEADLINE STATS ============ --}}
<div class="grid g-3">
    <x-stat-card icon="fa-users" :value="$m['newPatients'] . ' New Patients'" label="Emergency Admissions" note="+12% surge in past hour" />
    <x-stat-card icon="fa-user-doctor" tone="blue" :value="$m['activeDoctors'] . ' Active Doctors'" label="Consulting / Operating" note="No rosters outstanding" />
    <x-stat-card icon="fa-heart-pulse" tone="red" :value="$m['operations'] . ' Operations'" label="Scheduled Surgeons"
                 :note="$m['staffing']['surgery']['cardio'] . ' Cardio, ' . $m['staffing']['surgery']['trauma'] . ' Trauma, ' . $m['staffing']['surgery']['general'] . ' Gen'" :warn="true" />
</div>

<div class="grid g-4" style="margin-top:20px">
    <x-stat-card icon="fa-hospital-user" tone="teal" :value="$m['totalPatients']" label="Total patients admitted" note="Across 4 hospitals" />
    <x-stat-card icon="fa-bed" tone="green" :value="$m['beds']['available']" label="Beds available" :note="'of ' . $m['beds']['total'] . ' total'" />
    <x-stat-card icon="fa-bed-pulse" tone="amber" :value="$m['beds']['occupied']" label="Beds occupied" :note="$m['beds']['percent'] . '% occupancy'" :warn="$m['beds']['percent'] > 85" />
    <x-stat-card icon="fa-user-nurse" tone="violet" :value="$m['nursesOnDuty']" label="Nurses on duty" note="Day + evening shift" />
</div>

{{-- ============ CHARTS + CAPACITY ============ --}}
<div class="grid g-main" style="margin-top:20px">
    <div class="card">
        <div class="card-head">
            <div>
                <h2>Patient Admission Trend</h2>
                <p>Inpatient admissions recorded per hour over 24 hrs</p>
            </div>
            <x-badge tone="teal" :live="true">Live Tracking</x-badge>
        </div>
        <div class="chart-box"><canvas id="trendChart" aria-label="Admissions per hour"></canvas></div>
    </div>

    <div class="card">
        <div class="card-head"><div><h2>Department Capacity Utilization</h2></div></div>
        @foreach ($m['capacity'] as $c)
            <x-progress-bar :label="$c['label']" :value="$c['value']" />
        @endforeach
    </div>
</div>

{{-- ============ BEDS + STAFF + TRIAGE ============ --}}
<div class="grid g-3" style="margin-top:20px">
    <div class="card">
        <div class="card-head"><div><h2>Bed Occupancy</h2><p>All hospitals combined</p></div></div>
        <div class="donut-wrap">
            <div class="donut-center">
                <canvas id="bedChart" aria-label="Bed occupancy"></canvas>
                <div class="mid"><strong>{{ $m['beds']['percent'] }}%</strong><span>occupied</span></div>
            </div>
            <ul class="legend">
                <li><span class="k" style="--c:#0d9488">Occupied</span><strong>{{ $m['beds']['occupied'] - $m['beds']['critical'] }}</strong></li>
                <li><span class="k" style="--c:#34d399">Available</span><strong>{{ $m['beds']['available'] - $m['beds']['cleaning'] }}</strong></li>
                <li><span class="k" style="--c:#f59e0b">Cleaning</span><strong>{{ $m['beds']['cleaning'] }}</strong></li>
                <li><span class="k" style="--c:#e11d48">Critical</span><strong>{{ $m['beds']['critical'] }}</strong></li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-head"><div><h2>Staff on Duty</h2><p>Current shift coverage</p></div></div>
        <div class="staff-split" style="margin-bottom:18px">
            <div class="mini-metric"><small>Doctors</small><strong>{{ $m['staffing']['doctors']['onDuty'] }}</strong><span>of {{ $m['staffing']['doctors']['total'] }} total</span></div>
            <div class="mini-metric"><small>Nurses</small><strong>{{ $m['staffing']['nurses']['onDuty'] }}</strong><span>of {{ $m['staffing']['nurses']['total'] }} total</span></div>
        </div>
        <x-progress-bar label="Doctor coverage" :value="(int) round($m['staffing']['doctors']['onDuty'] / $m['staffing']['doctors']['total'] * 100)" tone="blue" />
        <x-progress-bar label="Nurse coverage" :value="(int) round($m['staffing']['nurses']['onDuty'] / $m['staffing']['nurses']['total'] * 100)" tone="blue" />
    </div>

    <div class="card">
        <div class="card-head"><div><h2>ER Triage Queue</h2><p>Patients waiting by priority</p></div></div>
        <div class="chart-box sm"><canvas id="triageChart" aria-label="Triage queue"></canvas></div>
    </div>
</div>

{{-- ============ DEPARTMENT STATUS + ALERTS ============ --}}
<div class="grid g-main" style="margin-top:20px">
    <div class="card">
        <div class="card-head"><div><h2>Department Status</h2><p>Live patient load per unit</p></div></div>
        <div class="table-wrap">
            <table class="table">
                <thead><tr><th>Department</th><th>Patients</th><th>Status</th></tr></thead>
                <tbody>
                @foreach ($m['departmentStatus'] as $d)
                    <tr>
                        <td><i class="fa-solid {{ $d['icon'] }}" style="color:var(--teal-600);width:24px"></i> <strong>{{ $d['name'] }}</strong></td>
                        <td>{{ $d['patients'] }}</td>
                        <td><x-badge :status="$d['status']" /></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-head"><div><h2>Alerts &amp; Notifications</h2></div><x-badge tone="red" :dot="false">{{ count($m['alerts']) }} new</x-badge></div>
        <ul class="alert-list">
            @foreach ($m['alerts'] as $a)
                <li class="alert-item {{ $a['level'] }}">
                    <div class="ico"><i class="fa-solid {{ $a['icon'] }}"></i></div>
                    <div>
                        <h4>{{ $a['title'] }}</h4>
                        <p>{{ $a['text'] }}</p>
                        <time>{{ $a['time'] }}</time>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
    (function () {
        if (typeof Chart === 'undefined') return;   // CDN blocked → cards and tables still work

        Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
        Chart.defaults.color = '#64748b';

        // Admissions per hour
        new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                labels: @json($m['trend']['labels']),
                datasets: [{
                    data: @json($m['trend']['values']),
                    borderColor: '#0d9488', backgroundColor: 'rgba(13,148,136,.12)',
                    fill: true, tension: .35, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: { label: c => c.parsed.y + ' admissions' } } },
                scales: {
                    y: { beginAtZero: true, suggestedMax: 120, grid: { color: '#eef2f6' } },
                    x: { grid: { display: false }, ticks: { maxTicksLimit: 7 } }
                }
            }
        });

        // Bed occupancy donut
        new Chart(document.getElementById('bedChart'), {
            type: 'doughnut',
            data: {
                labels: ['Occupied', 'Available', 'Cleaning', 'Critical'],
                datasets: [{
                    data: [{{ $m['beds']['occupied'] - $m['beds']['critical'] }}, {{ $m['beds']['available'] - $m['beds']['cleaning'] }}, {{ $m['beds']['cleaning'] }}, {{ $m['beds']['critical'] }}],
                    backgroundColor: ['#0d9488', '#34d399', '#f59e0b', '#e11d48'], borderWidth: 0,
                }]
            },
            options: { maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false } } }
        });

        // Triage bars
        new Chart(document.getElementById('triageChart'), {
            type: 'bar',
            data: {
                labels: ['Immediate', 'Urgent', 'Non-urgent'],
                datasets: [{
                    data: [{{ $m['emergency']['triage']['red'] }}, {{ $m['emergency']['triage']['yellow'] }}, {{ $m['emergency']['triage']['green'] }}],
                    backgroundColor: ['#e11d48', '#f59e0b', '#10b981'], borderRadius: 8, maxBarThickness: 46,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, grid: { color: '#eef2f6' } }, x: { grid: { display: false } } }
            }
        });
    })();
</script>
@endpush
