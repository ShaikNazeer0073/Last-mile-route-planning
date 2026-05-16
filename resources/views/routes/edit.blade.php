@extends('layouts.app')

@section('title', 'Edit Route')

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-pen me-2"></i>Edit Route</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('routes.update', $route) }}">
        @csrf @method('PUT')
        @include('routes.form', ['route' => $route])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Update Route</button>
        <a href="{{ route('routes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
