@extends('layouts.app')

@section('title', 'Add Driver')

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-motorcycle me-2"></i>Add Driver</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('drivers.store') }}">
        @csrf
        @include('drivers.form', ['driver' => new App\Models\Driver()])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Save Driver</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
