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
                @if(session('success'))
                    <div id="success-alert" class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                        <span>{{ session('success') }}</span>
                        <button id="dismiss-button" type="button" class="btn-close" aria-label="Close">
                            <span aria-hidden="true" class="text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Close"></span>
                        </button>
                    </div>
                @endif
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
                        <li class="nav-item">
                          <div class="btn-group ms-3" id="dropdown-icon-demo">
                            <button
                              type="button"
                              class="btn btn-secondary dropdown-toggle"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                              <i class="bx bx-menu"></i> ShortCut
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="scrollToTargetSection('suksespanen')">
                                  <i class="bx bx-chevron-right scaleX-n1-rtl"></i> Sukses Panen
                              </a>
                              </li>
                              <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="scrollToTargetSection('gagalpanentelur')"
                                  ><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Data Gagal Panen Telur</a
                                >
                              </li>
                              <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="scrollToTargetSection('suksespanentelur')"
                                  ><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Data Sukses Panen Telur</a
                                >
                              </li>
                              <li>
                                <hr class="dropdown-divider" />
                              </li>
                              <li>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" onclick="scrollToTargetSection('targetSection')"
                                  ><i class="bx bx-chevron-right scaleX-n1-rtl"></i>Data Penjualan</a
                                >
                              </li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                </div>
                {{-- table produk --}}
                <div class="card">
                    <h5 class="card-header">Produk Peternakan</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jenis</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($produks as $produk)
                          <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $produk->nama }}</strong></td>
                            <td>{{ $produk->harga }}</td>
                            <td>{{ $produk->group }}</td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="javascript:void(0);" onclick="editProduk('{{ $produk->nama }}', '{{ $produk->harga }}', '{{ $produk->group }}',{{ $produk->id }})">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                  </a>
                                  <form action="{{ route('Peternakan.deleteProduct',['produk'=>$produk->id] ) }}" method="POST" id="deleteForm" >
                                    @csrf
                                    
                                    @method('DELETE')
                                  <button class="dropdown-item" type="button" onclick="confirmDelete('{{ $produk->id }}')"
                                    ><i class="bx bx-trash me-1"></i> Delete</button
                                    >
                                  </form>
                                  </div>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{-- /table produk --}}
                <hr class="my-5" />
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <small class="text-light fw-semibold">Riwayat</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('Peternakan',['id' => $id]) }}">
                                        <input class="" type="hidden" name="week" value=1 placeholder="Search by name" > 
                                        <button type="submit" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'week' => 1]) ? 'active' : '' }}" >Week 1</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}">
                                        <input class="" type="hidden" name="week" value=2 placeholder="Search by name" > 
                                        <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'week' => 2]) ? 'active' : '' }}">Week 2</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}">
                                        <input class="" type="hidden" name="week" value=3 placeholder="Search by name" > 
                                        <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'week' => 3]) ? 'active' : '' }}" >week 3</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}">
                                        <input class="" type="hidden" name="week" value=4 placeholder="Search by name" >
                                        <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'week' => 4]) ? 'active' : '' }}" >Week 4</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}">
                                      <input class="" type="hidden" name="week" value=5 placeholder="Search by name" >
                                      <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'week' => 5]) ? 'active' : '' }}" >Remaining days</button>
                                  </form>
                                    <a href="{{ route('Peternakan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                                 </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#gagal"
                        >Tambahkan Data Gagal Panen
                        </button>
                    </div>
                 {{-- table Gagal --}}
                 <div class="card">
                    <h5 class="card-header">Data Gagal Panen</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Gagal dalam : KG</th>
                            <th>keterangan</th>
                            <th>Tanggal</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
    
                        @foreach($gagals as $gagal)
    
                          <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $gagal->produk->nama }}</strong></td>
                            <td>{{ $gagal->jumlah_gagal }}</td>
                            <td>{{ $gagal->keterangan }}</td>
                            <td>{{ $gagal->created_at }}</td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                 
                                  <form action="{{ route('Peternakan.deleteGagal',['gagal'=>$gagal->id] ) }}" method="POST" id="deleteForm1" >
                                    @csrf
                                    
                                    @method('DELETE')
                                  <button class="dropdown-item" type="button" onclick="confirmDelete1('{{ $gagal->id }}')"
                                    ><i class="bx bx-trash me-1"></i> Delete</button
                                    >
                                  </form>
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
                      {{ $gagals->appends(['productName' => request('productName')])->links() }}
                    </div>
                 </div>
                 {{-- /table Gagal --}}
                 {{-- chart Gagal --}}
                 <hr class="my-5">
                 <div class="d-grid" >
                 <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($uniqueYearsCount as $index => $year)
                            <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($uniqueYearsCount as $year => $data)
                           <div class="carousel-item {{ $loop->first  ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column">
                                            <div class="col">
                                                <div class="card border-primary ">
                                                    <div class="card-header">
                                                        <h5 class="mb-0 text-black">Riwayat Gagal Panen</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart-container">
                                                            <canvas id="myChart{{ $year }}"></canvas>
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col mt-4">
                                                <div class="card border-primary mt-10 ">
                                                    <div class="card-header">
                                                        <h5 class="mb-0 text-black">Riwayat Gagal Panen</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart-container">
                                                            <h1 class="text-black">Total Kg Gagal Panen Tahun {{ $year }} : 
                                                                @forEach($GagalForChartMonth as $data)
                                                                    @if($data->year === $year)
                                                                        {{ $data->total }} Kg
                                                                    @else
                                                                    @endif
                                                                @endforeach
                                                            </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="card border-primary">
                                            <div class="card-header">
                                                <h5 class="mb-0 text-black">Riwayat Gagal Panen</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-container" >
                                                    <canvas id="donutChart{{ $year }}" ></canvas>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                           </div>
                        @endforeach
          
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                </div>
               {{-- /chart Gagal --}}
               <hr class="my-5" />
               <div class="d-flex justify-content-between align-items-center mb-3" id="suksespanen">
                   <div>
                       <small class="text-light fw-semibold">Riwayat</small>
                       <div class="mt-3">
                           <div class="btn-group" role="group" aria-label="Basic example">
                               <form action="{{ route('Peternakan',['id' => $id]) }}">
                                   <input class="" type="hidden" name="weekS" value=1 placeholder="Search by name" > 
                                   <button type="submit" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekS' => 1]) ? 'active' : '' }}" >week 1</button>
                               </form>
                               <form action="{{ route('Peternakan',['id' => $id]) }}">
                                   <input class="" type="hidden" name="weekS" value=2 placeholder="Search by name" > 
                                   <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekS' => 2]) ? 'active' : '' }}">week 2</button>
                               </form>
                               <form action="{{ route('Peternakan',['id' => $id]) }}">
                                   <input class="" type="hidden" name="weekS" value=3 placeholder="Search by name" > 
                                   <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekS' => 3]) ? 'active' : '' }}" >week 3</button>
                               </form>
                               <form action="{{ route('Peternakan',['id' => $id]) }}">
                                   <input class="" type="hidden" name="weekS" value=4 placeholder="Search by name" >
                                   <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekS' => 4]) ? 'active' : '' }}" >week 4</button>
                               </form>
                               <form action="{{ route('Peternakan',['id' => $id]) }}">
                                <input class="" type="hidden" name="weekS" value=5 placeholder="Search by name" >
                                <button type="submit" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekS' => 5]) ? 'active' : '' }}" >Remaining days</button>
                            </form>
                               <a href="{{ route('Peternakan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                            </div>
                       </div>
                   </div>
                   <button
                       type="button"
                       class="btn btn-danger"
                       data-bs-toggle="modal"
                       data-bs-target="#sukses"
                   >Tambahkan Data Sukses Panen
                   </button>
               </div>
               {{-- table sukses --}}
               <div class="card" >
                <h5 class="card-header">Riwayat Sukses Panen</h5>
                <div class="table-responsive text-nowrap" id="salesContainer" >
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th>Jumlah Panen</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($suksess as $sale)
                      
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $sale->produk->nama }}</strong></td>
                          <td>{{ $sale->jumlah_sukses }}</td>
                          <td>{{ $sale->created_at }}</td>
                      
                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                
                                <form action="{{ route('Peternakan.deleteSukses',['sukses'=>$sale->id] ) }}" method="POST" id="deleteForm2" >
                                  @csrf
                                  
                                  @method('DELETE')
                                <button class="dropdown-item" type="button" onclick="confirmDelete2('{{ $sale->id }}')"
                                  ><i class="bx bx-trash me-1"></i> Delete</button
                                  >
                                </form>
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
                  {{ $suksess->appends(['productName' => request('productName')])->links() }}
                </div>
               </div>




               {{-- /table sukses --}}
               {{-- chart sukses biasa --}}
               <hr class="my-5">
               <div class="d-grid" >
                   <div id="carouselExample2" class="carousel slide" data-bs-ride="carousel">
                      <ol class="carousel-indicators">
                         @foreach($uniqueYearsCount as $index => $year)
                          <li data-bs-target="#carouselExample2" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                         @endforeach
                      </ol>
                      <div class="carousel-inner">
                        @foreach($uniqueYearsCount as $year => $data)
                          <div class="carousel-item {{ $loop->first  ? 'active' : '' }}">
                              <div class="row">
                                <div class="col">
                                  <div class="card border-primary ">
                                    <div class="card-header">
                                      <h5 class="mb-0 text-black">Riwayat Data Sukses Panen</h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="chart-container">
                                        <canvas id="myChartJ{{ $year }}"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                             <div class="card mt-2">
                    
                              <div class="card-body">
                                <h1 class="text-black">Total Kg Sukses Panen Tahun {{ $year }} : 
                                  @forEach($SuksesForChartMonth as $data)
                                    @if($data->year === $year)
                        
                                    {{ $data->total }} Kg
                                    @else
                        
                                    @endif
                                  @endforeach
                                </h1>
                              </div>
                              </div>
                          </div>
                        @endforeach
                     </div>
                     <a class="carousel-control-prev" href="#carouselExample2" role="button" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExample2" role="button" data-bs-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Next</span>
                     </a>
                  </div>
               </div>
                {{-- /chart sukses biasa --}}
                <hr class="my-5" />
                    <div class="d-flex justify-content-between align-items-center mb-3" id="gagalpanentelur">
                        <div>
                            <small class="text-light fw-semibold">Riwayat</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example" >
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formgagalt1">
                                        <input class="" type="hidden" name="weekJ" value=1 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formgagalt1','gagalpanentelur')" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekJ' => 1]) ? 'active' : '' }}" >week 1</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formgagalt2">
                                        <input class="" type="hidden" name="weekJ" value=2 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formgagalt2','gagalpanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekJ' => 2]) ? 'active' : '' }}">week 2</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formgagalt3">
                                        <input class="" type="hidden" name="weekJ" value=3 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formgagalt3','gagalpanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekJ' => 3]) ? 'active' : '' }}" >week 3</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formgagalt4">
                                        <input class="" type="hidden" name="weekJ" value=4 placeholder="Search by name" >
                                        <button type="submit" onclick="submitFormAndScroll('formgagalt4','gagalpanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekJ' => 4]) ? 'active' : '' }}" >week 4</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formgagalt5">
                                      <input class="" type="hidden" name="weekJ" value=5 placeholder="Search by name" >
                                      <button type="submit" onclick="submitFormAndScroll('formgagalt5','gagalpanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekJ' => 5]) ? 'active' : '' }}" >Remaining days</button>
                                  </form>
                                    <a href="{{ route('Peternakan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                                 </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#gagalT"
                        >Tambahkan Data Gagal Panen Telur
                        </button>
                    </div>
                {{-- table Gagal --}}
                <div class="card">
                  <h5 class="card-header">Data Gagal Panen Telur</h5>
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nama Produk</th>
                          <th>Jumlah Gagal dalam : KG</th>
                          <th>Tanggal</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
  
                      @foreach($gagalT as $gagal)
  
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $gagal->produk->nama }}</strong></td>
                          <td>{{ $gagal->jumlah_gagal }}</td>
                          <td>{{ $gagal->created_at }}</td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                               
                                <form action="{{ route('Peternakan.deleteGagalT',['gagalT'=>$gagal->id] ) }}" method="POST" id="deleteForm3" >
                                  @csrf
                                  
                                  @method('DELETE')
                                <button class="dropdown-item" type="button" onclick="confirmDelete3('{{ $gagal->id }}')"
                                  ><i class="bx bx-trash me-1"></i> Delete</button
                                  >
                                </form>
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
                    {{ $gagalT->appends(['productName' => request('productName')])->links() }}
                  </div>
               </div>
               {{-- /table GagalT --}}
               {{-- chart gaga telur --}}
               <hr class="my-5">
               <div class="d-grid" >
                   <div id="carouselExample3" class="carousel slide" data-bs-ride="carousel">
                      <ol class="carousel-indicators">
                         @foreach($uniqueYearsCount as $index => $year)
                          <li data-bs-target="#carouselExample3" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                         @endforeach
                      </ol>
                      <div class="carousel-inner">
                        @foreach($uniqueYearsCount as $year => $data)
                          <div class="carousel-item {{ $loop->first  ? 'active' : '' }}">
                              <div class="row">
                                <div class="col">
                                  <div class="card border-primary ">
                                    <div class="card-header">
                                      <h5 class="mb-0 text-black">Riwayat Data Gagal Panen Telur</h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="chart-container">
                                        <canvas id="myChartT{{ $year }}"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                             <div class="card mt-2">
                    
                              <div class="card-body">
                                <h1 class="text-black">Total  Gagal Panen Telur {{ $year }} : 
                                  @forEach($GagalTForChartMonth as $data)
                                    @if($data->year === $year)
                        
                                    {{ $data->total }} Kg
                                    @else
                        
                                    @endif
                                  @endforeach
                                </h1>
                              </div>
                              </div>
                          </div>
                        @endforeach
                     </div>
                     <a class="carousel-control-prev" href="#carouselExample3" role="button" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExample3" role="button" data-bs-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Next</span>
                     </a>
                  </div>
               </div>
                {{-- /chart gagalTelur --}}
                <hr class="my-5" />
                    <div class="d-flex justify-content-between align-items-center mb-3" id="suksespanentelur">
                        <div>
                            <small class="text-light fw-semibold">Riwayat</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formsuksestelur1">
                                        <input class="" type="hidden" name="weekK" value=1 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formsuksestelur1','suksespanentelur')" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekK' => 1]) ? 'active' : '' }}" >week 1</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formsuksestelur2">
                                        <input class="" type="hidden" name="weekK" value=2 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formsuksestelur2','suksespanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekK' => 2]) ? 'active' : '' }}">week 2</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formsuksestelur3">
                                        <input class="" type="hidden" name="weekK" value=3 placeholder="Search by name" > 
                                        <button type="submit" onclick="submitFormAndScroll('formsuksestelur3','suksespanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekK' => 3]) ? 'active' : '' }}" >week 3</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formsuksestelur4">
                                        <input class="" type="hidden" name="weekK" value=4 placeholder="Search by name" >
                                        <button type="submit" onclick="submitFormAndScroll('formsuksestelur4','suksespanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekK' => 4]) ? 'active' : '' }}" >week 4</button>
                                    </form>
                                    <form action="{{ route('Peternakan',['id' => $id]) }}" id="formsuksestelur5">
                                      <input class="" type="hidden" name="weekK" value=5 placeholder="Search by name" >
                                      <button type="submit" onclick="submitFormAndScroll('formsuksestelur5','suksespanentelur')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekK' => 5]) ? 'active' : '' }}" >Remaining days</button>
                                  </form>
                                    <a href="{{ route('Peternakan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                                 </div>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#suksesT"
                        >Tambahkan Data Sukses Panen Telur
                        </button>
                    </div>
                {{-- table sukses Telur --}}
               <div class="card">
                <h5 class="card-header">Riwayat Sukses Panen Telur</h5>
                <div class="table-responsive text-nowrap" id="salesContainer" >
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Produk</th>
                        <th>Jumlah Panen</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($suksessT as $sale)
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $sale->produk->nama }}</strong></td>
                          <td>{{ $sale->jumlah_sukses }}</td>
                          <td>{{ $sale->created_at }}</td>
                      
                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                
                                <form action="{{ route('Peternakan.deleteSuksesT',['suksesT'=>$sale->id] ) }}" method="POST" id="deleteForm4" >
                                  @csrf
                                  
                                  @method('DELETE')
                                <button class="dropdown-item" type="button" onclick="confirmDelete4('{{ $sale->id }}')"
                                  ><i class="bx bx-trash me-1"></i> Delete</button
                                  >
                                </form>
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
                  {{ $suksessT->appends(['productName' => request('productName')])->links() }}
                </div>
               </div>




               {{-- /table sukses telur --}}
               {{-- chart Sukses telur --}}
               <hr class="my-5">
               <div class="d-grid" >
                   <div id="carouselExample4" class="carousel slide" data-bs-ride="carousel">
                      <ol class="carousel-indicators">
                         @foreach($uniqueYearsCount as $index => $year)
                          <li data-bs-target="#carouselExample4" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                         @endforeach
                      </ol>
                      <div class="carousel-inner">
                        @foreach($uniqueYearsCount as $year => $data)
                          <div class="carousel-item {{ $loop->first  ? 'active' : '' }}">
                              <div class="row">
                                <div class="col">
                                  <div class="card border-primary ">
                                    <div class="card-header">
                                      <h5 class="mb-0 text-black">Riwayat Data Sukses Panen Telur</h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="chart-container">
                                        <canvas id="myChartTS{{ $year }}"></canvas>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                             <div class="card mt-2">
                    
                              <div class="card-body">
                                <h1 class="text-black">Total  Sukses Panen Telur {{ $year }} : 
                                  @forEach($SuksesTForChartMonth as $data)
                                    @if($data->year === $year)
                        
                                    {{ $data->total }} Kg
                                    @else
                        
                                    @endif
                                  @endforeach
                                </h1>
                              </div>
                              </div>
                          </div>
                        @endforeach
                     </div>
                     <a class="carousel-control-prev" href="#carouselExample4" role="button" data-bs-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselExample4" role="button" data-bs-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Next</span>
                     </a>
                  </div>
               </div>
                {{-- /chart suksesTelur --}}
                <hr class="my-5" />
                <div class="d-flex justify-content-between align-items-center mb-3" id="targetSection">
                    <div>
                        <small class="text-light fw-semibold">Riwayat</small>
                        <div class="mt-3">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{ route('Peternakan',['id' => $id]) }}" id="form1Penjualan">
                                    <input class="" type="hidden" name="weekZ" value=1 placeholder="Search by name" > 
                                    <button type="submit" onclick="submitFormAndScroll('form1Penjualan','targetSection')" class="btn btn-outline-secondary  {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekZ' => 1]) ? 'active' : '' }}" >week 1</button>
                                </form>
                                <form action="{{ route('Peternakan',['id' => $id]) }}" id="form2Penjualan">
                                    <input class="" type="hidden" name="weekZ" value=2 placeholder="Search by name" > 
                                    <button type="submit" onclick="submitFormAndScroll('form2Penjualan','targetSection')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekZ' => 2]) ? 'active' : '' }}">week 2</button>
                                </form>
                                <form action="{{ route('Peternakan',['id' => $id]) }}" id="form3Penjualan">
                                    <input class="" type="hidden" name="weekZ" value=3 placeholder="Search by name" > 
                                    <button type="submit" onclick="submitFormAndScroll('form3Penjualan','targetSection')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekZ' => 3]) ? 'active' : '' }}" >week 3</button>
                                </form>
                                <form action="{{ route('Peternakan',['id' => $id]) }}" id="form4Penjualan">
                                    <input class="" type="hidden" name="weekZ" value=4 placeholder="Search by name" >
                                    <button type="submit" onclick="submitFormAndScroll('form4Penjualan','targetSection')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekZ' => 4]) ? 'active' : '' }}" >week 4</button>
                                </form>
                                <form action="{{ route('Peternakan',['id' => $id]) }}" id="form5Penjualan">
                                  <input class="" type="hidden" name="weekZ" value=5 placeholder="Search by name" >
                                  <button type="submit" onclick="submitFormAndScroll('form5Penjualan','targetSection')" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id, 'weekZ' => 5]) ? 'active' : '' }}" >Remaining days</button>
                              </form>
                                <a href="{{ route('Peternakan',['id' => $id]) }}" class="btn btn-outline-secondary {{ request()->fullUrl() == route('Peternakan', [ 'id' => $id]) ? 'active' : '' }}">all</a>
                             </div>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#penjualan"
                    >Tambahkan Data Penjualan
                    </button>
                </div>
                <!-- sale -->
               <div class="card">
                <h5 class="card-header">Riwaya Penjualan</h5>
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
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $sale->produk->nama }}</strong></td>
                          <td>{{ $sale->jumlah }}</td>
                          <td>{{ $sale->ammount }}</td>
                          <td>{{ $sale->created_at }}</td>
                      
                          
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                               
                                <form action="{{ route('Peternakan.deleteSale',['sale'=>$sale->id] ) }}" method="POST" id="deleteForm5" >
                                  @csrf
                                  
                                  @method('DELETE')
                                <button class="dropdown-item" type="button" onclick="confirmDelete5('{{ $sale->id }}')"
                                  ><i class="bx bx-trash me-1"></i> Delete</button
                                  >
                                </form>
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
                  {{ $sales->appends(['productName' => request('productName')])->links() }}
              </div>
              </div>
             
            
              
                <!-- /sale -->
                {{-- chart sale --}}
                <hr class="my-5">
                <div class="d-grid" >
                   <div id="carouselExample5" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
           @foreach($uniqueYearsCount as $index => $year)
           
           <li data-bs-target="#carouselExample5" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
          @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach($uniqueYearsCount as $year => $data)
        
          <div class="carousel-item {{ $loop->first  ? 'active' : '' }}">
            <div class="row">
                    
                     
                        <div class="col">
                          <div class="card border-primary ">
                            <div class="card-header">
                              <h5 class="mb-0 text-black">Riwayat Data Penjualan</h5>
                            </div>
                              <div class="card-body">
                                <div class="chart-container">
                                <canvas id="myChartZ{{ $year }}"></canvas>
                                </div>
                              </div>
                          </div>
                        </div>
                       
                      
                    
                  

                
                  </div>
          </div>
          @endforeach
         
        </div>
        <a class="carousel-control-prev" href="#carouselExample5" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample5" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>



                </div>

              {{-- /chart sale --}}
                 

               
                  
            {{-- /content --}}
            </div>
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
                                    <form action="{{ route('Peternakan.addProduct', ['id'=>$id]) }}" method="POST">
                                        @csrf
                                        <label for="nama" class="form-label">Nama Hewan</label>
                                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Enter Name" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" id="harga" name="harga" class="form-control" placeholder="Enter Number" />
                                </div>
                             </div>
                             <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="group" class="form-label">Jenis</label>
                                    <select name="group" id="group" class="form-select">
                                        <option value="Hewan Penghasil Bahan Pakan Lainnya">Hewan Penghasil Bahan Pakan Lainnya</option>
                                        <option value="Hewan Penghasil Bahan Pakan Telur">Hewan Penghasil Bahan Pakan Telur</option>
                                    </select>
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
                                  <form action="{{ route('Peternakan.editProduct', ['id'=>$id]) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" id="produk" name="produk">

                                      <label for="nama" class="form-label">Nama Hewan</label>
                                      <input type="text" id="nama1" name="nama" class="form-control" placeholder="Enter Name" />
                              </div>
                          </div>
                          <div class="row g-2">
                              <div class="col mb-0">
                                  <label for="harga" class="form-label">Harga</label>
                                  <input type="text" id="harga1" name="harga" class="form-control" placeholder="Enter Number" />
                              </div>
                           </div>
                           <div class="row g-2">
                              <div class="col mb-0">
                                  <label for="group" class="form-label">Jenis</label>
                                  <select name="group" id="group1" class="form-select">
                                      <option value="Hewan Penghasil Bahan Pakan Lainnya">Hewan Penghasil Bahan Pakan Lainnya</option>
                                      <option value="Hewan Penghasil Bahan Pakan Telur">Hewan Penghasil Bahan Pakan Telur</option>
                                  </select>
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
          <!-- / Large edit Modal -->
            <!--  gagal Modal -->
            <div class="modal fade" id="gagal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Gagal Panen</h5>
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
                          <form action="{{ route('Peternakan.addGagal',['id' => $id]) }}" method="POST">
                            @csrf

                          <label class="form-label" for="Produk_id">Produk</label>
                            <select class="form-select" name="Produk_id" id="Produk_id">
                                @foreach ($produks as $option)
                                    @if($option->group === "Hewan Penghasil Bahan Pakan Lainnya")
                                        <option value="{{ $option->id }}">{{ $option->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="row g-2">
                        <div class="col mb-0">
                          <label for="jumlah" class="form-label">Jumlah : Kg</label>
                          <input type="text" id="jumlah" name="jumlah_gagal" class="form-control" placeholder="Number" />
                        </div>
                        <div class="col mb-0">
                          <label for="keterangan" class="form-label">Keterangan</label>
                          <select name="keterangan" id="keterangan" class="form-select">
                            <option value="Mati">Mati</option>
                            <option value="Kelangkaan Ternak">Kelangkaan Ternak</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" class="btn btn-primary">Tambah Data Gagal Panen</button>
                    </div>
                  </form>
                  </div>
                </div>
            </div>
               <!--  /gagal Modal -->
               <!--  sukses Modal -->
               <div class="modal fade" id="sukses" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Sukses Panen</h5>
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
                          <form action="{{ route('Peternakan.addSukses',['id' => $id]) }}" method="POST">
                            @csrf
                          <label class="form-label" for="Produk_id">Produk</label>
                            <select class="form-select" name="Produk_id" id="Produk_id">
                              @foreach ($produks as $option)
                                @if($option->group === "Hewan Penghasil Bahan Pakan Lainnya")
                                    <option value="{{ $option->id }}">{{ $option->nama }}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="row g-2">
                        <div class="col mb-0">
                          <label for="jumlah" class="form-label">Jumlah Panen</label>
                          <input type="text" id="jumlah" name="jumlah_sukses" class="form-control" placeholder="Number" />
                        </div>
                       
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                      </button>
                      <button type="submit" class="btn btn-primary">Tambah Data Sukses Panen</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
               <!--  /sukses Modal -->
                 <!--  gagalT Modal -->
            <div class="modal fade" id="gagalT" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Gagal Panen Telur</h5>
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
                        <form action="{{ route('Peternakan.addGagalT',['id' => $id]) }}" method="POST">
                          @csrf
                        <label class="form-label" for="Produk_id">Produk</label>
                          <select class="form-select" name="Produk_id" id="Produk_id">
                              @foreach ($produks as $option)
                                  @if($option->group === "Hewan Penghasil Bahan Pakan Telur")
                                      <option value="{{ $option->id }}">{{ $option->nama }}</option>
                                  @endif
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="row g-2">
                      <div class="col mb-0">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" id="jumlah" name="jumlah_gagal" class="form-control" placeholder="Number" />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah Data Gagal Panen</button>
                  </div>
                </form>
                </div>
              </div>
          </div>
             <!--  /gagalT Modal -->
             <!--  sukses Modal -->
             <div class="modal fade" id="suksesT" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Tambah Data Sukses Panen Telur</h5>
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
                        <form action="{{ route('Peternakan.addSuksesT',['id' => $id]) }}" method="POST">
                          @csrf
                        <label class="form-label" for="Produk_id">Produk</label>
                          <select class="form-select" name="Produk_id" id="Produk_id">
                            @foreach ($produks as $option)
                              @if($option->group === "Hewan Penghasil Bahan Pakan Telur")
                                  <option value="{{ $option->id }}">{{ $option->nama }}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="row g-2">
                      <div class="col mb-0">
                        <label for="jumlah" class="form-label">Jumlah Panen</label>
                        <input type="text" id="jumlah" name="jumlah_sukses" class="form-control" placeholder="Number" />
                      </div>
                     
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Close
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah Data Sukses Panen</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
             <!--  /sukses Modal -->
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
                          <form action="{{ route('Peternakan.addSale',['id' => $id]) }}" method="POST">
                            @csrf
                          <label class="form-label" for="Produk_id">Produk</label>
                            <select class="form-select" name="Produk_id" id="Produk_id">
                                @foreach ($produks as $option)
                                    <option value="{{ $option->id }}">{{ $option->nama }}</option>
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
         $('#dismiss-button').click(function() {
            // Manually close the alert
            $('#success-alert').alert('close');
        }); 
        let theDatas = @json($GagalForChart);
        let theYear = [];
        theDatas.forEach(element => {
            if(theYear[theYear.length -1] != element.year){
                theYear.push(element.year)
            }else{

            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            theYear.forEach(el => {
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
                        label: 'Total Gagal Panen KG',
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
                            text: `Data Gagal Panen Tahun ${el}`
                        }
                        }
                    }
                 });

            })
            
        });
        // donut for keterangan
        let theDatasDonut = @json($GagalForDonut);
        let years = [];
        theDatasDonut.forEach(e =>{
          if (years[years.length -1] !== e.year){
            years.push(e.year);
          }

        });
        var labels = [];
        const sortedDatasDonut = theDatasDonut.slice().sort((a, b) => {
              const keteranganA = a.keterangan.toLowerCase();
              const keteranganB = b.keterangan.toLowerCase();

              if (keteranganA < keteranganB) {
                  return -1;
              } else if (keteranganA > keteranganB) {
                  return 1;
              } else {
                  return 0;
              }
        });

        sortedDatasDonut.forEach(el =>{
          if(labels[labels.length -1] !== el.keterangan){
            labels.push(el.keterangan);
          }
        });
        years.forEach(el =>{
          var ctx = document.getElementById(`donutChart${el}`).getContext('2d');
          var dataH = 0 ;
          var dataC = 0;
          var dataL =0;
          theDatasDonut.forEach(element=>{
            if(element.year === el){
              if(element.keterangan === 'Mati'){
                dataH += element.total;

              } else if(element.keterangan === 'Kelangkaan Ternak'){
                dataC += element.total;
              } else{
                dataL += element.total;

              }
            }
          });
          let data = [dataC,dataH,dataL];
          var myDonutChart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: labels,
                  datasets: [{
                      data: data,
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
          
        });
        // chart sukses biasa
        let allSukses = @json($SuksesForChart);
        let yLoop = [];
        allSukses.forEach(element => {
            if(yLoop[yLoop.length -1] != element.year){
               yLoop.push(element.year)
            }else{

            }
        });
        document.addEventListener('DOMContentLoaded', function () {
          yLoop.forEach(el => {
                var ctx = document.getElementById(`myChartJ${el}`).getContext('2d');
                let theMonth = [];
                let theTotal = [];
                // to get the month and the total for specified year
                allSukses.forEach(e => {
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
                        label: 'Total Sukses Panen ',
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
                            text: `Data Sukses Panen Tahun ${el}`
                        }
                        }
                    }
                 });

            })
            
        });
        //gagalTelur
        let allGtelur = @json($GagalTForChart);
        let yLoop1 = [];
        allGtelur.forEach(element => {
            if(yLoop1[yLoop1.length -1] != element.year){
              yLoop1.push(element.year)
            }else{

            }
        });
        document.addEventListener('DOMContentLoaded', function () {
          yLoop1.forEach(el => {
                var ctx = document.getElementById(`myChartT${el}`).getContext('2d');
                let theMonth = [];
                let theTotal = [];
                // to get the month and the total for specified year
                allGtelur.forEach(e => {
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
                        label: 'Total Gagal Panen Telur ',
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
                            text: `Data Gagal Panen Telur Tahun ${el}`
                        }
                        }
                    }
                 });

            })
            
        });
        //sukses telur
        let allStelur = @json($SuksesTForChart);
        let yLoop2 = [];
        allStelur.forEach(element => {
            if(yLoop2[yLoop2.length -1] != element.year){
              yLoop2.push(element.year)
            }else{

            }
        });
        document.addEventListener('DOMContentLoaded', function () {
          yLoop2.forEach(el => {
                var ctx = document.getElementById(`myChartTS${el}`).getContext('2d');
                let theMonth = [];
                let theTotal = [];
                // to get the month and the total for specified year
                allStelur.forEach(e => {
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
                        label: 'Total Sukses Panen Telur ',
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
                            text: `Data Sukses Panen Telur Tahun ${el}`
                        }
                        }
                    }
                 });

            })
            
        });
        //sale chart
        let yearly = @json($salesForChart);
        let loopList = [];
        yearly.forEach(el => {
          if(loopList[loopList.length -1] != el.year){
            loopList.push(el.year);
          }else{}

        });
        document.addEventListener('DOMContentLoaded', function () {
         loopList.forEach(el => {
          var ctx = document.getElementById(`myChartZ${el}`).getContext('2d');
          let theMonth = [];
          let theTotal = [];
          // to get the month and the total for specified year
          yearly.forEach(e => {
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
                        label: 'Total Omset',
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
                        text: `Data Omset per Tahun ${el}`
                      }
                    }
                  }
            });

         })
            
        });
        function editProduk(productName, harga, group, id) {
          // Set values in the modal fields
          
          document.getElementById('nama1').value = productName;
          document.getElementById('harga1').value = harga;
          document.getElementById('group1').value = group;
          document.getElementById('produk').value = id;
          // Open the modal
          $('#editProdukModal').modal('show');
        }
        function confirmDelete(produkId) {
        // Use SweetAlert for a styled alert
        console.log(produkId);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteProduct", ["produk" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm').action = url;
                document.getElementById('deleteForm').submit();
            } 
        });
    }
    function confirmDelete1(produkId) {
        // Use SweetAlert for a styled alert
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteGagal", ["gagal" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm1').action = url;
                document.getElementById('deleteForm1').submit();
            } 
        });
    }
    function confirmDelete2(produkId) {
        // Use SweetAlert for a styled alert
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteSukses", ["sukses" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm2').action = url;
                document.getElementById('deleteForm2').submit();
            } 
        });
    }
    function confirmDelete3(produkId) {
        // Use SweetAlert for a styled alert
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteGagalT", ["gagalT" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm3').action = url;
                document.getElementById('deleteForm3').submit();
            } 
        });
    } function confirmDelete4(produkId) {
        // Use SweetAlert for a styled alert
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteSuksesT", ["suksesT" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm4').action = url;
                document.getElementById('deleteForm4').submit();
            } 
        });
    }
    function confirmDelete5(produkId) {
        // Use SweetAlert for a styled alert
        
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("Peternakan.deleteSale", ["sale" => ":id"]) }}';
                url = url.replace(':id', produkId);

                document.getElementById('deleteForm5').action = url;
                document.getElementById('deleteForm5').submit();
            } 
        });
    }
    function submitFormAndScroll(formId, targetSectionId) {
        // Append the fragment identifier to the form action
        document.getElementById(formId).action += `#${targetSectionId}`;
        document.getElementById(formId).submit();
    }   if (window.location.hash) {
        // Get the target element using the fragment identifier
        var targetElement = document.getElementById(window.location.hash.substring(1));

        // Scroll to the target element
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToTargetSection(target) {
        var targetSection = document.getElementById(target);

        if (targetSection) {
            targetSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function scrollToTop() {
        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
        
    </script>
        <div class="buy-now">
          <a
          onclick="scrollToTop()"
            
            target="_blank"
            class="btn btn-icon  btn-buy-now"
            >  <span class="tf-icons bx bx-arrow-to-top"></span></a
          >
        </div>
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