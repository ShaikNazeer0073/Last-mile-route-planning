@extends('layouts.app')

@section('title', 'Order Placed - FlashIn')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-6 text-center">
        <div class="card border-0 shadow-sm py-5">
            <div class="card-body">
                <div class="mb-4">
                    <i class="fa-solid fa-circle-check text-success" style="font-size: 5rem;"></i>
                </div>
                <h2 class="fw-bold mb-3">Order Placed Successfully!</h2>
                <p class="text-muted fs-5 mb-4">Your essentials will arrive in about 10 minutes. Our delivery partner is heading to the store.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary px-4 py-2 fw-bold">Keep Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
