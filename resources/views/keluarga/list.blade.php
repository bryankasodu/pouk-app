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
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Keluarga</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('keluargaNew') }}" class="btn btn-sm btn-primary">Add Keluarga</a>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nama Keluarga</th>
                    <th scope="col" class="sort" data-sort="budget">Kepala Keluarga</th>
                    <th scope="col" class="sort" data-sort="status">Wilayah</th>
                    <th scope="col" class="sort" data-sort="budget">Jumlah PBK</th>
                    <th scope="col" class="sort" data-sort="status">PBK Terakhir</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                    @foreach($listKeluarga as $keluarga)
                    <tr>
                        <td>
                            {{ $keluarga->nama }}
                        </td>
                        <td>
                            {{ $keluarga->nama_kepala }}
                        </td>
                        <td>
                            {{ $keluarga->wilayah }}
                        </td>
                        <td>
                            {{ $keluarga->jumlah_pbk }}
                        </td>
                        <td>
                            {{ $keluarga->pbk_terakhir }}
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{ route('keluargaEdit',  ['id'=>$keluarga->keluarga_id] ) }}">Edit</a>
                                    <a class="dropdown-item" href="{{ route('keluargaDelete',  ['id'=>$keluarga->keluarga_id] ) }}">Delete</a>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- pagination -->
            <div class="d-flex justify-content-center">
                {{ $listKeluarga->links() }}
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