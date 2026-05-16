@extends('layouts.app')

@section('title', 'Edit ' . $center->name)

@section('content')
<h1 class="page-title mb-4"><i class="fa-solid fa-pen me-2"></i>Edit Center</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('centers.update', $center) }}">
        @csrf @method('PUT')
        @include('centers.form', ['center' => $center])
        <button class="btn btn-primary"><i class="fa-solid fa-check me-1"></i>Update Center</button>
        <a href="{{ route('centers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
