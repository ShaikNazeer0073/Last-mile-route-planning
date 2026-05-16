@extends('layouts.app')

@section('title', 'Edit ' . $driver->name)

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-pen me-2"></i>Edit Driver</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('drivers.update', $driver) }}">
        @csrf @method('PUT')
        @include('drivers.form', ['driver' => $driver])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Update Driver</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
