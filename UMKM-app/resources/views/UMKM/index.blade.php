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
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UMKM /</span> Profil</h4>
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#exLargeModal"
                >
                    Tambahkan UMKM
                </button>
            </div>
            @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
              <span>{{ session('success') }}</span>
              <button id="dismiss-button" type="button" class="btn-close" aria-label="Close">
                <span aria-hidden="true" class="text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Close"></span>
            </button>
          </div>
            @endif
              @if($umkmData)
              

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>UMKM Detail</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href=" {{$umkmData->jenis === 'Makanan Olahan' ? route('makananOlahan', ['id' => $umkmData->id]) : 
                        ($umkmData->jenis === 'Pertanian' ? route('Pertanian', ['id' => $umkmData->id]) : 
                        route('Peternakan',['id'=>$umkmData->id]))}} "
                        ><i class="bx bx-bell me-1"></i>Data Penjualan</a
                      >
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li> --}}
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details : {{ $umkmData->Nama_umkm }}</h5>

                   
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="checkbox">
                          <label class="form-check-label" for="checkbox">Enable Input For Update</label>
                      </div>
                        
                        
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form  method="POST" action="{{ route('umkm.update',['umkm' => $umkmData]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama Pemilik</label>
                            <input
                              class="form-control"
                              type="text"
                              id="pemilik"
                              name="pemilik"
                              value="{{ $umkmData->pemilik }}"
                              autofocus
                              
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="alamat" class="form-label">Nama UMKM</label>
                            <input class="form-control" type="text" name="Nama_umkm" id="Nama_umkm" value="{{ $umkmData->Nama_umkm }}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="alamat" class="form-label">alamat</label>
                            <input class="form-control" type="text" name="alamat" id="alamat" value="{{ $umkmData->alamat }}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="no2" class="form-label">Phone Number</label>
                            <input
                              class="form-control"
                              type="text"
                              id="no2"
                              name="no2"
                              value="{{ $umkmData->no2 }}"
                              placeholder="john.doe@example.com"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="NIB" class="form-label">Nomor Induk Berusaha</label>
                            <input
                              type="text"
                              class="form-control"
                              id="NIB"
                              name="NIB"
                              value="{{ $umkmData->NIB }}"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="no1">Phone Number</label>
                            <div class="input-group input-group-merge">
                              
                              <input
                                type="text"
                                id="no1"
                                name="no1"
                                class="form-control"
                                placeholder="202 555 0111"
                                value="{{ $umkmData->no1 }}"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="NPWP" class="form-label">NPWP</label>
                            <input type="text" value="{{ $umkmData->NPWP }}" class="form-control" id="NPWP" name="NPWP" placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="waktu_berdiri" class="form-label">Waktu Berdiri</label>
                            <input class="form-control"  value="{{ $umkmData->waktu_berdiri }}" type="text" id="waktu_berdiri" name="waktu_berdiri" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input
                              type="text"
                              class="form-control"
                              id="jenis"
                              name="jenis"
                              placeholder="231465"
                              value="{{ $umkmData->jenis }}"

                            />
                          </div>
                          <hr class="my-2 w-full">
                          <h2>Sertifikasi:</h2>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">No P.IRT</label>
                            <input class="form-control"  value="{{ $umkmData->Pirt }}" type="text" id="Pirt" name="Pirt" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">No BPOM</label>
                            <input class="form-control"  value="{{ $umkmData->bpom }}" type="text" id="bpom" name="bpom" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">No Sertifikat Halal</label>
                            <input class="form-control"  value="{{ $umkmData->halal }}" type="text" id="halal" name="halal" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">No Hak Merek</label>
                            <input class="form-control"  value="{{ $umkmData->merek }}" type="text" id="merek" name="merek" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">No Hak Cipta</label>
                            <input class="form-control"  value="{{ $umkmData->hak_cipta }}" type="text" id="hak_cipta" name="hak_cipta" placeholder="California" />
                          </div>
                          <hr class="my-2 w-full">
                          <h2>Email dan Media Sosial:</h2>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Email</label>
                            <input class="form-control"  value="{{ $umkmData->email }}" type="text" id="email" name="email" placeholder="California" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Website</label>
                            <input class="form-control"  value="{{ $umkmData->website }}" type="text" id="website" name="website" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Facebook</label>
                            <input class="form-control"  value="{{ $umkmData->fb }}" type="text" id="fb" name="fb" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Instagram</label>
                            <input class="form-control"  value="{{ $umkmData->ig }}" type="text" id="ig" name="ig" placeholder="California" />
                          </div>
                          <hr class="my-2 w-full">
                          <h2>Platform E-Commerce:</h2>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Tokopedia</label>
                            <input class="form-control"  value="{{ $umkmData->tokped }}" type="text" id="tokped" name="tokped" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Shopee</label>
                            <input class="form-control"  value="{{ $umkmData->shopee }}" type="text" id="shopee" name="shopee" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Bukalapak</label>
                            <input class="form-control"  value="{{ $umkmData->bukalapak }}" type="text" id="bukalapak" name="bukalapak" placeholder="California" />
                          </div>
                          <hr class="my-2">
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Asset (Diluar Tanah dan Bangunan)</label>
                            <input class="form-control"  value="{{ $umkmData->Asset }}" type="text" id="Asset" name="Asset" placeholder="California" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Omset Perbulan</label>
                            <input class="form-control"  value="{{ $umkmData->omset }}" type="text" id="omset" name="omset" placeholder="California" />
                          </div>
                          <hr class="my-2 w-full">
                          <h2>Tenaga Kerja:</h2>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Laki - Laki</label>
                            <input class="form-control"  value="{{ $umkmData->tenagaL }}" type="text" id="tenagaL" name="tenagaL" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Peremupuan</label>
                            <input class="form-control"  value="{{ $umkmData->tenagaP }}" type="text" id="tenagaP" name="tenagaP" placeholder="California" />
                          </div>
                          <hr class="my-2 w-full">
                          <h2>Wilayah Pemasaran:</h2>
                          <div class="mb-3 col-md-6">
                            <label for="desa" class="form-label">Desa/Kelurahan</label>
                            <input class="form-control"  value="{{ $umkmData->desa }}" type="text" id="desa" name="desa" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Kabupaten/Kota</label>
                            <input class="form-control"  value="{{ $umkmData->kab }}" type="text" id="kab" name="kab" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Provinsi</label>
                            <input class="form-control"  value="{{ $umkmData->prov }}" type="text" id="prov" name="prov" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Nasional</label>
                            <input class="form-control"  value="{{ $umkmData->nas }}" type="text" id="nas" name="nas" placeholder="California" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Export</label>
                            <input class="form-control"  value="{{ $umkmData->exp }}" type="text" id="exp" name="exp" placeholder="California" />
                          </div>
                          <hr class="my-2">
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Kapsitas Produksi Per Hari</label>
                            <input class="form-control"  value="{{ $umkmData->kapasitas }}" type="text" id="kapasitas" name="kapasitas" placeholder="California" />
                          </div>

                          

                          

                          
                          
                        
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  {{-- <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 ">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="accountActivation"
                            id="accountActivation"
                          />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
            @else
            <div class="alert alert-primary">
            <h1>Data Kosong</h1>
            </div>
            @endif

             <!-- Extra Large Modal -->
             <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Tambah UMKM</h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                    
                  <div class="modal-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="checkbox">
                        <label class="form-check-label" for="checkbox">Enable Input </label>
                    </div>
                     </div>
                 
                     <!-- Display Validation Errors -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    <form action="{{ route('umkm.store') }}" method="POST">
                      @csrf
                    <div class="row">
                      <div class="col mb-3">
                          <label for="Nama_umkm" class="form-label">Nama UMKM</label>
                          <input type="text" id="Nama_umkm" name="Nama_umkm" class="form-control" placeholder="Enter Nama UMKM" />
                      </div>
                  </div>
                  <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Enter Nama UMKM" />
                    </div>
                </div>
                  <div class="row g-2">
                      <div class="col mb-0">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" />
                      </div>
                      <div class="col mb-0">
                          <label for="waktu_berdiri" class="form-label">Waktu Berdiri</label>
                          <input type="date" id="waktu_berdiri" name="waktu_berdiri" class="form-control" placeholder="YYYY-MM-DD HH:MM:SS" />
                          <!-- Note: Adjust the format according to your needs -->
                      </div>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-0">
                      <label for="pemilik" class="form-label">Nama Pemilik</label>
                      <input type="text" id="pemilik" name="pemilik" class="form-control" placeholder="YYYY-MM-DD HH:MM:SS" />
                      <!-- Note: Adjust the format according to your needs -->
                  </div>
                    <div class="col mb-3">
                    <label for="jenis" class="form-label">Jenis UMKM</label>
                    <select id="jenis" name="jenis" class="form-select">
                        <option value="Makanan Olahan">Makanan Olahan</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Peternakan">Peternakan</option>
                    </select>
                    </div>
                </div>
                <div class="row g-2">
                  <div class="col mb-0">
                    <label for="NIB" class="form-label">Nomor Induk Berusaha</label>
                    <input type="text" id="NIB" name="NIB" class="form-control" placeholder="YYYY-MM-DD HH:MM:SS" />
                    <!-- Note: Adjust the format according to your needs -->
                </div>
                  <div class="col mb-3">
                  <label for="NPWP" class="form-label">NPWP</label>
                  <input type="text" id="NPWP" name="NPWP" class="form-control" placeholder="NPWP" />
                  </div>
              </div>

                  <div class="row g-2 border-top border-4 mt-3">
                      <div class="col mb-0 text-justify pt-4">
                        <h2>Sertifikasi :</h2>
                      </div>
                      <div class="col mb-0">
                          <label for="Pirt" class="form-label">P.IRT</label>
                          <input type="text" id="Pirt" name="Pirt" class="form-control" placeholder="Enter PIRT" />
                      </div>
                  </div>
                  <div class="row g-2">
                      <div class="col mb-0">
                          <label for="bpom" class="form-label">BPOM</label>
                          <input type="text" id="bpom" name="bpom" class="form-control" placeholder="Enter BPOM" />
                      </div>
                      <div class="col mb-0">
                          <label for="halal" class="form-label">Halal Certification</label>
                          <input type="text" id="halal" name="halal" class="form-control" placeholder="Enter Halal Certification" />
                      </div>
                  </div>
                  <div class="row g-2">
                    <div class="col mb-0">
                        <label for="merek" class="form-label">Hak Merek</label>
                        <input type="text" id="merek" name="merek" class="form-control" placeholder="Enter BPOM" />
                    </div>
                    <div class="col mb-0">
                        <label for="hak_cipta" class="form-label">Hak Cipta</label>
                        <input type="text" id="hak_cipta" name="hak_cipta" class="form-control" placeholder="Enter Halal Certification" />
                    </div>
                </div>
                <div class="row g-2 border-top border-4 mt-4">
                  <div class="col mb-3">
                      <label for="no1" class="form-label">Nomor HP 1</label>
                      <input type="text" id="no1" name="no1" class="form-control" placeholder="Enter Nama UMKM" />
                  </div>
                  <div class="col mb-3">
                    <label for="no2" class="form-label">Nomor HP 2</label>
                    <input type="text" id="no2" name="no2" class="form-control" placeholder="Enter Nama UMKM" />
                </div>
              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0 text-justify pt-4">
                  <h2>Email dan Media Sosial :</h2>
                </div>
                <div class="col mb-0">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email" />
              </div>

              </div>
              <div class="row g-2">
                <div class="col mb-0">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" id="website" name="website" class="form-control" placeholder="Enter BPOM" />
                </div>
                <div class="col mb-0">
                    <label for="fb" class="form-label">Facebook</label>
                    <input type="text" id="fb" name="fb" class="form-control" placeholder="Enter Halal Certification" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                    <label for="ig" class="form-label">Instagram</label>
                    <input type="text" id="ig" name="ig" class="form-control" placeholder="Enter BPOM" />
                </div>
               
              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0 text-justify pt-4">
                  <h2>Platform E-Commerce :</h2>
                </div>
                <div class="col mb-0">
                  <label for="tokped" class="form-label">Tokopedia</label>
                  <input type="text" id="tokped" name="tokped" class="form-control" placeholder="Enter Email" />
              </div>

              </div>
              <div class="row g-2">
                <div class="col mb-0">
                    <label for="bukalapak" class="form-label">Bukalapak</label>
                    <input type="text" id="bukalapak" name="bukalapak" class="form-control" placeholder="Enter BPOM" />
                </div>
                <div class="col mb-0">
                  <label for="shopee" class="form-label">Shopee</label>
                  <input type="text" id="shopee" name="shopee" class="form-control" placeholder="Enter BPOM" />
              </div>
               
              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0">
                    <label for="Asset" class="form-label">Aset (Diluar Tanah dan Bangunan)</label>
                    <input type="text" id="Asset" name="Asset" class="form-control" placeholder="Enter BPOM" />
                </div>
               
              </div>
              <div class="row g-2 ">
                <div class="col mb-0">
                    <label for="omset" class="form-label">Omset Perbulan</label>
                    <input type="text" id="omset" name="omset" class="form-control" placeholder="Enter BPOM" />
                </div>
               
              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0 text-justify pt-4">
                  <h2>Jumlah Tenaga Kerja :</h2>
                </div>
                <div class="col mb-0">
                  <label for="tenagaL" class="form-label">Laki - Laki</label>
                  <input type="text" id="tenagaL" name="tenagaL" class="form-control" placeholder="Enter Email" />
              </div>
              <div class="row g-2 ">
                <div class="col mb-0">
                    <label for="tenagaP" class="form-label">Perempuan</label>
                    <input type="text" id="tenagaP" name="tenagaP" class="form-control" placeholder="Enter BPOM" />
                </div>
               
              </div>

              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0 text-justify pt-4">
                  <h2>Wilayah Pemasaran :</h2>
                </div>
                <div class="col mb-0">
                  <label for="desa" class="form-label">Desa/Kelurahan</label>
                  <input type="text" id="desa" name="desa" class="form-control" placeholder="Enter Email" />
              </div>

              </div>
              <div class="row g-2">
                <div class="col mb-0">
                    <label for="kab" class="form-label">Kabupaten/Kota</label>
                    <input type="text" id="kab" name="kab" class="form-control" placeholder="Enter BPOM" />
                </div>
                <div class="col mb-0">
                  <label for="prov" class="form-label">Provinsi</label>
                  <input type="text" id="prov" name="prov" class="form-control" placeholder="Enter BPOM" />
              </div>
               
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                    <label for="nas" class="form-label">Nasional</label>
                    <input type="text" id="nas" name="nas" class="form-control" placeholder="Enter BPOM" />
                </div>
                <div class="col mb-0">
                  <label for="exp" class="form-label">Export</label>
                  <input type="text" id="exp" name="exp" class="form-control" placeholder="Enter BPOM" />
              </div>
               
              </div>
              <div class="row g-2 border-top border-4 mt-3">
                <div class="col mb-0">
                    <label for="kapasitas" class="form-label">Kapasitas Produksi Per Hari</label>
                    <input type="text" id="kapasitas" name="kapasitas" class="form-control" placeholder="Enter BPOM" />
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
           
            <!-- /Extra Large Modal -->
           


 
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
      @if ($errors->any())
          $(document).ready(function() {
              $('#exLargeModal').modal('show');
          });
      @endif

       $(document).ready(function() {
            // Initial state
            $('#pemilik').prop('readonly', !$('#checkbox').prop('checked'));
            $('#NIB').prop('readonly', !$('#checkbox').prop('checked'));
            $('#no1').prop('readonly', !$('#checkbox').prop('checked'));
            $('#NPWP').prop('readonly', !$('#checkbox').prop('checked'));
            $('#alamat').prop('readonly', !$('#checkbox').prop('checked'));
            $('#waktu_berdiri').prop('readonly', !$('#checkbox').prop('checked'));
            $('#jenis').prop('readonly', !$('#checkbox').prop('checked'));
            $('#Pirt').prop('readonly', !$('#checkbox').prop('checked'));
            $('#bpom').prop('readonly', !$('#checkbox').prop('checked'));
            $('#halal').prop('readonly', !$('#checkbox').prop('checked'));
            $('#merek').prop('readonly', !$('#checkbox').prop('checked'));
            $('#hak_cipta').prop('readonly', !$('#checkbox').prop('checked'));
            $('#email').prop('readonly', !$('#checkbox').prop('checked'));
            $('#website').prop('readonly', !$('#checkbox').prop('checked'));
            $('#fb').prop('readonly', !$('#checkbox').prop('checked'));
            $('#ig').prop('readonly', !$('#checkbox').prop('checked'));
            $('#tokped').prop('readonly', !$('#checkbox').prop('checked'));
            $('#shopee').prop('readonly', !$('#checkbox').prop('checked'));
            $('#bukalapak').prop('readonly', !$('#checkbox').prop('checked'));
            $('#Asset').prop('readonly', !$('#checkbox').prop('checked'));
            $('#omset').prop('readonly', !$('#checkbox').prop('checked'));
            $('#tenagaL').prop('readonly', !$('#checkbox').prop('checked'));
            $('#tenagaP').prop('readonly', !$('#checkbox').prop('checked'));
            $('#desa').prop('readonly', !$('#checkbox').prop('checked'));
            $('#kab').prop('readonly', !$('#checkbox').prop('checked'));
            $('#prov').prop('readonly', !$('#checkbox').prop('checked'));
            $('#nas').prop('readonly', !$('#checkbox').prop('checked'));
            $('#exp').prop('readonly', !$('#checkbox').prop('checked'));
            $('#kapasitas').prop('readonly', !$('#checkbox').prop('checked'));
            $('#no2').prop('readonly', !$('#checkbox').prop('checked'));
            $('#Nama_umkm').prop('readonly', !$('#checkbox').prop('checked'));


            // Toggle input readonly attribute on checkbox change
            $('#checkbox').change(function() {
                $('#pemilik').prop('readonly', !$(this).prop('checked'));
                $('#NIB').prop('readonly', !$(this).prop('checked'));
                $('#no1').prop('readonly', !$(this).prop('checked'));
                $('#NPWP').prop('readonly', !$(this).prop('checked'));
                $('#alamat').prop('readonly', !$(this).prop('checked'));
                $('#waktu_berdiri').prop('readonly', !$(this).prop('checked'));
                $('#jenis').prop('readonly', !$(this).prop('checked'));
                $('#Pirt').prop('readonly', !$(this).prop('checked'));
                $('#bpom').prop('readonly', !$(this).prop('checked'));
                $('#halal').prop('readonly', !$(this).prop('checked'));
                $('#merek').prop('readonly', !$(this).prop('checked'));
                $('#hak_cipta').prop('readonly', !$(this).prop('checked'));
                $('#email').prop('readonly', !$(this).prop('checked'));
                $('#website').prop('readonly', !$(this).prop('checked'));
                $('#fb').prop('readonly', !$(this).prop('checked'));
                $('#ig').prop('readonly', !$(this).prop('checked'));
                $('#tokped').prop('readonly', !$(this).prop('checked'));
                $('#shopee').prop('readonly', !$(this).prop('checked'));
                $('#bukalapak').prop('readonly', !$(this).prop('checked'));
                $('#Asset').prop('readonly', !$(this).prop('checked'));
                $('#omset').prop('readonly', !$(this).prop('checked'));
                $('#tenagaL').prop('readonly', !$(this).prop('checked'));
                $('#tenagaP').prop('readonly', !$(this).prop('checked'));
                $('#desa').prop('readonly', !$(this).prop('checked'));
                $('#kab').prop('readonly', !$(this).prop('checked'));
                $('#prov').prop('readonly', !$(this).prop('checked'));
                $('#nas').prop('readonly', !$(this).prop('checked'));
                $('#exp').prop('readonly', !$(this).prop('checked'));
                $('#kapasitas').prop('readonly', !$(this).prop('checked'));
                $('#no2').prop('readonly', !$(this).prop('checked'));
                $('#Nama_umkm').prop('readonly', !$(this).prop('checked'));
            });
        });
        $('#dismiss-button').click(function() {
            // Manually close the alert
            $('#success-alert').alert('close');
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
