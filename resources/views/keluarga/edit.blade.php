@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    @php

        $keluarga_id = $keluargaById[0]->keluarga_id;
        $nama = $keluargaById[0]->nama;
        $wilayah = $keluargaById[0]->wilayah;
        $jumlah_pbk = $keluargaById[0]->jumlah_pbk;
        $pbk_terakhir = date('d-m-Y', strtotime($keluargaById[0]->pbk_terakhir));
        
        $pbk_d = date('j', strtotime($keluargaById[0]->pbk_terakhir));
        $pbk_ds = date('S', strtotime($keluargaById[0]->pbk_terakhir));
        $pbk_m = date('F', strtotime($keluargaById[0]->pbk_terakhir));
        $pbk_y = date('Y', strtotime($keluargaById[0]->pbk_terakhir));
        
        $x=1;
        $y=0;

    @endphp

    <script type="text/javascript">
        function addRow(){
            var i =  $('#ipapprove tr:last').data('id');
            i = i+1;
            $('#ipapprove').append('<tr data-id="'+ i +'" id="'+ i +'">\
                <input class="form-control" name="ipapprove['+ i +'][flag]" value="True" type="hidden">\
                <input class="form-control" name="ipapprove['+ i +'][new]" value="New" type="hidden">\
                <td>\
                    <input placeholder="nama" class="form-control" name="ipapprove['+ i +'][nama]" type="text">\
                </td>\
                <td>\
                    <input placeholder="gender" class="form-control" name="ipapprove['+ i +'][gender]" type="text">\
                </td>\
                <td>\
                    <input placeholder="hubungan" class="form-control" name="ipapprove['+ i +'][hubungan]" type="text">\
                </td>\
                <td>\
                    <input placeholder="pendidikan" class="form-control" name="ipapprove['+ i +'][pekerjaan]" type="text">\
                </td>\
                <td>\
                    <input placeholder="status" class="form-control" name="ipapprove['+ i +'][status]" type="text">\
                </td>\
                <td>\
                    <a class="dropdown-item" href="#" onclick="delRow('+ i +')"><i class="ni ni-fat-delete text-default"></i></a>\
                </td>\
            </tr>');
        };

        function delRow($id){  
            document.getElementById($id).style.display = 'none';
            
            var name = "ipapprove["+$id+"][flag]";
            document.getElementsByName(name)[0].value="False";
        }
        
    </script>

    <div class="container-fluid mt--7">
    @if($role=="superadmin")    
        <div class="card bg-secondary shadow">
            <div class="card">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">Tambah Keluarga</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" name="inputForm" action="{{ route('editKeluarga') }}" accept-charset="UTF-8">
                        @csrf
                        <input class="form-control" name="id-input" value="{{$keluarga_id}}" type="hidden">
                        <div class="form-group">
                            <label for="name-input" class="form-control-label">Nama Keluarga</label>
                            <input class="form-control" type="text" value="{{$nama}}" name="name-input" id="name-input">
                        </div>
                        <div class="form-group">
                            <label for="willayah-input" class="form-control-label">Willayah</label>
                            <select class="form-control" name="wilayah-input">
                                @if($wilayah == "Galatia")
                                    <option value="Galatia" selected>Galatia</option>
                                @else
                                    <option value="Galatia">Galatia</option>
                                @endif
                                @if($wilayah == "Efesus")
                                    <option value="Efesus" selected>Efesus</option>
                                @else
                                    <option value="Efesus">Efesus</option>
                                @endif
                                @if($wilayah == "Filipi")
                                    <option value="Filipi" selected>Filipi</option>
                                @else
                                    <option value="Filipi">Filipi</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_pbk-input" class="form-control-label">Jumlah PBK</label>
                            <input class="form-control" type="text" value="{{$jumlah_pbk}}" name="jumlah_pbk-input" id="jumlah_pbk-input">
                        </div>
                        <div class="form-group">
                            <label for="pbk_terakhir-input" class="form-control-label">PBK Terakhir</label>
                            <input class="form-control" type="text" value="{{$pbk_terakhir}}" name="pbk_terakhir-input" id="pbk_terakhir-input">
                        </div>
                        
                        <div class="form-group">
                            <div class="border-0" style="margin-bottom:5px">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <label for="Anggota-input" class="form-control-label">Anggota Keluarga</label> 
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="button" class="btn btn-sm btn-primary addRow" onclick ="addRow()">Tambah Anggota</button>
                                    </div>
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
                                        <th scope="col" class="text-center">Delete</th>
                                    </tr>
                                    </thead>
                                    
                                    <tbody class="list" id="ipapprove">
                                        @if(old('ipapprove')!="")
                                            <div id="countVar" data-count = "{{ count(old('ipapprove')) }}"></div>
                                            @foreach(old('ipapprove') as $key => $value)
                                                <tr data-id={{($key == 0)?$key+1:$key}} id={{$key}}>
                                                    <input class="form-control" name="ipapprove[{{$key}}][flag]" value="True" type="hidden">
                                                    <input class="form-control" name="ipapprove[{{$key}}][new]" value="New" type="hidden">
                                                    <td>
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][nama]" value="{{ old('ipapprove.'.$key.'.nama') }}" placeholder="nama" autofocus>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][gender]" value="{{ old('ipapprove.'.$key.'.gender') }}" placeholder="gender" autofocus>
                                                    </td>                                 
                                                    <td>
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][hubungan]" value="{{ old('ipapprove.'.$key.'.hubungan') }}" placeholder="hubungan" autofocus>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][pekerjaan]" value="{{ old('ipapprove.'.$key.'.pekerjaan') }}" placeholder="pekerjaan" autofocus>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][status]" value="{{ old('ipapprove.'.$key.'.status') }}" placeholder="status" autofocus> 
                                                    </td>                                 
                                                    <td>
                                                        <a class="dropdown-item" href="#" onclick="delRow({{$key}})"><i class="ni ni-fat-delete text-default"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        @foreach($anggotaByIdKeluarga as $anggota)
                                        <div id="countVar" data-count = "{{$y}}"></div>
                                            <tr data-id="{{$x}}" id="{{$x}}">
                                                <input class="form-control" name="ipapprove[{{$x}}][flag]" value="True" type="hidden">
                                                <input class="form-control" name="ipapprove[{{$x}}][new]" value="Old" type="hidden">
                                                <input class="form-control" name="ipapprove[{{$x}}][id]" value="{{$anggota->anggota_id}}" type="hidden">
                                                <td>
                                                    <input type="text" class="form-control" name="ipapprove[{{$x}}][nama]" placeholder="nam" autofocus value="{{$anggota->nama}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="ipapprove[{{$x}}][gender]" placeholder="gender" autofocus value="{{$anggota->gender}}"> 
                                                </td>                                 
                                                <td>
                                                    <input type="text" class="form-control" name="ipapprove[{{$x}}][hubungan]" placeholder="hubungan" autofocus value="{{$anggota->hubungan}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="ipapprove[{{$x}}][pekerjaan]" placeholder="pekerjaan" autofocus value="{{$anggota->pekerjaan}}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="ipapprove[{{$x}}][status]" placeholder="status" autofocus value="{{$anggota->status}}">
                                                </td>                                 
                                                <td>
                                                    <a class="dropdown-item" href="#" onclick="delRow({{$x}})"><i class="ni ni-fat-delete text-default"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                                $x=$x+1;
                                            @endphp
                                            @php
                                                $y=$y+1;
                                            @endphp
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if($role=="user")    
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <h3 class="mb-0">Keluarga Saya</h3>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="form-control-label">Nama Keluarga</label>
                        <br>
                        {{$nama}}
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Willayah</label>
                        <br>
                        {{$wilayah}}
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Jumlah PBK</label>
                        <br>
                        {{$jumlah_pbk}}
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">PBK Terakhir</label>
                        <br>
                        {{$pbk_m}} {{$pbk_d}}{{$pbk_ds}}, {{$pbk_y}}
                    </div>

                    <div class="form-group">
                        <div class="border-0" style="margin-bottom:5px">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <label for="Anggota-input" class="form-control-label">Anggota Keluarga</label> 
                                </div>
                                <!-- <div class="col-4 text-right">
                                    <button type="button" class="btn btn-sm btn-primary addRow" onclick ="addRow()">Tambah Anggota</button>
                                </div> -->
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
                                </tr>
                                </thead>
                                
                                <tbody class="list" id="ipapprove">
                                    @foreach($anggotaByIdKeluarga as $anggota)
                                        <tr>
                                            <td>
                                                {{$anggota->nama}}
                                            </td>
                                            <td>
                                            @if ( $anggota->gender== "L")
                                                Laki-Laki
                                            @else
                                                Perempuan
                                            @endif
                                            </td>                                 
                                            <td>
                                                {{$anggota->hubungan}}
                                            </td>
                                            <td>
                                                {{$anggota->pekerjaan}}
                                            </td>
                                            <td>
                                                {{$anggota->status}}
                                            </td>                                 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @include('layouts.footers.auth')




@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush



