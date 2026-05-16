@extends('layouts.app')

@section('title', 'Drivers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-motorcycle me-2"></i>Drivers</h1>
        <p class="text-muted mb-0">Manage delivery drivers (bike riders)</p>
    </div>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Driver
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Vehicle</th>
                    <th>Center</th>
                    <th>License</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                    <tr>
                        <td>
                            <a href="{{ route('drivers.show', $driver) }}">
                                {{ $driver->name }}
                            </a>
                        </td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->vehicle_type }}</td>
                        <td class="text-muted small">{{ $driver->deliveryCenter?->name ?? '—' }}</td>
                        <td>{{ $driver->license_number ?? '—' }}</td>
                        <td>@include('partials.status', ['status' => $driver->status])</td>
                        <td class="text-end">
                            <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('drivers.destroy', $driver) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No drivers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $drivers->links() }}</div>
@endsection
