@props(['name' => 'NA', 'size' => 64])

@php
    $clean    = trim(preg_replace('/^(Dr\.|Nr\.|Nurse)\s+/i', '', $name));
    $parts    = preg_split('/\s+/', $clean);
    $initials = strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr(end($parts) ?: '', 0, 1));
    $tone     = abs(crc32($clean)) % 6;
@endphp

<div {{ $attributes->merge(['class' => 'avatar av-' . $tone]) }} style="--size: {{ $size }}px" aria-hidden="true">{{ $initials }}</div>
