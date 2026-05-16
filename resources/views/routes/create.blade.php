@extends('layouts.app')

@section('title', 'Create Route')

@section('content')
<h1 class="page-title mb-4">Create Route</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('routes.store') }}">
        @csrf
        @include('routes.form', ['route' => new App\Models\Route()])
        <button class="btn btn-primary">Save Route</button>
        <a href="{{ route('routes.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div></div>
@endsection
