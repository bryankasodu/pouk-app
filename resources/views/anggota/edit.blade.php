@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    @php

        $anggota_id = $anggotaById[0]->anggota_id;
        $keluarga_id = $anggotaById[0]->keluarga_id;
        $nama = $anggotaById[0]->nama;
        $gender = $anggotaById[0]->gender;
        $hubungan = $anggotaById[0]->hubungan;
        $pekerjaan = $anggotaById[0]->pekerjaan;
        $status = $anggotaById[0]->status;
        $keluarga = $anggotaById[0]->nama_keluarga;
        $alamat1 = $anggotaById[0]->alamat1;
        $alamat2 = $anggotaById[0]->alamat2;
        $telpon1 = $anggotaById[0]->telpon_rumah;
        $telpon2 = $anggotaById[0]->telpon_hp;

        $tempat_lahir = $anggotaById[0]->tempat_lahir;
        $tanggal_lahir = date('d-m-Y', strtotime($anggotaById[0]->tanggal_lahir));
        $tempat_baptis = $anggotaById[0]->tempat_baptis;
        $tanggal_baptis = date('d-m-Y', strtotime($anggotaById[0]->tanggal_baptis));
        $tempat_sidi = $anggotaById[0]->tempat_sidi;
        $tanggal_sidi = date('d-m-Y', strtotime($anggotaById[0]->tanggal_sidi));
        $tempat_nikah = $anggotaById[0]->tempat_nikah;
        $tanggal_nikah = date('d-m-Y', strtotime($anggotaById[0]->tanggal_nikah));
        $gereja_asal = $anggotaById[0]->gereja_asal;
        $gereja_terdaftar = $anggotaById[0]->gereja_terdaftar;
    @endphp
    <div class="container-fluid mt--7">
    
        @if($role=="superadmin")    
            <div class="container-fluid mt--7">            
                <form method="post" name="inputForm" action="{{ route('editAnggota') }}" accept-charset="UTF-8">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8 order-xl-1 mb-5 mb-xl-0">
                            <div  class="card bg-secondary shadow">
                                <div class="card-header bg-white border-0">
                                    <div class="row align-items-center">
                                        <h3 class="mb-0">Data Pribadi</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <input class="form-control" name="id-input" value="{{$anggota_id}}" type="hidden">
                                        <div class="form-group col-md-6">
                                            <label for="name-input" class="form-control-label">Nama</label>
                                            <input class="form-control" type="text" name="name-input" value="{{$nama}}" id="name-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Keluarga-input" class="form-control-label">Keluarga</label> 
                                            <select class="form-control" name="keluarga-input" id="keluarga-input">
                                                @foreach($keluargaList as $klrga)
                                                @if($keluarga_id == $klrga->keluarga_id)
                                                    <option value="{{ $klrga->keluarga_id}}" selected>{{ $klrga->nama}} - {{$klrga->nama_kepala}}</option>
                                                @else
                                                    <option value="{{ $klrga->keluarga_id}}">{{ $klrga->nama}} - {{$klrga->nama_kepala}}</option>
                                                @endif
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tempat_lahir-input" class="form-control-label">Tempat Lahir</label>
                                            <input class="form-control" type="text" name="tempat_lahir-input" value="{{$tempat_lahir}}" id="tempat_lahir-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_lahir-input" class="form-control-label">Tanggal Lahir</label>
                                            <input class="form-control" type="text" name="tanggal_lahir-input" value="{{$tanggal_lahir}}" id="tanggal_lahir-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="alamat1-input" class="form-control-label">Alamat 1</label>
                                            <input class="form-control" type="text" name="alamat1-input" value="{{$alamat1}}" id="alamat1-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="alamat2-input" class="form-control-label">Alamat 2</label>
                                            <input class="form-control" type="text" name="alamat2-input" value="{{$alamat2}}" id="alamat2-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="telpon1-input" class="form-control-label">Telepon Rumah</label>
                                            <input class="form-control" type="text" name="telpon1-input" value="{{$telpon1}}" id="telpon1-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="telpon2-input" class="form-control-label">Telepon Handphone</label>
                                            <input class="form-control" type="text" name="telpon2-input" value="{{$telpon2}}" id="telpon2-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row, margin-left: 30px">
                                            <label for="gender-input" class="form-control-label">Gender</label>
                                        </div>
                                        <div class="row, margin-left: 30px">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if($gender == "L")
                                                    <input value="L" type="radio" id="gender-male" name="gender-input" class="custom-control-input" checked>
                                                @else
                                                    <input value="L" type="radio" id="gender-male" name="gender-input" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="gender-male">Laki-Laki</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                @if($gender == "P")
                                                    <input value="P" type="radio" id="gender-female" name="gender-input" class="custom-control-input" checked>
                                                @else
                                                    <input value="P" type="radio" id="gender-female" name="gender-input" class="custom-control-input">
                                                @endif
                                                <label class="custom-control-label" for="gender-female">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="hubungan-input" class="form-control-label">Hubungan Keluarga</label>
                                        <input class="form-control" type="text" name="hubungan-input" value="{{$hubungan}}" id="hubungan-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan-input" class="form-control-label">Penndidikann / pekerjaan</label>
                                        <input class="form-control" type="text"name="pekerjaan-input" value="{{$pekerjaan}}" id="pekerjaan-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="status-input" class="form-control-label">Status Anggota</label>
                                        <input class="form-control" type="text" name="status-input" value="{{$status}}" id="status-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 order-xl-2 ">
                            <div class="card bg-secondary shadow">
                                <div class="card-header bg-white border-0">
                                    <div class="row align-items-center">
                                        <h3 class="mb-0">Data Kegerejaan</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tempat_baptis-input" class="form-control-label">Tempat Baptis</label>
                                            <input class="form-control" type="text" name="tempat_baptis-input" value="{{$tempat_baptis}}" id="tempat_baptis-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_lahir-input" class="form-control-label">Tanggal Baptis</label>
                                            <input class="form-control" type="text" name="tanggal_lahir-input" value="{{$tanggal_lahir}}" id="tanggal_lahir-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tempat_sidi-input" class="form-control-label">Tempat Sidi</label>
                                            <input class="form-control" type="text" name="tempat_sidi-input" value="{{$tempat_sidi}}" id="tempat_sidi-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_sidi-input" class="form-control-label">Tanggal Sidi</label>
                                            <input class="form-control" type="text" name="tanggal_sidi-input" value="{{$tanggal_sidi}}" id="tanggal_sidi-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="tempat_nikah-input" class="form-control-label">Tempat Menikah</label>
                                            <input class="form-control" type="text" name="tempat_nikah-input" value="{{$tempat_nikah}}" id="tempat_nikah-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tanggal_nikah-input" class="form-control-label">Tanggal Menikah</label>
                                            <input class="form-control" type="text" name="tanggal_nikah-input" value="{{$tanggal_nikah}}" id="tanggal_nikah-input">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gereja_asal-input" class="form-control-label">Gereja Asal</label>
                                            <input class="form-control" type="text" name="gereja_asal-input" value="{{$gereja_asal}}" id="gereja_asal-input">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gereja_terdaftar-input" class="form-control-label">Gereja Terdaftar</label>
                                            <input class="form-control" type="text" name="gereja_terdaftar-input" value="{{$gereja_terdaftar}}" id="gereja_terdaftar-input">
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
            </div>
        @endif

        @if($role=="user")    
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col-xl-8 order-xl-1 mb-5 mb-xl-0">
                        <div  class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">Data Pribadi</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Nama</label>
                                            <br>
                                            {{$nama}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Keluarga</label> 
                                            <br>    
                                            {{$keluarga}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tempat Lahir</label>
                                            <br>
                                            {{$tempat_lahir}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tanggal Lahir</label> 
                                            <br>    
                                            {{$tanggal_lahir}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Alamat 1</label>
                                            <br>
                                            {{$alamat1}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Alamat 2</label> 
                                            <br>    
                                            {{$alamat2}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Telepon Rumah</label>
                                            <br>
                                            {{$telpon1}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Telepon Handphone</label> 
                                            <br>    
                                            {{$telpon2}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Gender</label>
                                        <br>
                                        @if ( $gender== "L")
                                            Laki-Laki
                                        @else
                                            Perempuan
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Hubungan Keluarga</label>
                                        <br>
                                        {{$hubungan}}
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Pendidikann / pekerjaan</label>
                                        <br>
                                        {{$pekerjaan}}
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Status Anggota</label>
                                        <br>
                                        {{$status}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 order-xl-2 ">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">Data Kegerejaan</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                   
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tempat Baptis</label>
                                            <br>
                                            {{$tempat_baptis}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tanggal Baptis</label> 
                                            <br>    
                                            {{$tanggal_baptis}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tempat Sidi</label>
                                            <br>
                                            {{$tempat_sidi}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tanggal Sidi</label> 
                                            <br>    
                                            {{$tanggal_sidi}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tempat Menikah</label>
                                            <br>
                                            {{$tempat_nikah}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Tanggal Menikah</label> 
                                            <br>    
                                            {{$tanggal_nikah}}
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Gereja Asal</label>
                                            <br>
                                            {{$gereja_asal}}
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="form-control-label">Gereja Terdaftar</label> 
                                            <br>    
                                            {{$gereja_terdaftar}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endif

        @include('layouts.footers.auth')

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush