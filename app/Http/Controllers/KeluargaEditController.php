<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class KeluargaEditController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function superadmin($id)
    {
        $role = Auth::user()->role;

        $keluargaById = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->where('keluarga.keluarga_id', $id)
        ->paginate(15);

        // dd($keluargaById);   

        $anggotaByIdKeluarga = DB::table('anggota')
        ->join('keluarga','anggota.keluarga_id','=','keluarga.keluarga_id')
        ->select('anggota.*','keluarga.nama as nama_keluarga')
        ->where('anggota.keluarga_id', $id)
        ->get();
        
        // dd($anggotaByIdKeluarga);

        return view('keluarga.edit', compact('keluargaById','anggotaByIdKeluarga'), compact('role'));
    }

    public function user()
    {
        $role = Auth::user()->role;
        $user_id = Auth::user()->anggota_id;
        
        $keluarga_id=DB::table('anggota')
        ->select('keluarga_id')
        ->where('anggota_id', $user_id)
        ->get();
        
        $id=$keluarga_id[0]->keluarga_id;
        // dd($id);

        $keluargaById = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->where('keluarga.keluarga_id', $id)
        ->paginate(15);

        // dd($keluargaById);   

        $anggotaByIdKeluarga = DB::table('anggota')
        ->join('keluarga','anggota.keluarga_id','=','keluarga.keluarga_id')
        ->select('anggota.*','keluarga.nama as nama_keluarga')
        ->where('anggota.keluarga_id', $id)
        ->get();
        
        // dd($anggotaByIdKeluarga);

        return view('keluarga.edit', compact('keluargaById','anggotaByIdKeluarga'), compact('role'));
    }

    public function edit(Request $request) 
    {
        // dd("1");

        $role = Auth::user()->role;
        
        // dd($request->all());

        $keluarga_id = $request->input('id-input');
        $name = $request->input('name-input');
        $wilayah = $request->input('wilayah-input');
        $jumlah_pbk = $request->input('jumlah_pbk-input');
        $pbk_terakhir = date('Y-m-d', strtotime($request->input('pbk_terakhir-input')));
        $anggotaList = $request->input('ipapprove');
        
        
        foreach ($anggotaList as $anggota){
            if($anggota["flag"]=="True"){
                if($anggota["new"]=="Old"){
                    DB::table('anggota')
                        ->where('anggota_id', $anggota["id"])
                        ->update([
                        'nama' => $anggota["nama"], 
                        'gender' => $anggota["gender"],
                        'hubungan' => $anggota["hubungan"],
                        'pekerjaan' => $anggota["pekerjaan"],
                        'status' => $anggota["status"]
                    ]);
                }
                else{
                    DB::table('anggota')->insertOrIgnore([
                        ['nama' => $anggota["nama"], 
                        'gender' => $anggota["gender"],
                        'hubungan' => $anggota["hubungan"],
                        'pekerjaan' => $anggota["pekerjaan"],
                        'status' => $anggota["status"]]
                    ]);
                }
            }
            else{
                if($anggota["new"]=="Old"){
                    $id_deleted = DB::table('anggota')->where('nama', $anggota["nama"])->value('anggota_id');
                    DB::table('anggota')
                        ->where('anggota_id', $id_deleted)
                        ->delete();
                }
            }

            if(strcasecmp($anggota["hubungan"],"kepala")==0){
                $kepala=$anggota["nama"];
                $id_kepala = DB::table('anggota')->where('nama', $kepala)->value('anggota_id');
            }
        }
        // dd(gettype($status));
        
        // dd( $name);

        DB::table('keluarga')
        ->where('keluarga_id', $keluarga_id)
        ->update([
            'nama' => $name, 
            'wilayah' => $wilayah, 
            'jumlah_pbk' => $jumlah_pbk, 
            'pbk_terakhir' => $pbk_terakhir, 
            'id_kepala' => $id_kepala
        ]);

        $id_keluarga = DB::table('keluarga')->where('nama', $name)->value('keluarga_id');

        foreach ($anggotaList as $anggota){
            DB::table('anggota')
                ->where('nama', $anggota["nama"])
                ->update(['keluarga_id' => $id_keluarga]);
        }

        // dd("Test");
        $type = "good";
        $mesages = "Data Sucsesfully Added";

        $sent=array();
        array_push($sent, $type, $mesages);
        

        // dd($sent);

        return back()->with(['arr2' => $sent]);
    }
}
