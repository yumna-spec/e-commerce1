
<x-layouts>



<div class="container-fluid py-2">
      <div>
        <form action="{{ route('filterprice') }}" method="get">
          <div class="row">
          <div class ="col-md-3 ms-left">
            
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="form-control-sm" style="border-radius: 8px;">
          </div>
         
          <div class="col-md-3 ms-left">
          
          <input type="range" name="price" value="{{ request('price') }}" min="0" max="100" class="form-range" style="width: 150px;">
        
        </div>



          <div class="col-md-2 ms-left">
            <button type="submit" class="btn btn-sm bg-gradient-dark mb-0">{{__('product.Search')}}</button>
          </div>
          </div>
        </form>




      </div>
     @session('success')
      <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
          <span class="alert-icon align-middle">
            <span class="material-symbols-rounded text-md">thumb_up</span>
          </span>
          <span class="alert-text"><strong>Success!</strong> {{ session('success') }}</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      @endsession

      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                <h6 class="text-white text-capitalize ps-3">   {{__('product.Shop Products List')}}</h6>
                
                <a href="{{ route('cart.view') }}" class="btn btn-sm btn-white me-3 text-dark mb-0 d-flex align-items-center">
                    <i class="material-symbols-rounded text-sm me-1">shopping_cart</i> {{__('product.View Cart')}}
                </a>
              </div>
            </div>

           
          </div>
        </div>
      </div>

      
    </div> 
  
   @foreach($products as $product)

    <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-10">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body" >
            <div class="row" >
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface" style="width: 18rem;">
                  <!-- <img src="{{ asset( 'storage/'.$product->image)}}" -->
                    class="w-100" />
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
              <div>
                <img src="{{ asset( 'storage/'.$product->image)}}"  class="card-img-top" style="width: 18rem;">
              </div>
              <div class="col-md-6 col-lg-6 col-xl-6">
                <h5>{{$product->name}}</h5>
                <div class="d-flex flex-row">
                  <div class="text-danger mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                  <span>310</span>
                </div>
                <div class="mt-1 mb-0 text-muted small">
                  <span>100% cotton</span>
                  <span class="text-primary"> • </span>
                  <span>Light weight</span>
                  <span class="text-primary"> • </span>
                  <span>Best finish<br /></span>
                </div>
                <div class="mb-2 text-muted small">
                  <span>Unique design</span>
                  <span class="text-primary"> • </span>
                  <span>For men</span>
                  <span class="text-primary"> • </span>
                  <span>Casual<br /></span>
                </div>
                <p class="text-truncate mb-4 mb-md-0">
                  There are many variations of passages of Lorem Ipsum available, but the
                  majority have suffered alteration in some form, by injected humour, or
                  randomised words which don't look even slightly believable.
                </p>
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1">{{$product->price}}</h4>
                  <span class="text-danger"><s>$50.99</s></span>
                </div>
                <h6 class="text-success">Free shipping</h6>
                <div class="d-flex flex-column mt-4">
                    <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <div class="input-group input-group-outline input-group-sm" style="width: 70px;">
                                    <input type="number" name="quantity" value="{{$product->quantity}}" min="1" class="form-control text-center px-1">
                                </div>
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm" type="submit">Add</button>

                            </div>
                        </form>
                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm" type="button">Details</button>
                  <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        @endforeach

    </div>
   @if($products->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            <p class="text-secondary mb-0">No products available to buy.</p>
                        </td>
                    </tr>
                    @endif
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
  </x-layouts>





  