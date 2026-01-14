<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Material Dashboard 2</title>
  </head>

<body class="g-sidenav-show bg-gray-200">
  
  @include('partials.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    @include('partials.navbar')

    <div class="container-fluid py-4">
      
      @yield('content')

      <footer class="footer pt-5">
         </footer>
    </div>
  </main>
  
  <div class="fixed-plugin">
     </div>

  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  </body>
</html>