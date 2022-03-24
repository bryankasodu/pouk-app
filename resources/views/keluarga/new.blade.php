@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <script type="text/javascript">
        function addRow(){
            var i =  $('#ipapprove tr:last').data('id');
            i = i+1;
            $('#ipapprove').append('<tr data-id="'+ i +'" id="'+ i +'">\
                <input class="form-control" name="ipapprove['+ i +'][flag]" value="True" type="hidden">\
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
                    <input placeholder="pendidikan" class="form-control" name="ipapprove['+ i +'][pendidikan]" type="text">\
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
        <div class="card bg-secondary shadow">
            <div class="card">
                <form method="post" name="inputForm" action="{{ route('addKeluarga') }}" accept-charset="UTF-8">
                @csrf
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">Tambah Keluarga</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name-input" class="form-control-label">Nama Keluarga</label>
                            <input class="form-control" type="text" name="name-keluarga-input" placeholder="Nama Keluarga" id="name-input">
                        </div>
                        <div class="form-group">
                            <label for="willayah-input" class="form-control-label">Willayah</label>
                            <select class="form-control" name="wilayah-input">
                                <option value="Galatia">Galatia</option>
                                <option value="Efesus">Efesus</option>
                                <option value="Filipi">Filipi</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlah_pbk-input" class="form-control-label">Jumlah PBK</label>
                            <input class="form-control" type="text" name="jumlah_pbk-input" id="jumlah_pbk-input">
                        </div>
                        <div class="form-group">
                            <label for="pbk_terakhir-input" class="form-control-label">PBK Terakhir</label>
                            <input class="form-control" type="text" name="pbk_terakhir-input" id="pbk_terakhir-input">
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
                                                        <input type="text" class="form-control " name="ipapprove[{{$key}}][pendidikan]" value="{{ old('ipapprove.'.$key.'.pendidikan') }}" placeholder="pendidikan" autofocus>
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
                                        <div id="countVar" data-count = "0"></div>
                                        <tr data-id="1"  id="1">
                                            <input class="form-control" name="ipapprove[1][flag]" value="True" type="hidden">  
                                            <td>
                                                <input type="text" class="form-control" name="ipapprove[1][nama]" placeholder="nam" autofocus>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="ipapprove[1][gender]" placeholder="gender" autofocus> 
                                            </td>                                 
                                            <td>
                                                <input type="text" class="form-control" name="ipapprove[1][hubungan]" placeholder="hubungan" autofocus>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="ipapprove[1][pendidikan]" placeholder="pendidikan" autofocus>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="ipapprove[1][status]" placeholder="status" autofocus>
                                            </td>                                 
                                            <td>
                                                <a class="dropdown-item" href="#" onclick="delRow('1')"><i class="ni ni-fat-delete text-default"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth')




@endsection



<!-- @section('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    console.log("Hello world!");
    $('body').on('click', '.add', function() { 
        // i = $('#tab_logic tr').length; 
        var i =  $('#ipapprove tr:last').data('id');
        i = i+1;
        $('#ipapprove').append('<tr data-id="'+ i +'">\
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
                <input placeholder="pendidikan" class="form-control" name="ipapprove['+ i +'][pendidikan]" type="text">\
            </td>\
            <td>\
                <input placeholder="status" class="form-control" name="ipapprove['+ i +'][status]" type="text">\
            </td>\
            <td>\
                \
            </td>\
        </tr>');
        // i++;
    });
    // $('body').on('click', '.minus', function() {
    //     $(this).closest('tr').remove();
    //     // i--;
    // });
</script> -->
@endsection

