<x-sidebar/>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <x-navbar :url="$url" :id="$id"/>

          
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UMKM /</span> Manage</h4>
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#largeModal"
                    >
                        Tambahkan Produk
                    </button>
                </div>
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                  
    
                  <div class="row">
                    <div class="col-md-12">
                      <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                          <a class="nav-link " href="{{ auth()->user()->Role === "Admin" ? route('umkm.show', ['umkm' => $id]) : route('umkm.index') }}"><i class="bx bx-user me-1"></i>UMKM Detail</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href=""
                            ><i class="bx bx-bell me-1"></i>Data Penjualan</a
                          >
                        </li>
                        
                      </ul>

              <!-- Basic Bootstrap Table produk -->
              <div class="card">
                <h5 class="card-header">All Product</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kode</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @if(!empty($produks))

                    @foreach($produks as $produk)

                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $produk->Nama_produk }}</strong></td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->kode_barang }}</td>
                       
                        
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);" onclick="editProduk('{{ $produk->Nama_produk }}', '{{ $produk->harga }}', '{{ $produk->kode_barang }}',{{ $produk->id }})">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                              </a>
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="bx bx-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                    @endif
                     
                     
                    
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table produk -->
              <hr class="my-5" />
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                <small class="text-light fw-semibold">Riwayat</small>
                <div class="mt-3">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    <form action="{{ route('makananOlahan',['id' => $id]) }}">
                      <input class="" type="hidden" name="week" value=1 placeholder="Search by name" > 
                    <button type="submit" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('makananOlahan', [ 'id' => $id, 'week' => 1]) ? 'active' : '' }}" >Week 1</button>
                    </form>
                    <form action="{{ route('makananOlahan',['id' => $id]) }}">
                      <input class="" type="hidden" name="week" value=2 placeholder="Search by name" > 
                    <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('makananOlahan', [ 'id' => $id, 'week' => 2]) ? 'active' : '' }}">Week 2</button>
                    </form>
                    <form action="{{ route('makananOlahan',['id' => $id]) }}">
                      <input class="" type="hidden" name="week" value=3 placeholder="Search by name" > 
                    <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('makananOlahan', [ 'id' => $id, 'week' => 3]) ? 'active' : '' }}" >week 3</button>
                    </form>
                    <form action="{{ route('makananOlahan',['id' => $id]) }}">
                    <input class="" type="hidden" name="week" value=4 placeholder="Search by name" >
                    <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('makananOlahan', [ 'id' => $id, 'week' => 4]) ? 'active' : '' }}" >Week 4</button>
                    </form>
                    <a href="{{ route('makananOlahan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('makananOlahan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                  </div>
                </div>
            </div>
            <button
            type="button"
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#penjualan"
        >
            Tambahkan Penjualan
        </button>
              </div>
               <!-- sale -->
               <div class="card">
                <h5 class="card-header">Riwayat Penjualan</h5>
                <div class="table-responsive text-nowrap" id="salesContainer" >
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th>Jumlah Unit Terjual</th>
                        <th>Total </th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($sales as $sale)
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $sale->produk->Nama_produk }}</strong></td>
                          <td>{{ $sale->jumlah }}</td>
                          <td>{{ $sale->ammount }}</td>
                          <td>{{ $sale->created_at }}</td>
                      
                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <hr>
                <div class=" mx-4 mt-3">
                  {{ $sales->links() }}
              </div>
              </div>
              @foreach($uniqueYearsCount as $year => $data)
              <hr class="my-5">
              <div class="card border-primary">
                <div class="card-header ">
                    <h5 class="mb-0">Riwaya Penjualan</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="myChart{{ $year  }}" class="w-100"></canvas>
                    </div>
                </div>
            </div>
            @endforeach
            
              
                <!-- /sale -->
                <!-- Large Modal -->
                <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel3">Tambahkan Produk</h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col mb-3">
                              <form action="{{ route('makananOlahan.addProduct', ['id' => $id]) }}" method="POST">
                                @csrf
                              <label for="Nama_produk" class="form-label">Nama Barang</label>
                              <input type="text" id="Nama_produk" name="Nama_produk" class="form-control" placeholder="Enter Name" />
                            </div>
                          </div>
                          <div class="row g-2">
                            <div class="col mb-0">
                              <label for="harga" class="form-label">Harga</label>
                              <input type="text" id="harga" name="harga" class="form-control" placeholder="xxxx@xxx.xx" />
                            </div>
                            <div class="col mb-0">
                              <label for="kode_barang" class="form-label">Kode barang</label>
                              <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="DD / MM / YY" />
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                    <!-- / Large Modal -->
                    <!-- Large edit Modal -->
                <div class="modal fade" id="editProdukModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Edit Produk</h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-3">
                            @if(!empty($produks))
                            <form action="{{ route('makananOlahan.editProduct', ['id' => $id, 'produk' =>$produk ]) }}" method="POST" id="form">
                              @csrf
                              @method('PUT')
                              <input type="hidden" id="produk" name="produk">

                            <label for="Nama_produk" class="form-label">Nama Barang</label>
                            <input type="text" id="Nama_produk1" name="Nama_produk" class="form-control" placeholder="Enter Name" />
                          </div>
                        </div>
                        <div class="row g-2">
                          <div class="col mb-0">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" id="harga1" name="harga" class="form-control" placeholder="xxxx@xxx.xx" />
                          </div>
                          <div class="col mb-0">
                            <label for="kode_barang" class="form-label">Kode barang</label>
                            <input type="text" id="kode_barang1" name="kode_barang" class="form-control" placeholder="DD / MM / YY" />
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                          Close
                        </button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                      </div>
                    </form>
                    @endif
                    </div>
                  </div>
                </div>
                  <!-- / Large edit Modal -->
                    <!--  penjualan Modal -->
                    <div class="modal fade" id="penjualan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel3">Tambah Penjualan</h5>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3">
                                  <form action="{{ route('makananOlahan.addSale',['id' => $id]) }}" method="POST">
                                    @csrf
                                  <label class="form-label" for="Produk_id">Produk</label>
                                    <select class="form-select" name="Produk_id" id="Produk_id">
                                        @foreach ($produks as $option)
                                            <option value="{{ $option->id }}">{{ $option->Nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                              <div class="row g-2">
                                <div class="col mb-0">
                                  <label for="jumlah" class="form-label">Jumlah</label>
                                  <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="xxxx@xxx.xx" />
                                </div>
                                <div class="col mb-0">
                                  <label for="ammount" class="form-label">Total</label>
                                  <input type="text" id="ammount" name="ammount" class="form-control" placeholder="DD / MM / YY" />
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                       <!--  /penjualan Modal -->

          
            <!-- / Content -->

            <!-- Footer -->
            {{-- <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer> --}}
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script>
      // this for retrive the data from controller and push the variation of year into totalY array
      let theDatas = @json($salesForChart);
      let totalY = [];
      theDatas.forEach(element => {
        if(totalY[totalY.length - 1] !== element.year)
        {totalY.push(element.year) 
        } else{

        }
      
      }); 
      
      // the function to define the chart with loop on the totalYy index
      document.addEventListener('DOMContentLoaded', function () {
         totalY.forEach(el => {
          var ctx = document.getElementById(`myChart${el}`).getContext('2d');
          let theMonth = [];
          let theTotal = [];
          // to get the month and the total for specified year
          theDatas.forEach(e => {
            if(e.year === el){
              theMonth.push(e.month)
              theTotal.push(e.total)
            }else{}
          })
          // function to translate to human version of month 
          let monthNames = theMonth.map(monthNumber => {
          let monthDate = new Date(2000, monthNumber - 1, 1); // Using 2000 as a reference year
          return monthDate.toLocaleString('en-US', { month: 'long' });
          });
          
         
            //the chart config
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: monthNames,
                    datasets: [{
                        label: 'Penjualan Total Rupiah',
                        data: theTotal,
                        backgroundColor:"rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        borderWidth: 12
                    },
                    
                  
                  ]
                },
                options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: `Penjualan Tahun ${el}`
                      }
                    }
                  }
            });

         })
            
        });
        function editProduk(productName, harga, kode, id) {
          // Set values in the modal fields
          console.log(id);
          document.getElementById('Nama_produk1').value = productName;
          document.getElementById('harga1').value = harga;
          document.getElementById('kode_barang1').value = kode;
          document.getElementById('produk').value = id;
          // Open the modal
          $('#editProdukModal').modal('show');
        }

    </script>
    

   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
