@extends('layouts.app')

@section('title', 'Delivery Routes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-route me-2"></i>Delivery Routes</h1>
        <p class="text-muted mb-0">Short-distance local delivery routes within city areas</p>
    </div>
    <a href="{{ route('routes.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Create Route
    </a>
</div>

<div class="row g-3">
    @forelse($routes as $route)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="card-title fw-bold mb-1">{{ $route->route_name }}</h6>
                            <div>
                                <span class="badge bg-info">{{ $route->estimated_distance }} km</span>
                                <span class="badge bg-primary">{{ $route->estimated_time }}</span>
                                <span class="badge bg-secondary">{{ $route->orders ? $route->orders->count() : 0 }} Orders</span>
                            </div>
                        </div>
                        <div>@include('partials.status', ['status' => $route->status])</div>
                    </div>

                    <div class="mb-3 small">

                        <div class="d-flex align-items-start">
                            <i class="fa-solid fa-location-dot text-success me-2 mt-1"></i>
                            <div>
                                <strong>To:</strong><br>
                                <span class="text-muted">{{ Str::limit($route->end_location, 45) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong class="small">Driver:</strong>
                        @if($route->driver)
                            <span class="badge bg-primary">{{ $route->driver->name }}</span>
                        @else
                            <span class="badge bg-secondary">Unassigned</span>
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('routes.show', $route) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-map me-1"></i> View Route & Map
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('routes.edit', $route) }}" class="btn btn-sm btn-outline-primary flex-grow-1">Edit</a>
                            <form action="{{ route('routes.destroy', $route) }}" method="POST" style="display:inline; flex-grow: 1;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Delete this route?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fa-solid fa-circle-info me-2"></i>
                No routes found. <a href="{{ route('routes.create') }}">Create your first route</a>.
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $routes->links() }}</div>
@endsection
