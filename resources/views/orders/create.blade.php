@extends('layouts.app')

@section('title', 'New Order')

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-box me-2"></i>New Order</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @include('orders.form', ['order' => new App\Models\Order()])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
