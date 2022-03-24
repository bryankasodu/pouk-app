<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class KeluargaNewController extends Controller
{

    public function index(){

        $role = Auth::user()->role;

        $keluargaList = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);

        return view('keluarga.new', compact('keluargaList'), compact('role'));
    }

    public function add(Request $request) 
    {
        $role = Auth::user()->role;
        
        dd($request->all());

        $name = $request->input('name-keluarga-input');
        $wilayah = $request->input('wilayah-input');
        $jumlah_pbk = $request->input('jumlah_pbk-input');
        $pbk_terakhir = $request->input('pbk_terakhir-input');
        $anggotaList = $request->input('ipapprove');
        
        foreach ($anggotaList as $anggota){
            if($anggota["flag"]=="True"){
                DB::table('anggota')->insertOrIgnore([
                    ['nama' => $anggota["nama"], 
                    'gender' => $anggota["gender"],
                    'hubungan' => $anggota["hubungan"],
                    'pekerjaan' => $anggota["pendidikan"],
                    'status' => $anggota["status"]]
                ]);
            }

            if(strcasecmp($anggota["hubungan"],"kepala")==0){
                $kepala=$anggota["nama"];
                $id_kepala = DB::table('anggota')->where('nama', $kepala)->value('anggota_id');
            }
        }

        DB::table('keluarga')->insertOrIgnore([
            ['nama' => $name, 
            'wilayah' => $wilayah, 
            'jumlah_pbk' => $jumlah_pbk, 
            'pbk_terakhir' => $pbk_terakhir, 
            'id_kepala' => $id_kepala]
        ]);

        $id_keluarga = DB::table('keluarga')->where('nama', $name)->value('keluarga_id');

        foreach ($anggotaList as $anggota){
            DB::table('anggota')
                ->where('nama', $anggota["nama"])
                ->update(['keluarga_id' => $id_keluarga]);
        }
        // dd($request->all());
        
        // dd("Test");
        $type = "good";
        $mesages = "Data Sucsesfully Added";

        $sent=array();
        array_push($sent, $type, $mesages);
        

        // dd($sent);

        return back()->with(['arr2' => $sent]);
    }
}
