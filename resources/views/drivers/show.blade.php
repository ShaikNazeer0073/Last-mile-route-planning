@extends('layouts.app')

@section('title', $driver->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-user-tie me-2"></i>{{ $driver->name }}</h1>
        <p class="text-muted mb-0">{{ $driver->vehicle_type }} Rider</p>
    </div>
    <div class="gap-2 d-flex">
        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-id-card me-2"></i>Driver Info</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Phone</label>
                    <p class="mb-0">{{ $driver->phone }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Email</label>
                    <p class="mb-0">{{ $driver->email ?? '—' }}</p>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">License</label>
                    <p class="mb-0">{{ $driver->license_number ?? '—' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Vehicle</label>
                    <p class="mb-0">{{ $driver->vehicle_type }}</p>
                </div>
                <div class="mb-0">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <div>@include('partials.status', ['status' => $driver->status])</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        {{-- Orders --}}
        <div class="card mb-4">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-box me-2"></i>Assigned Orders ({{ $driver->orders->count() }})</h5></div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Order #</th><th>Customer</th><th>Address</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($driver->orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->customer_name }}</td>
                                <td class="text-muted small">{{ Str::limit($order->delivery_address, 30) }}</td>
                                <td>@include('partials.status', ['status' => $order->status])</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No orders assigned.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Routes --}}
        <div class="card">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-route me-2"></i>Routes ({{ $driver->routes->count() }})</h5></div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>Route</th><th>Distance</th><th>Time</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($driver->routes as $route)
                            <tr>
                                <td><a href="{{ route('routes.show', $route) }}">{{ $route->route_name }}</a></td>
                                <td>{{ $route->estimated_distance }} km</td>
                                <td>{{ $route->estimated_time }}</td>
                                <td>@include('partials.status', ['status' => $route->status])</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No routes assigned.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
