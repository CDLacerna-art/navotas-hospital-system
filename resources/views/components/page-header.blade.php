@props(['title', 'subtitle' => null, 'crumb' => null])

<div class="page-header">
    <div>
        <div class="crumbs"><a href="{{ route('home') }}">Home</a>@if ($crumb) &nbsp;/&nbsp; {{ $crumb }}@endif</div>
        <h2>{{ $title }}</h2>
        @if ($subtitle)<p>{{ $subtitle }}</p>@endif
    </div>
    @if (! $slot->isEmpty())
        <div>{{ $slot }}</div>
    @endif
</div>
