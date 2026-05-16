@extends('layouts.app')

@section('title', 'Stores & Warehouses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-store me-2"></i>Stores & Warehouses</h1>
        <p class="text-muted mb-0">Stores, warehouses, and local fulfillment hubs</p>
    </div>
    <a href="{{ route('centers.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Store
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Store Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Orders</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($centers as $center)
                    <tr>
                        <td>
                            <a href="{{ route('centers.show', $center) }}">
                                {{ $center->name }}
                            </a>
                        </td>
                        <td>{{ $center->type_label }}</td>
                        <td class="text-muted small">{{ Str::limit($center->location, 35) }}</td>
                        <td>{{ $center->phone ?? '-' }}</td>
                        <td><span class="badge bg-info">{{ $center->orders_count ?? 0 }}</span></td>
                        <td>@include('partials.status', ['status' => $center->status])</td>
                        <td class="text-end">
                            <a href="{{ route('centers.edit', $center) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('centers.destroy', $center) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No stores found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $centers->links() }}</div>
@endsection
