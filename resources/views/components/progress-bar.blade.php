@props(['label' => '', 'value' => 0, 'tone' => null, 'suffix' => '%'])

@php
    // Colour by load unless a tone is forced.
    $tone = $tone ?? ($value >= 95 ? 'red' : ($value >= 80 ? 'amber' : 'green'));
@endphp

<div class="progress-row">
    <div class="progress-meta">
        <span>{{ $label }}</span>
        <strong>{{ $value }}{{ $suffix }}</strong>
    </div>
    <div class="progress" role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
        <span class="{{ $tone }}" style="width: 0" data-w="{{ min($value, 100) }}"></span>
    </div>
</div>
