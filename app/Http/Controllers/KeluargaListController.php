<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Keluarga;
use App\Models\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Auth;

class KeluargaListController extends Controller
{

    public function index(){

      $role = Auth::user()->role;

      $listKeluarga = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);


      return view('keluarga.list', compact('listKeluarga'), compact('role'));
    }

    public function search(Request $request){
      // Get the search value from the request
      $role = Auth::user()->role;

      $search = $request->input('search');

      // dd($search);
  
      // Search in the title and body columns from the posts table
      $listKeluarga = DB::table('anggota')
          ->where('nama', 'LIKE', "%{$search}%")
          ->orWhere('pekerjaan', 'LIKE', "%{$search}%")
          ->orWhere('status', 'LIKE', "%{$search}%")
          ->orWhere('hubungan', 'LIKE', "%{$search}%")
          ->paginate(15);
  
      // Return the search view with the resluts compacted
      return view('anggota.list', compact('listAnggota'), compact('role'));
    }

    public function delete($id){
      // Get the search value from the request
      $role = Auth::user()->role;

      // dd($id);

      DB::table('keluarga')->where('keluarga_id', '=', $id)->delete();
      DB::table('anggota')->where('keluarga_id', '=', $id)->delete();

      $listKeluarga = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);
      // Return the search view with the resluts compacted
      return view('keluarga.list', compact('listKeluarga'), compact('role'));
    }

}
