@php
    $label = str_replace('_', ' ', ucfirst($status));
@endphp

@switch($status)
    @case('active')
    @case('available')
        <span class="badge bg-success">{{ $label }}</span>
        @break
    @case('pending')
        <span class="badge bg-warning">{{ $label }}</span>
        @break
    @case('assigned')
    @case('planned')
        <span class="badge bg-info">{{ $label }}</span>
        @break
    @case('picked_up')
    @case('busy')
        <span class="badge bg-primary">{{ $label }}</span>
        @break
    @case('delivered')
    @case('completed')
        <span class="badge bg-success">{{ $label }}</span>
        @break
    @case('offline')
    @case('inactive')
    @case('unavailable')
        <span class="badge bg-secondary">{{ $label }}</span>
        @break
    @default
        <span class="badge bg-secondary">{{ $label }}</span>
@endswitch
