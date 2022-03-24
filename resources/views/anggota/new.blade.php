@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    @php

        $x=1;
        
    @endphp

    <script type="text/javascript">
        // function addRow(){
        //     var i =  $('#ipapprove tr:last').data('id');
        //     i = i+1;
        //     $('#ipapprove').append('<tr data-id="'+ i +'" id="'+ i +'">\
        //         <td>\
        //             <input placeholder="nama" class="form-control" name="ipapprove['+ i +'][nama]" type="text">\
        //         </td>\
        //         <td>\
        //             <input placeholder="gender" class="form-control" name="ipapprove['+ i +'][gender]" type="text">\
        //         </td>\
        //         <td>\
        //             <input placeholder="hubungan" class="form-control" name="ipapprove['+ i +'][hubungan]" type="text">\
        //         </td>\
        //         <td>\
        //             <input placeholder="pekerjaan" class="form-control" name="ipapprove['+ i +'][pekerjaan]" type="text">\
        //         </td>\
        //         <td>\
        //             <input placeholder="status" class="form-control" name="ipapprove['+ i +'][status]" type="text">\
        //         </td>\
        //         <td>\
        //             <a class="dropdown-item" href="#" onclick="delRow('+ i +')"><i class="ni ni-fat-delete text-default"></i></a>\
        //         </td>\
        //     </tr>');
        // };

        function delRow($id){  
            document.getElementById($id).style.display = 'none';
        }
        
    </script>

    <div class="container-fluid mt--7">
        <div class="container-fluid mt--7">            
            <form method="post" name="inputForm" action="{{ route('addAnggota') }}" accept-charset="UTF-8">
                
                @if( session()->has('arr2'))
                    @php $sent = session('arr2'); @endphp
                    @if( $sent[0]=="good")
                    @php $mesages = $sent[1]; @endphp
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text"><strong>Success!</strong> {{$mesages}}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif  
                    @if( $sent[0]=="bad")
                    @php $mesages = $sent[1]; @endphp
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-inner--text"><strong>Danger!</strong> This is a danger alert—check it out!</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif  
                @endif  
                <div class="row">
                    <div class="col-xl-8 order-xl-1 mb-5 mb-xl-5">
                        <div  class="card bg-secondary shadow">
                           
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">Data Pribadi</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name-input" class="form-control-label">Nama</label>
                                        <input class="form-control" type="text" name="name-input" id="name-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="keluarga-input" class="form-control-label">Keluarga</label> 
                                        <select class="form-control" name="keluarga-input" id="keluarga-input">
                                            @foreach($keluargaList as $klrga)
                                            <option value="{{ $klrga->keluarga_id}}">{{ $klrga->nama}} - {{$klrga->nama_kepala}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat_lahir-input" class="form-control-label">Tempat Lahir</label>
                                        <input class="form-control" type="text" name="tempat_lahir-input" id="tempat_lahir-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_lahir-input" class="form-control-label">Tanggal Lahir</label>
                                        <input class="form-control" type="text" name="tanggal_lahir-input" id="tanggal_lahir-input">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="alamat1-input" class="form-control-label">Alamat 1</label>
                                        <input class="form-control" type="text" name="alamat1-input" id="alamat1-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="alamat2-input" class="form-control-label">Alamat 2</label>
                                        <input class="form-control" type="text" name="alamat2-input" id="alamat2-input">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telpon1-input" class="form-control-label">Telepon Rumah</label>
                                        <input class="form-control" type="text" name="telpon1-input" id="telpon1-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telpon2-input" class="form-control-label">Telepon Handphone</label>
                                        <input class="form-control" type="text" name="telpon2-input" id="telpon2-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row, margin-left: 30px">
                                        <label for="gender-input" class="form-control-label">Gender</label>
                                    </div>
                                    <div class="row, margin-left: 30px">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input value="L" type="radio" id="gender-male" name="gender-input" value="L" class="custom-control-input">
                                            <label class="custom-control-label" for="gender-male">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input value="P" type="radio" id="gender-female" name="gender-input" value="P" class="custom-control-input">
                                            <label class="custom-control-label" for="gender-female">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hubungan-input" class="form-control-label">Hubungan Keluarga</label>
                                    <input class="form-control" type="text" name="hubungan-input" id="hubungan-input">
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan-input" class="form-control-label">Penndidikann / pekerjaan</label>
                                    <input class="form-control" type="text" name="pekerjaan-input" id="pekerjaan-input">
                                </div>
                                <div class="form-group">
                                    <label for="status-input" class="form-control-label">Status Anggota</label>
                                    <input class="form-control" type="text" name="status-input" id="status-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-5">
                        <div class="card bg-secondary shadow  mb-5 mb-xl-5">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">Data Kegerejaan</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat_baptis-input" class="form-control-label">Tempat Baptis</label>
                                        <input class="form-control" type="text" name="tempat_baptis-input" id="tempat_baptis-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_lahir-input" class="form-control-label">Tanggal Baptis</label>
                                        <input class="form-control" type="text" name="tanggal_baptis-input" id="tanggal_baptis-input">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat_sidi-input" class="form-control-label">Tempat Sidi</label>
                                        <input class="form-control" type="text" name="tempat_sidi-input" id="tempat_sidi-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_sidi-input" class="form-control-label">Tanggal Sidi</label>
                                        <input class="form-control" type="text" name="tanggal_sidi-input" id="tanggal_sidi-input">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat_nikah-input" class="form-control-label">Tempat Menikah</label>
                                        <input class="form-control" type="text" name="tempat_nikah-input" id="tempat_nikah-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tanggal_nikah-input" class="form-control-label">Tanggal Menikah</label>
                                        <input class="form-control" type="text" name="tanggal_nikah-input" id="tanggal_nikah-input">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="gereja_asal-input" class="form-control-label">Gereja Asal</label>
                                        <input class="form-control" type="text" name="gereja_asal-input" id="gereja_asal-input">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gereja_terdaftar-input" class="form-control-label">Gereja Terdaftar</label>
                                        <input class="form-control" type="text" name="gereja_terdaftar-input" id="gereja_terdaftar-input">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="card bg-secondary shadow ">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">Upload Excel File</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <button class="btn btn-primary">Import data</button>
                    </form>
                </div>
            </div>
            @if( session()->has('arr'))
            @php $anggotaList = session('arr'); @endphp
            <div class=" order-xl-3 mb-5 mb-xl-0">
                <div class="card bg-secondary shadow  mt-2 mb-5 mb-xl-5">
                    <div class="card-header bg-white border-0 ">
                        <div class="row align-items-center">
                            <h3 class="mb-0">Data Excel</h3>
                        </div>
                    </div>
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
                                @foreach($anggotaList[0] as $anggotaArr)

                                @php
                                    $anggota = (object)$anggotaArr
                                @endphp
                                <tr data-id={{$x}}  id={{$x}}>
                                    <td>
                                        {{ $anggota->nama_lengkap }}
                                    </td>
                                    <td>
                                        @if ( $anggota->gender== "Lk")
                                            Laki-Laki
                                        @elseif ( $anggota->gender== "Pr")
                                            Perempuan
                                        @else
                                            {{ $anggota->gender }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $anggota->hubungan_keluarga }}
                                    </td>
                                    <td>
                                        {{ $anggota->pendidikanpekerjaan }}
                                    </td>
                                    <td>
                                        {{ $anggota->status }}
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                                <a class="dropdown-item" href="#" onclick="delRow({{$x}}); return false;"><i class="ni ni-fat-delete text-default"></i></a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                @php
                                    $x=$x+1;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @include('layouts.footers.auth')

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush