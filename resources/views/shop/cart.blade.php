@extends('layouts.app')

@section('title', 'Your Cart - FlashIn')

@section('content')
<h2 class="fw-bold mb-4"><i class="fa-solid fa-cart-shopping text-primary me-2"></i>Your Cart</h2>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-0">
                @if(session('cart') && count(session('cart')) > 0)
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $details['image'] }}" width="50" height="50" class="rounded me-3" style="object-fit:cover;">
                                            <span class="fw-semibold">{{ $details['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>₹{{ $details['price'] }}</td>
                                    <td>
                                        <span class="badge bg-secondary px-2 py-1">{{ $details['quantity'] }}</span>
                                    </td>
                                    <td class="fw-bold">₹{{ $details['price'] * $details['quantity'] }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-5">
                        <i class="fa-solid fa-basket-shopping fa-3x text-muted mb-3"></i>
                        <h5>Your cart is empty!</h5>
                        <p class="text-muted">Looks like you haven't added anything yet.</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-primary mt-2">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @if(session('cart') && count(session('cart')) > 0)
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Items Total</span>
                    <span>₹{{ $total }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Delivery Fee</span>
                    <span class="text-success fw-bold">FREE</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">To Pay</span>
                    <span class="fw-bold fs-5 text-primary">₹{{ $total }}</span>
                </div>
                
                @auth
                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">Proceed to Checkout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 fw-bold py-2">Login to Checkout</a>
                @endauth
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
