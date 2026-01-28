
<x-layouts>











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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Qt</th>
                    </tr>
                  </thead>
                  <tbody>
                    @isset($orders)
                    @foreach($orders as $order)
                    
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $order->id }}</h6>
                          </div>

                      
                        </div>
                      </td>
                     
                      
                      <td>
                        <span class="text-xs font-weight-bold text-secondary text-truncate" style="max-width: 150px; display: inline-block;">
                        </span>
                      </td>
                      
                     <td>
                        <span class="text-xs font-weight-bold text-secondary text-truncate" style="max-width: 150px; display: inline-block;">
                        </span>
                      </td>

                    </tr>
                    @endforeach
@endisset
                    @if($orders->isEmpty())
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

  



</form>
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
  
  </x-layouts>