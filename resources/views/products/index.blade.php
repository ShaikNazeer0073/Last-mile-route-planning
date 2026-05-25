@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1"><i class="fa-solid fa-boxes-packing me-2"></i>Products</h1>
        <p class="text-muted mb-0">Manage quick-commerce inventory</p>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Product
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $product->image }}" width="40" height="40" class="rounded me-3" style="object-fit:cover;">
                                <span class="fw-semibold">{{ Str::limit($product->name, 40) }}</span>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $product->category }}</span></td>
                        <td class="fw-bold">₹{{ $product->price }}</td>
                        <td>
                            @if($product->stock > 10)
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @else
                                <span class="badge bg-danger">{{ $product->stock }} (Low)</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
