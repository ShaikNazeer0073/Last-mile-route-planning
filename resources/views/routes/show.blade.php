@extends('layouts.app')

@section('title', $route->route_name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-route me-2"></i>{{ $route->route_name }}</h1>
        <p class="text-muted mb-0">Quick Delivery Route · Bike Delivery · {{ $route->estimated_distance }} km</p>
    </div>
    <div class="gap-2 d-flex">
        <a href="{{ route('routes.edit', $route) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('routes.destroy', $route) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
</div>

<div class="row g-4 mb-4">
    {{-- Route Details --}}
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-gradient"><h5><i class="fa-solid fa-info-circle me-2"></i>Route Details</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Status</label>
                    <div>@include('partials.status', ['status' => $route->status])</div>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Distance</label>
                    <p class="mb-0 fw-bold fs-5">{{ $route->estimated_distance }} km</p>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Estimated Delivery Time</label>
                    <p class="mb-0 fw-bold fs-5">{{ $route->estimated_time }}</p>
                </div>
                <hr>
                @if($route->driver)
                    <div class="mb-0">
                        <label class="form-label small fw-semibold text-muted">Delivery Partner</label>
                        <p class="mb-0">
                            <a href="{{ route('drivers.show', $route->driver) }}">
                                <i class="fa-solid fa-motorcycle me-1"></i>{{ $route->driver->name }}
                            </a>
                        </p>
                        <small class="text-muted">{{ $route->driver->phone }} · {{ $route->driver->vehicle_type }}</small>
                    </div>
                @else
                    <p class="text-muted small mb-0">
                        <i class="fa-solid fa-circle-info me-1"></i> No delivery partner assigned
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- From / To Cards --}}
    <div class="col-lg-8">
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="card route-card-from">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">
                            <i class="fa-solid fa-store me-2 text-primary"></i>From (Dark Store / Warehouse)
                        </h6>
                        <p class="mb-0">{{ $route->start_location }}</p>
                        <small class="text-muted">FlashIn Store · Quick Commerce Hub</small>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="badge bg-primary px-3 py-2">
                        <i class="fa-solid fa-arrow-down"></i>
                        <span class="ms-2">{{ $route->estimated_distance }} km · {{ $route->estimated_time }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card route-card-to">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-2">
                            <i class="fa-solid fa-location-dot me-2 text-success"></i>To (Customer Address)
                        </h6>
                        <p class="mb-0">{{ $route->end_location }}</p>
                        <small class="text-muted">Local Delivery Area</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Map Section (Leaflet + OpenStreetMap — FREE, no API key) --}}
<div class="card mb-4">
    <div class="card-header bg-gradient">
        <h5><i class="fa-solid fa-map me-2"></i>Route on Map</h5>
    </div>
    <div class="card-body p-0">
        <div id="route-map" style="height: 450px; width: 100%; border-radius: 0 0 var(--radius-lg) var(--radius-lg);"></div>
    </div>
    <div class="card-body pt-2 pb-3">
        <div class="text-muted small">
            <i class="fa-solid fa-circle text-primary me-1" style="font-size:8px;"></i> <strong>A</strong> — Store/Warehouse &nbsp;&nbsp;
            <i class="fa-solid fa-circle text-success me-1" style="font-size:8px;"></i> <strong>B</strong> — Customer &nbsp;&nbsp;
            <i class="fa-solid fa-minus text-primary me-1"></i> Delivery Route
        </div>
    </div>
</div>

{{-- Quick Stats --}}
<div class="row g-3">
    <div class="col-md-6 col-lg-3">
        <div class="card metric-card text-center">
            <div class="card-body">
                <i class="fa-solid fa-road fa-lg text-primary mb-2"></i>
                <h2>{{ $route->estimated_distance }}</h2>
                <h6>Distance (km)</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card metric-card text-center">
            <div class="card-body">
                <i class="fa-solid fa-clock fa-lg text-info mb-2"></i>
                <h2 style="font-size:1.5rem;">{{ $route->estimated_time }}</h2>
                <h6>Est. Delivery Time</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card metric-card text-center">
            <div class="card-body">
                <i class="fa-solid fa-signal fa-lg text-warning mb-2"></i>
                <h2 style="font-size:1.2rem;">@include('partials.status', ['status' => $route->status])</h2>
                <h6>Status</h6>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card metric-card text-center">
            <div class="card-body">
                <i class="fa-solid fa-user-check fa-lg text-success mb-2"></i>
                <h2>{{ $route->driver?->name ? '✓' : '–' }}</h2>
                <h6>Partner Assigned</h6>
            </div>
        </div>
    </div>
</div>

{{-- Leaflet CSS & JS (FREE — no API key needed) --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const startLat = {{ $route->start_lat ?? 17.385 }};
    const startLng = {{ $route->start_lng ?? 78.4867 }};
    const endLat = {{ $route->end_lat ?? 17.440 }};
    const endLng = {{ $route->end_lng ?? 78.350 }};

    // Initialize map centered between start and end
    const centerLat = (startLat + endLat) / 2;
    const centerLng = (startLng + endLng) / 2;

    const map = L.map('route-map', {
        scrollWheelZoom: true,
        zoomControl: true,
    }).setView([centerLat, centerLng], 14);

    // Dark-themed map tiles
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO',
        maxZoom: 19,
    }).addTo(map);

    // Custom markers
    const storeIcon = L.divIcon({
        html: '<div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:14px;box-shadow:0 2px 8px rgba(99,102,241,0.5);border:2px solid #fff;">A</div>',
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        className: '',
    });

    const customerIcon = L.divIcon({
        html: '<div style="background:linear-gradient(135deg,#34d399,#059669);color:#fff;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:bold;font-size:14px;box-shadow:0 2px 8px rgba(52,211,153,0.5);border:2px solid #fff;">B</div>',
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        className: '',
    });

    // Add markers
    L.marker([startLat, startLng], { icon: storeIcon })
        .addTo(map)
        .bindPopup('<strong>🏪 Store</strong><br>{{ addslashes($route->start_location) }}');

    L.marker([endLat, endLng], { icon: customerIcon })
        .addTo(map)
        .bindPopup('<strong>📍 Customer</strong><br>{{ addslashes($route->end_location) }}');

    // Fetch route from OSRM (FREE routing API)
    const osrmUrl = `https://router.project-osrm.org/route/v1/driving/${startLng},${startLat};${endLng},${endLat}?overview=full&geometries=geojson`;

    fetch(osrmUrl)
        .then(r => r.json())
        .then(data => {
            if (data.code === 'Ok' && data.routes.length > 0) {
                const coords = data.routes[0].geometry.coordinates.map(c => [c[1], c[0]]);
                L.polyline(coords, {
                    color: '#6366f1',
                    weight: 5,
                    opacity: 0.9,
                    smoothFactor: 1,
                }).addTo(map);

                // Fit map to the route
                const group = L.featureGroup([
                    L.marker([startLat, startLng]),
                    L.marker([endLat, endLng]),
                ]);
                map.fitBounds(group.getBounds().pad(0.15));
            } else {
                // Fallback: draw a straight line
                L.polyline([[startLat, startLng], [endLat, endLng]], {
                    color: '#6366f1',
                    weight: 4,
                    opacity: 0.7,
                    dashArray: '10, 10',
                }).addTo(map);

                map.fitBounds([[startLat, startLng], [endLat, endLng]], { padding: [50, 50] });
            }
        })
        .catch(() => {
            // On error, draw straight line
            L.polyline([[startLat, startLng], [endLat, endLng]], {
                color: '#6366f1',
                weight: 4,
                opacity: 0.7,
                dashArray: '10, 10',
            }).addTo(map);
            map.fitBounds([[startLat, startLng], [endLat, endLng]], { padding: [50, 50] });
        });
});
</script>

<style>
    .route-card-from {
        border-left: 4px solid var(--accent-indigo, #6366f1) !important;
    }
    .route-card-to {
        border-left: 4px solid var(--accent-emerald, #34d399) !important;
    }
    #route-map {
        background: #1a1a2e;
    }
    .leaflet-control-attribution {
        background: rgba(0,0,0,0.6) !important;
        color: rgba(255,255,255,0.5) !important;
        font-size: 10px;
    }
    .leaflet-control-attribution a {
        color: rgba(255,255,255,0.6) !important;
    }
</style>
@endsection
