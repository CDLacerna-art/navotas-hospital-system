@php
    $nav = [
        ['route' => 'home',             'page' => 'home',             'icon' => 'fa-house',       'label' => 'Home'],
        ['route' => 'department',       'page' => 'department',       'icon' => 'fa-sitemap',     'label' => 'Department'],
        ['route' => 'doctor',           'page' => 'doctor',           'icon' => 'fa-user-doctor', 'label' => 'Doctor'],
        ['route' => 'nurse',            'page' => 'nurse',            'icon' => 'fa-user-nurse',  'label' => 'Nurse'],
        ['route' => 'monitor.hospital', 'page' => 'monitor_hospital', 'icon' => 'fa-desktop',     'label' => 'Monitor Hospital'],
    ];
@endphp

<aside class="sidebar" id="sideMenu">
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-mark"><i class="fa-solid fa-hospital"></i></span>
        <span>
            <span class="brand-name">Navotas Hospital</span><br>
            <span class="brand-sub">Management System</span>
        </span>
    </a>

    <nav class="nav">
        @foreach ($nav as $item)
            <a href="{{ route($item['route']) }}"
               class="nav-btn {{ ($page ?? '') === $item['page'] ? 'active' : '' }}">
                <i class="fa-solid {{ $item['icon'] }}"></i>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="sidebar-card">
        <small>24/7 Emergency Hotline</small>
        <strong>(02) 8282-1111</strong>
        <a href="tel:+63282821111"><i class="fa-solid fa-phone-volume"></i> Call now</a>
    </div>
</aside>
