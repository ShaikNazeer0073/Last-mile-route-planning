@extends('layouts.app')

@section('title', 'Edit Order ' . $order->order_number)

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-pen me-2"></i>Edit Order {{ $order->order_number }}</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf @method('PUT')
        @include('orders.form', ['order' => $order])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
