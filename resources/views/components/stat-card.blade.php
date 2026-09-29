@props([
    'icon'  => 'fa-chart-simple',
    'value' => '0',
    'label' => '',
    'note'  => null,
    'tone'  => 'teal',   // teal | red | amber | blue | violet | green
    'warn'  => false,
])

<div {{ $attributes->merge(['class' => 'stat']) }}>
    <div class="stat-icon tone-{{ $tone }}"><i class="fa-solid {{ $icon }}"></i></div>
    <div>
        <div class="stat-value">{{ $value }}</div>
        <div class="stat-label">{{ $label }}</div>
        @if ($note)
            <div class="stat-note {{ $warn ? 'warn' : '' }}">{{ $note }}</div>
        @endif
    </div>
</div>
