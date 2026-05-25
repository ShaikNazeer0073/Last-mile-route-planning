@extends('layouts.app')

@section('title', 'Checkout - FlashIn')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white pt-3 border-0">
                <h4 class="fw-bold"><i class="fa-solid fa-location-dot text-primary me-2"></i>Delivery Details</h4>
            </div>
            <div class="card-body">
                <form id="checkoutForm" method="POST" action="{{ route('checkout.place') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="customer_name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="customer_phone" class="form-control" required placeholder="e.g. 9876543210">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Complete Address</label>
                            <textarea name="delivery_address" class="form-control" rows="3" required placeholder="House No, Building, Street, Landmark..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pincode</label>
                            <input type="text" name="pincode" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <ul class="list-group list-group-flush mb-3">
                    @foreach($cart as $item)
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-semibold">{{ Str::limit($item['name'], 20) }}</span>
                                <br><small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                            </div>
                            <span>₹{{ $item['price'] * $item['quantity'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Delivery Fee</span>
                    <span class="text-success fw-bold">FREE</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total Pay</span>
                    <span class="fw-bold fs-5 text-primary">₹{{ $total }}</span>
                </div>
                
                <button type="submit" form="checkoutForm" class="btn btn-primary w-100 fw-bold py-3 shadow-sm" style="font-size: 1.1rem;">
                    Place Order (COD)
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
