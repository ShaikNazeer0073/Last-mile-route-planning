{{-- Simple status text badge for inline use --}}
@php
    $label = str_replace('_', ' ', ucfirst($status));
@endphp
<span>{{ $label }}</span>
