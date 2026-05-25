@extends('layouts.app')

@section('title', 'Register - FlashIn')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h3 class="text-center fw-bold mb-4"><i class="fa-solid fa-bolt text-primary me-2"></i>FlashIn</h3>
                <h5 class="text-center text-muted mb-4">Create your account</h5>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Create Account</button>
                </form>

                <div class="mt-4 text-center">
                    <p class="text-muted mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
