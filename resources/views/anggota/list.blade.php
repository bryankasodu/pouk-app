@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
    
    <div class="card">
            <!-- Card header -->
            <!-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form> -->
            <div class="card-header border-0">
              <div class="row align-items-center  mb-2">
                  <div class="col-8">
                      <h3 class="mb-0">Anggota</h3>
                  </div>
                  <div class="col-4 text-right">
                      <a href="{{ route('anggotaNew') }}" class="btn btn-sm btn-primary">Tambah Anggota</a>
                  </div>
              </div>

              <div class="row align-items-center  mb-2">
                <div class="col-12">
                  <form action="{{ route('search') }}" method="GET">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" name="search" placeholder="search" aria-label="search" value="{{ old('cari')}}"  aria-describedby="button-search">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit" id="button-addon2">Search</button>
                      </div>
                    </div>   
                  </form>
                </div>  
              </div>

            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nama Lengkap</th>
                    <th scope="col" class="sort" data-sort="budget">Jenis Kelamin</th>
                    <th scope="col" class="sort" data-sort="status">Hubungan Keluarga</th>
                    <th scope="col" class="sort" data-sort="completion">Pendidikan / Pekerjaan</th>
                    <th scope="col" class="sort" data-sort="completion">Status Anggota</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                @if($listAnggota->isNotEmpty()) 
                    @foreach($listAnggota as $anggota)
                    <tr>
                        <td>
                            {{ $anggota->nama }}
                        </td>
                        <td>
                            @if ( $anggota->gender== "L")
                                Laki-Laki
                            @else
                                Perempuan
                            @endif
                        </td>
                        <td>
                            {{ $anggota->hubungan }}
                        </td>
                        <td>
                            {{ $anggota->pekerjaan }}
                        </td>
                        <td>
                            {{ $anggota->status }}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                @php
                                  $id = $anggota->anggota_id
                                @endphp
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{ route('anggotaEdit',  ['id'=>$anggota->anggota_id] ) }}">Edit</a>
                                    <a class="dropdown-item" href="{{ route('anggotaDelete',  ['id'=>$anggota->anggota_id] ) }}">Delete</a>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                  @else 
                    <div class="ml-4">
                      <h2>No Anggota Found</h2>
                    </div>
                  @endif
                </tbody>
              </table>
            </div>
            <!-- pagination -->
            <div class="d-flex justify-content-center">
                {{ $listAnggota->links() }}
            </div>
            <!-- Card footer -->
            <!-- <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item">
                      <a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div> -->
          </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush