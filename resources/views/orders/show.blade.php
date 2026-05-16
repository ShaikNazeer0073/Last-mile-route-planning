@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-box me-2"></i>{{ $order->order_number }}</h1>
        <p class="text-muted mb-0">{{ $order->customer_name }} — {{ $order->deliveryCenter?->name ?? 'No store' }}</p>
    </div>
    <div class="gap-2 d-flex">
        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>

{{-- Route Card: Store → Customer --}}
<div class="card mb-4">
    <div class="card-header bg-gradient"><h5><i class="fa-solid fa-truck-fast me-2"></i>Delivery Route</h5></div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <div class="mb-2">
                    <i class="fa-solid fa-store fa-2x text-primary"></i>
                </div>
                <h6 class="fw-bold">{{ $order->deliveryCenter?->name ?? 'Unknown Store' }}</h6>
                <small class="text-muted">{{ $order->deliveryCenter?->type_label ?? '' }}</small>
                <br><small class="text-muted">{{ $order->deliveryCenter?->location ?? '' }}</small>
            </div>
            <div class="col-md-2 text-center">
                <div class="my-3">
                    <i class="fa-solid fa-arrow-right fa-lg text-info"></i>
                    @if($order->route)
                        <div class="mt-1">
                            <span class="badge bg-info">{{ $order->route->estimated_distance }} km</span>
                            <br>
                            <small class="text-muted">{{ $order->route->estimated_time }}</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-5 text-center">
                <div class="mb-2">
                    <i class="fa-solid fa-location-dot fa-2x text-success"></i>
                </div>
                <h6 class="fw-bold">{{ $order->customer_name }}</h6>
                <small class="text-muted">{{ $order->delivery_address }}</small>
            </div>
        </div>
    </div>
</div>

{{-- Items --}}
@if($order->items_summary)
<div class="card mb-4">
    <div class="card-header bg-gradient"><h5><i class="fa-solid fa-cart-shopping me-2"></i>Order Items</h5></div>
    <div class="card-body">
        <p class="mb-0 fs-6">{{ $order->items_summary }}</p>
    </div>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-user me-2"></i>Customer Details</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Name</label>
                    <p class="mb-0">{{ $order->customer_name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Phone</label>
                    <p class="mb-0">{{ $order->customer_phone }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Email</label>
                    <p class="mb-0">{{ $order->customer_email ?? '—' }}</p>
                </div>
                <div class="mb-0">
                    <label class="form-label small fw-semibold text-muted">Delivery Address</label>
                    <p class="mb-0">{{ $order->delivery_address }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-info-circle me-2"></i>Order Details</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <div>@include('partials.status', ['status' => $order->status])</div>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Store</label>
                    <p class="mb-0">
                        @if($order->deliveryCenter)
                            <a href="{{ route('centers.show', $order->deliveryCenter) }}">{{ $order->deliveryCenter->name }}</a>
                            <br><small class="text-muted">{{ $order->deliveryCenter->type_label }}</small>
                        @else
                            —
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Delivery Partner</label>
                    <p class="mb-0">
                        @if($order->driver)
                            <a href="{{ route('drivers.show', $order->driver) }}">{{ $order->driver->name }}</a>
                            <br><small class="text-muted">{{ $order->driver->phone }} · {{ $order->driver->vehicle_type }}</small>
                        @else
                            <span class="text-muted">Unassigned</span>
                        @endif
                    </p>
                </div>
                <div class="mb-0">
                    <label class="form-label small fw-semibold text-muted">Route</label>
                    <p class="mb-0">
                        @if($order->route)
                            <a href="{{ route('routes.show', $order->route) }}">{{ $order->route->route_name }}</a>
                            <br><small class="text-muted">{{ $order->route->estimated_distance }} km · {{ $order->route->estimated_time }}</small>
                        @else
                            <span class="text-muted">No route assigned</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
