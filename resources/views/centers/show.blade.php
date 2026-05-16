@extends('layouts.app')

@section('title', $center->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">{{ $center->name }}</h1>
        <p class="text-muted mb-0">{{ $center->type_label }} — {{ $center->location }}</p>
    </div>
    <div class="gap-2 d-flex">
        <a href="{{ route('centers.edit', $center) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('centers.destroy', $center) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-info-circle me-2"></i>Store Info</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Type</label>
                    <p class="mb-0">{{ $center->type_label }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Location</label>
                    <p class="mb-0">{{ $center->location }}</p>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Phone</label>
                    <p class="mb-0">{{ $center->phone ?? '—' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Email</label>
                    <p class="mb-0">{{ $center->email ?? '—' }}</p>
                </div>
                <div class="mb-0">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <div>@include('partials.status', ['status' => $center->status])</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-box me-2"></i>Orders ({{ $center->orders->count() }})</h5></div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Address</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($center->orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->customer_name }}</td>
                                <td class="text-muted small">{{ $order->items_summary ?? '-' }}</td>
                                <td class="text-muted small">{{ Str::limit($order->delivery_address, 25) }}</td>
                                <td>@include('partials.status', ['status' => $order->status])</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No orders from this store.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if($center->drivers->count())
<div class="card">
    <div class="card-header bg-gradient"><h5><i class="fa-solid fa-motorcycle me-2"></i>Delivery Partners ({{ $center->drivers->count() }})</h5></div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Name</th><th>Phone</th><th>Vehicle</th><th>Status</th></tr></thead>
            <tbody>
                @foreach($center->drivers as $driver)
                    <tr>
                        <td><a href="{{ route('drivers.show', $driver) }}">{{ $driver->name }}</a></td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->vehicle_type }}</td>
                        <td>@include('partials.status', ['status' => $driver->status])</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
