

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>Admin Dashboard - Products</title>
  
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Admin Panel</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
     <ul class="navbar-nav">
  
  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('admin.dashboard') }}">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Dashboard</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('category.index') }}">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Category</span>
    </a>
  </li>


<li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="{{ route('admin.product') }}">
            <i class="material-symbols-rounded opacity-5"></i>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>

<li class="nav-item">
    <a class="nav-link text-dark" href="{{ route('order.history') }}">
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Order History</span>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Products</li>
          </ol>
        </nav>
      </div>
    </nav>
    <div class="container-fluid py-2">
      
      @if(session('success'))
      <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon align-middle">
            <span class="material-symbols-rounded text-md">thumb_up</span>
          </span>
          <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endif
<div class="container mt-4">
    <div class="row align-items-end"> 
        
       






        <div class="col-md-5">
           <form action="{{ route('product.searchbar') }}" method="GET" class="d-flex align-items-center gap-3" id="searchForm">
            <div class="input-group bg-white border-radius-lg p-1 shadow-sm border">
                    <input type="text" class="form-control border-0" placeholder="Search products..." 
                           name="search" value="{{ request('search') }}">
                </div>

<div class="input-group bg-white border-radius-lg p-1 shadow-sm border">
        <label for="category_name" class="form-label mb-0"><b></b></label>


        <select name="category_name" id="category_name" class="form-select" >

            <option value="">All Categories</option>
          
            @foreach($categories as $category)
          
            <option value="{{ $category->name }}"  >
          
            {{ $category->name }}
          
          </option>
          
          @endforeach
        
        </select>
        
      </div>


    <div class="w-100">
        <label for="price" class="form-label mb-0">Price: <b>{{ request('price', 100) }}</b></label>
        <input type="range" class="form-range" id="price" name="price" min="0" max="100" 
               value="{{ request('price', 100) }}"
                > 





    <button type="submit" class="btn btn-dark btn-sm m-1">Search</button>
</form>
        </div>

    </div>
</div>


















      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">Products List</h6>
                
                <a href="{{ route('admin.product.add') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                  <i class="material-symbols-rounded text-sm me-1">add</i> Add Product
                </a>

                <!-- <a href="{{ route('admin.product.add') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                  <i class="material-symbols-rounded text-sm me-1">add</i> Add Product
                </a> -->
             <a href="{{ route('admin.product.trend') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                   Product trend
                </a>
 <a href="{{ route('product.latest') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                   latest Products
                </a>

                <a href="{{ route('product.topselling') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                   Top Selling Products
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
                     
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">category name</th>
                       <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Actions</th>

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

                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold">{{ $product->category_name }}</span>
                      
                      <td class="align-middle text-center">
                        
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-link text-dark px-2 mb-0" data-bs-toggle="tooltip" title="Edit">
                          <i class="material-symbols-rounded text-sm me-1">edit</i> Edit
                        </a>

                        <form method="POST" action="{{ route('admin.product.delete', $product->id) }}" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn-link text-danger text-gradient px-2 mb-0" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="material-symbols-rounded text-sm me-1">delete</i> Delete
                            </button>
                        </form>

                        

                      </td>
                    </tr>
                    @endforeach
                    
                   
                    

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>document.write(new Date().getFullYear())</script>, Admin Panel.
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