<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FlashIn - Last-Mile Delivery')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                <i class="fa-solid fa-bolt me-2"></i>FlashIn Delivery
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge me-1"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('centers.*')) active @endif" href="{{ route('centers.index') }}"><i class="fa-solid fa-store me-1"></i>Centers</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('drivers.*')) active @endif" href="{{ route('drivers.index') }}"><i class="fa-solid fa-motorcycle me-1"></i>Drivers</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('orders.*')) active @endif" href="{{ route('orders.index') }}"><i class="fa-solid fa-box me-1"></i>Orders</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('routes.*')) active @endif" href="{{ route('routes.index') }}"><i class="fa-solid fa-route me-1"></i>Routes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container content-shell py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="py-3 mt-auto">
        <div class="container text-center">
            <p>FlashIn - Last-Mile Delivery Route Planning System &copy; {{ date('Y') }}</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
