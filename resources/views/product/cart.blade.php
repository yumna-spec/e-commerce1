<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>User Dashboard - Cart</title>
  
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
  
  <style>
    /* Gradient custom style from your snippet */
    .gradient-custom {
      /* fallback for old browsers */
      background: #f8f9fa;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">User Panel</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('dashboarduser') }}">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route('product.list') }}">
            <i class="material-symbols-rounded opacity-5">storefront</i>
            <span class="nav-link-text ms-1">Shop Products</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active bg-gradient-dark text-white" href="{{ route('cart.view') }}">
            <i class="material-symbols-rounded opacity-5">shopping_cart</i>
            <span class="nav-link-text ms-1">My Cart</span>
          </a>
        </li>

      </ul>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">User</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Cart</li>
          </ol>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav ms-auto justify-content-end"> 
            <li class="nav-item d-flex align-items-center">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-body font-weight-bold px-0 mb-0">
                        <i class="fa fa-user me-sm-1"></i> <span class="d-sm-inline d-none">Logout</span>
                    </button>
                </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container-fluid py-2">
      
      @php
        $total = 0;
        foreach($products as $product) {
            $total += $product->price * $product->pivot->quantity;
        }
      @endphp

      <section class="h-100 gradient-custom">
        <div class="container py-3">
          <div class="row d-flex justify-content-center my-4">
            
            <div class="col-md-8">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h5 class="mb-0">Cart - {{ $products->count() }} items</h5>
                </div>
                <div class="card-body">
                 <form method="POST" action="{{ route('order.checkout') }}">
    @csrf

    @foreach ($products as $product)
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="d-flex mb-4" style="max-width: 300px">
                <button type="button" class="btn btn-primary px-3 ms-2" style="background-color:#ff6600;color:white"
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                </button>

                <div class="form-outline">
                    <input min="1" name="quantities[{{ $product->id }}]" value="{{ $product->pivot->quantity }}" type="number" class="form-control text-center" />
                    <label class="form-label">Qty</label>
                </div>

                <button type="button" class="btn btn-primary px-3 ms-2" style="background-color:#ff6600;color:white"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <p class="text-start text-md-center"><strong>${{ $product->price }}</strong></p>
        </div>

        <div class="col-lg-5 col-md-6">
            <p><strong>{{ $product->name }}</strong></p>
            <p class="text-sm text-secondary">{{ Str::limit($product->description, 50) }}</p>
            
            <button type="submit" formaction="{{ route('cart.delete') }}" name="delete_id" value="{{ $product->id }}" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i> delete
            </button>
        </div>
    </div>

    @if(!$loop->last)
        <hr class="my-4" />
    @endif
    @endforeach

    <button type="submit" style="background-color:#ff6600;color:white" class="btn btn-primary btn-lg w-100">
        الذهاب إلى الدفع
    </button>
</form>
                  
                  @if($products->isEmpty())
                    <div class="text-center">
                        <p>Your cart is empty.</p>
                        <a href="{{ route('product.list') }}" class="btn btn-outline-primary">Go Shopping</a>
                    </div>
                  @endif

                </div>
              </div>
              
              <div class="card mb-4 mb-lg-0">
                <div class="card-body">
                  <p><strong>We accept</strong></p>
                  <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg" alt="Visa" />
                  <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg" alt="American Express" />
                  <img class="me-2" width="45px" src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg" alt="Mastercard" />
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="card mb-4">
                <div class="card-header py-3">
                  <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      Products
                      <span>${{ $total }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                      Shipping
                      <span>Free</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                      <div>
                        <strong>Total amount</strong>
                        <strong>
                          <p class="mb-0">(including VAT)</p>
                        </strong>
                      </div>
                      <span><strong>${{ $total }}</strong></span>
                    </li>
                  </ul>


                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <footer class="footer py-4">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>document.write(new Date().getFullYear())</script>, User Shop.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = { damping: '0.5' }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>