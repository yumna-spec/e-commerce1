

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
            
            

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">order id</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">date</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($status as $st)
                    
                    <tr>
                         <td>
                        <p class="text-sm font-weight-bold mb-0 text-success">{{ $st->order_id }}</p>
                      </td>
                      <td>
                        <div class="d-flex px-2">
                         
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{ $st->name }}</h6>
                          </div>
                      
                        </div>
                      </td>
                  
                  <td>    <div class ="my-auto">
     <td>{{ $st->created_at->format('Y-m-d H:i:s') }}</td>
</div>
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
  














