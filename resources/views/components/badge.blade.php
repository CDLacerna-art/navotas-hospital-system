@props(['status' => null, 'tone' => null, 'live' => false, 'dot' => true])

@php
    // Maps common hospital statuses to a colour tone.
    $map = [
        'available' => 'green', 'on duty' => 'green', 'active' => 'green', 'stable' => 'green', 'normal' => 'green', 'low' => 'green',
        'in surgery' => 'red', 'critical' => 'red', 'full' => 'red', 'high' => 'red', 'code red' => 'red',
        'in consultation' => 'amber', 'on rounds' => 'amber', 'busy' => 'amber', 'near capacity' => 'amber', 'medium' => 'amber', 'moderate' => 'amber', 'warning' => 'amber',
        'on leave' => 'slate', 'off duty' => 'slate', 'info' => 'blue',
    ];
    $tone = $tone ?? ($map[strtolower((string) $status)] ?? 'slate');
@endphp

<span {{ $attributes->class(['badge', 'badge-' . $tone, 'badge-live' => $live, 'no-dot' => ! $dot]) }}>
    {{ $slot->isEmpty() ? $status : $slot }}
</span>
