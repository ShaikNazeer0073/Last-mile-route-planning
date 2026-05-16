@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-box me-2"></i>Orders</h1>
        <p class="text-muted mb-0">Quick delivery orders for groceries, essentials, and local retail</p>
    </div>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> New Order
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Delivery Address</th>
                    <th>Store</th>
                    <th>Partner</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('orders.show', $order) }}">
                                {{ $order->order_number }}
                            </a>
                        </td>
                        <td>{{ $order->customer_name }}</td>
                        <td class="text-muted small">{{ Str::limit($order->items_summary ?? '-', 20) }}</td>
                        <td class="text-muted small">{{ Str::limit($order->delivery_address, 22) }}</td>
                        <td class="small">{{ $order->deliveryCenter?->name ?? '-' }}</td>
                        <td>{{ $order->driver?->name ?? 'Unassigned' }}</td>
                        <td>@include('partials.status', ['status' => $order->status])</td>
                        <td class="text-end">
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection
