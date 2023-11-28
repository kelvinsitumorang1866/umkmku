<x-sidebar/>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <x-navbar :url="1" :id="1"/>

          
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl  container-p-y">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h1>UMKM</h1>
                            </div>
                            <div class="card-body flex items-center justify-center" >
                                <div class="chart-container">
                                    <canvas id="donutChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h1>Varian Produk Yang di Jual</h1>
                            </div>
                            <div class="card-body flex items-center justify-center" >
                                <div class="chart-container">
                                    <canvas id="donutChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <div class="card">
                    <h5 class="card-header">Data UMKM</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama Umkm</th>
                            <th>Nama Pemilik</th>
                            <th>Jenis</th>
                            <th>Satus</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($umkms as $umkm)
                          <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $umkm->Nama_umkm }}</strong></td>
                            <td>{{ $umkm->pemilik }}</td>
                            <td>{{ $umkm->jenis }}</td>
                            <td>{{ $umkm->status }}</td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="{{ route('umkm.show',['umkm' => $umkm->id]) }}" >
                                    <i class="bx bx-edit-alt me-1"></i> Detail
                                  </a>
                                  
                                  </div>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>



            </div>


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
        let makanan = @json($maknan);
        let pertanian = @json($Pertanian);
        let peternakan = @json($Peternakan);

         var ctx = document.getElementById(`donutChart`).getContext('2d');
          var myDonutChart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Makanan Olahan','Pertanian','Peternakan'],
                  datasets: [{
                      data: [makanan,pertanian,peternakan],
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.7)',
                          'rgba(54, 162, 235, 0.7)',
                          'rgba(255, 206, 86, 0.7)',
                          // Add more colors as needed
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          // Add more colors as needed
                      ],
                      borderWidth: 1,
                  }],
              },
          });

          let pmakan = @json($produkMakan);
          let ptani = @json($produkPertanian);
          let phewan = @json($hewan);
          var ctx = document.getElementById(`donutChart2`).getContext('2d');
          var myDonutChart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ['Makanan Olahan','Pertanian','Peternakan'],
                  datasets: [{
                      data: [pmakan,ptani,phewan],
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.7)',
                          'rgba(54, 162, 235, 0.7)',
                          'rgba(255, 206, 86, 0.7)',
                          // Add more colors as needed
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          // Add more colors as needed
                      ],
                      borderWidth: 1,
                  }],
              },
          });
          
          
        

    </script>

     <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>



                
