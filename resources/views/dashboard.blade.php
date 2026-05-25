@extends('layouts.app')

@section('title', 'Dashboard - FlashIn Delivery')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-gauge me-2"></i>Dashboard</h1>
        <p class="text-muted mb-0">Overview of local delivery operations</p>
    </div>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> New Order
    </a>
</div>

{{-- Main Metric Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card metric-card">
            <div class="card-body text-center">
                <i class="fa-solid fa-box fa-lg text-primary mb-2"></i>
                <h2>{{ $totalOrders }}</h2>
                <h6>Total Orders</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card metric-card">
            <div class="card-body text-center">
                <i class="fa-solid fa-circle-check fa-lg text-success mb-2"></i>
                <h2>{{ $deliveredOrders }}</h2>
                <h6>Delivered</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card metric-card">
            <div class="card-body text-center">
                <i class="fa-solid fa-motorcycle fa-lg text-info mb-2"></i>
                <h2>{{ $activeDrivers }}</h2>
                <h6>Active Drivers</h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card metric-card">
            <div class="card-body text-center">
                <i class="fa-solid fa-route fa-lg text-warning mb-2"></i>
                <h2>{{ $totalRoutes }}</h2>
                <h6>Total Routes</h6>
            </div>
        </div>
    </div>
</div>

{{-- Status Overview --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="status-badge pending">
            <h6>{{ $pendingOrders }}</h6>
            <p>Pending Orders</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="status-badge in-transit">
            <h6>{{ $assignedOrders }}</h6>
            <p>Assigned / In Transit</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="status-badge active">
            <h6>{{ $totalRoutes }}</h6>
            <p>Active Routes</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="status-badge delivered">
            <h6>{{ $deliveredOrders }}</h6>
            <p>Delivered Orders</p>
        </div>
    </div>
</div>

{{-- Recent Tables --}}
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-gradient">
                <h5><i class="fa-solid fa-box me-2"></i>Recent Orders</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td>{{ $order->customer_name }}</td>
                                <td>@include('partials.status', ['status' => $order->status])</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-gradient">
                <h5><i class="fa-solid fa-route me-2"></i>Recent Routes</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Route</th>
                            <th>Driver</th>
                            <th>Distance</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRoutes as $route)
                            <tr>
                                <td>
                                    <a href="{{ route('routes.show', $route) }}">
                                        {{ $route->route_name }}
                                    </a>
                                </td>
                                <td>{{ $route->driver?->name ?? 'Unassigned' }}</td>
                                <td>{{ $route->estimated_distance }} km</td>
                                <td>@include('partials.status', ['status' => $route->status])</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No routes yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
