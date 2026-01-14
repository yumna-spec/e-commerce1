<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>Browse Products</title>
  
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
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
            <a class="nav-link active bg-gradient-dark text-white" href="{{ route('product.list') }}">
            <i class="material-symbols-rounded opacity-5">storefront</i>
            <span class="nav-link-text ms-1">Shop Products</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Shop</li>
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
      
      @if(session('success'))
      <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon align-middle">
            <span class="material-symbols-rounded text-md">check_circle</span>
          </span>
          <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Shop Products List</h6>
                
                <a href="{{ route('cart.view') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                    <i class="material-symbols-rounded text-sm me-1">shopping_cart</i> View Cart
                </a>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Add to List</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($products as $product)
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="{{ asset('assets/img/small-logos/icon-bulb.svg') }}" class="avatar avatar-sm rounded-circle me-2" alt="product">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                          </div>
                        </div>
                      </td>
                      
                      <td>
                        <p class="text-sm font-weight-bold mb-0 text-success">${{ $product->price }}</p>
                      </td>
                      
                      <td>
                        <span class="text-xs font-weight-bold text-secondary text-truncate" style="max-width: 150px; display: inline-block;">
                           {{ Str::limit($product->description, 50) }}
                        </span>
                      </td>
                      
                      <td class="align-middle text-center">
                        
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <div class="input-group input-group-outline input-group-sm" style="width: 70px;">
                                    <input type="number" name="quantity" value="{{$product->quantity}}" min="1" class="form-control text-center px-1">
                                </div>
                                <button type="submit" class="btn btn-sm bg-gradient-dark mb-0 d-flex align-items-center">
                                    <i class="material-symbols-rounded text-sm me-1">add_shopping_cart</i> Add
                                </button>
                            </div>
                        </form>

                      </td>
                    </tr>
                    @endforeach

                    @if($products->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            <p class="text-secondary mb-0">No products available to buy.</p>
                        </td>
                    </tr>
                    @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

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