@extends('layouts.app')

@section('title', 'FlashIn Store - 10 Min Delivery')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold"><i class="fa-solid fa-bag-shopping text-primary me-2"></i>FlashIn Store</h2>
        <p class="text-muted">Groceries and essentials delivered in minutes!</p>
    </div>
    <div class="col-md-4">
        <form action="{{ route('shop.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search for milk, bread..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row g-4">
    <!-- Categories Sidebar -->
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                <h6 class="fw-bold text-uppercase text-muted">Categories</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('shop.index') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active fw-bold' : '' }}">All Items</a>
                    @foreach($categories as $category)
                        @if($category)
                        <a href="{{ route('shop.index', ['category' => $category]) }}" class="list-group-item list-group-item-action {{ request('category') == $category ? 'active fw-bold' : '' }}">
                            {{ $category }}
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="col-lg-9">
        <div class="row g-3">
            @forelse($products as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm product-card position-relative">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover; border-radius: var(--radius-md) var(--radius-md) 0 0;">
                        <div class="card-body d-flex flex-column p-3">
                            <span class="badge bg-light text-dark align-self-start mb-2 border">{{ $product->category }}</span>
                            <h6 class="card-title fw-bold mb-1" style="font-size: 0.9rem;">{{ Str::limit($product->name, 40) }}</h6>
                            <p class="text-muted small mb-3">{{ $product->stock }} in stock</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5">₹{{ $product->price }}</span>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-primary fw-bold px-3 shadow-sm rounded-pill">ADD</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No products found</h5>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .product-card { transition: transform 0.2s, box-shadow 0.2s; }
    .product-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
</style>
@endsection
