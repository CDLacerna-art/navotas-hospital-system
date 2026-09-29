@extends('layouts.app')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="hero-inner">
        <span class="eyebrow"><i class="fa-solid fa-heart-pulse"></i> Navotas City Government Hospital</span>
        <h2>Quality healthcare, right here in Navotas.</h2>
        <p class="lead">Four coordinated hospitals, 24/7 emergency care and specialists you can trust services at par with private hospitals.</p>

        <div class="hero-actions">
            <a href="{{ route('register') }}" class="btn btn-light"><i class="fa-regular fa-calendar-check"></i> Book an Appointment</a>
            <a href="{{ route('department') }}" class="btn btn-ghost-light"><i class="fa-solid fa-sitemap"></i> Explore Departments</a>
        </div>

        <blockquote class="hero-quote">
            "A few years ago, we envisioned having a hospital of our own. Our city government did not want to build a mere facility that treats patients. We wanted it to offer quality services, services that are at par with private hospitals".
        </blockquote>
    </div>
</section>

{{-- ============ EMERGENCY / CONTACT STRIP ============ --}}
<section class="emergency-strip" aria-label="Emergency and contact information">
    @foreach ($contacts as $c)
        <div class="{{ $c['hot'] ? 'hot' : '' }}">
            <i class="fa-solid {{ $c['icon'] }}"></i>
            <div><small>{{ $c['label'] }}</small><strong>{{ $c['value'] }}</strong></div>
        </div>
    @endforeach
</section>

{{-- ============ STATISTICS ============ --}}
<section class="section">
    <div class="grid g-4">
        @foreach ($stats as $s)
            <x-stat-card :icon="$s['icon']" :value="$s['value']" :label="$s['label']" :tone="$s['tone']" />
        @endforeach
    </div>
</section>

{{-- ============ HOSPITAL INTRO ============ --}}
<section class="section">
    <div class="why">
        <div class="why-panel">
            <h2>A hospital built for Navoteños</h2>
            <p>Hospital A serves as the city's COVID-19 center, while Hospitals B, C and D provide trauma, maternal-child and surgical support — all connected through one management system.</p>
            <div><a href="{{ route('monitor.hospital') }}" class="btn btn-light"><i class="fa-solid fa-desktop"></i> Monitor Hospital</a></div>
        </div>
        <div class="why-list">
            @foreach ($whyChooseUs as $w)
                <div class="card why-item hover-lift">
                    <i class="fa-solid {{ $w['icon'] }}"></i>
                    <div><h4>{{ $w['title'] }}</h4><p>{{ $w['text'] }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ SERVICES ============ --}}
<section class="section">
    <x-section-head title="Our Services" subtitle="Comprehensive care under one roof." />
    <div class="grid g-3">
        @foreach ($services as $svc)
            <div class="card service-card hover-lift">
                <div class="service-icon"><i class="fa-solid {{ $svc['icon'] }}"></i></div>
                <h3>{{ $svc['title'] }}</h3>
                <p>{{ $svc['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection
