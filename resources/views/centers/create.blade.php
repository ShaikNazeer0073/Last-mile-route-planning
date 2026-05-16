@extends('layouts.app')

@section('title', 'Add Delivery Center')

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-store me-2"></i>Add Delivery Center</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('centers.store') }}">
        @csrf
        @include('centers.form', ['center' => new App\Models\DeliveryCenter()])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Save Center</button>
        <a href="{{ route('centers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
