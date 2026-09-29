<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $currentTitle ?? 'Home' }} | Navotas Hospital System</title>

    <!-- Font + Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Hospital CSS -->
    <link rel="stylesheet" href="{{ asset('css/navotas.css') }}">

    @stack('styles')
</head>
<body>

<div class="app">

    @include('partials.sidebar')

    <div class="shell">

        @include('partials.topbar')

        <main class="content">
            @yield('content')
        </main>

    </div>

    <div class="scrim" onclick="toggleSideMenu()"></div>
</div>

<script src="{{ asset('js/hospital.js') }}"></script>
@stack('scripts')
</body>
</html>
