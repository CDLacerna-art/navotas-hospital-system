@props(['title', 'subtitle' => null, 'href' => null, 'linkText' => 'View all'])

<div class="section-head">
    <div>
        <h2>{{ $title }}</h2>
        @if ($subtitle)<p>{{ $subtitle }}</p>@endif
    </div>
    @if ($href)
        <a class="link-more" href="{{ $href }}">{{ $linkText }} <i class="fa-solid fa-arrow-right"></i></a>
    @endif
</div>
