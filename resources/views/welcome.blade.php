<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to HappyBurger Resturant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">MyShop</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">

                @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">Admin Logout</button>
                        </form>
                    </li>
                @endauth

              
                @auth('web')
                    
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @endauth

             
                @if(!Auth::guard('web')->check() && !Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login.form') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register.form') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.login') }}">Admin Login</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4">Welcome to HappyBurger Resturant</h1>
            <p class="lead">
                Best products, best prices, fast delivery.
            </p>

            @auth('admin')
                <div class="alert alert-warning">
                    <strong>Welcome Admin!</strong> You are logged in.
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-lg">
                    Go to Dashboard
                </a>
            @endauth

            @auth('web')
                <div class="alert alert-success">
                    <strong>Welcome back!</strong> Ready to shop?
                </div>
                <a href="{{ route('product.list') }}" class="btn btn-success btn-lg">
                    Start Shopping
                </a>
            @endauth

            @if(!Auth::guard('web')->check() && !Auth::guard('admin')->check())
                <p class="text-muted">Join us today and get the best deals!</p>
                <a href="{{ route('register.form') }}" class="btn btn-primary btn-lg">
                    Get Started
                </a>
                <a href="{{ route('login.form') }}" class="btn btn-outline-secondary btn-lg">
                    Login
                </a>
            @endif

        </div>

        <div class="col-md-6">
            <img src="{{ asset('images/resturant.jpg') }}"
                 class="img-fluid rounded shadow"
                 alt="Shop Image">
        </div>
    </div>
</div>

</body>
</html>