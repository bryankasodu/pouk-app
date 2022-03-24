<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AnggotaEditController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function superadmin($id)
    {
        
        $role = Auth::user()->role;

        $keluargaList = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);

        $anggotaById = DB::table('anggota')
        ->join('keluarga','anggota.keluarga_id','=','keluarga.keluarga_id')
        ->select('anggota.*','keluarga.nama as nama_keluarga')
        ->where('anggota.anggota_id', $id)
        ->get();
        
        // dd($anggotaById);
       
        return view('anggota.edit', compact('keluargaList','anggotaById'), compact('role'));
    }

    public function user()
    {
        
        $role = Auth::user()->role;
        $id = Auth::user()->anggota_id;

        $keluargaList = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);

        $anggotaById = DB::table('anggota')
        ->join('keluarga','anggota.keluarga_id','=','keluarga.keluarga_id')
        ->select('anggota.*','keluarga.nama as nama_keluarga')
        ->where('anggota.anggota_id', $id)
        ->get();
        
        // dd($anggotaById);
       
        return view('anggota.edit', compact('keluargaList','anggotaById'), compact('role'));
    }

    public function edit(Request $request) 
    {
        // dd("1");

        $role = Auth::user()->role;
        
        // dd($request->all());

        $anggota_id = $request->input('id-input');
        $name = $request->input('name-input');
        $keluarga = $request->input('keluarga-input');
        $tempatLahir = $request->input('tempat_lahir-input');
        $tanggalLahir = date('Y-m-d', strtotime($request->input('tanggal_lahir-input')));
        $alamat1 = $request->input('alamat1-input');
        $alamat2 = $request->input('alamat2-input');
        $telpon1 = $request->input('telpon1-input');
        $telpon2 = $request->input('telpon2-input');
        $gender = $request->input('gender-input');
        $hubungan = $request->input('hubungan-input');
        $pekerjaan = $request->input('pekerjaan-input');
        $status = $request->input('status-input');
        
        $tempatBaptis = $request->input('tempat_baptis-input');
        $tanggalBaptis = date('Y-m-d', strtotime($request->input('tanggal_baptis-input')));
        $tempatSidi = $request->input('tempat_sidi-input');
        $tanggalSidi = date('Y-m-d', strtotime($request->input('tanggal_sidi-input')));
        $tempatMenikah = $request->input('tempat_nikah-input');
        $tanggalMenikah = date('Y-m-d', strtotime($request->input('tanggal_nikah-input')));
        $gerejaAsal = $request->input('gereja_asal-input');
        $gerejaTerdaftar = $request->input('gereja_terdaftar-input');
        
        // dd(gettype($status));
        
        // dd( $anggota_id);

        DB::table('anggota')
        ->where('anggota_id', $anggota_id)
        ->update([
            'nama' => $name, 
            'keluarga_id' => $keluarga, 
            'tempat_lahir' => $tempatLahir , 
            'tanggal_lahir' => $tanggalLahir, 
            'alamat1' => $alamat1, 
            'alamat2' => $alamat2, 
            'telpon_rumah' => $telpon1,
            'telpon_hp' => $telpon2, 
            'gender' => $gender, 
            'hubungan' => $hubungan,
            'pekerjaan' => $pekerjaan,
            'status' => $status,

            'tempat_baptis' => $tempatBaptis,
            'tanggal_baptis' => $tanggalBaptis,
            'tempat_sidi' => $tempatSidi,
            'tanggal_sidi' => $tanggalSidi,
            'tempat_nikah' => $tempatMenikah,
            'tanggal_nikah' => $tanggalMenikah,
            'gereja_asal' => $gerejaAsal,
            'gereja_terdaftar' => $gerejaTerdaftar
        ]);
        // dd("Test");
        $type = "good";
        $mesages = "Data Sucsesfully Added";

        $sent=array();
        array_push($sent, $type, $mesages);
        

        // dd($sent);

        return back()->with(['arr2' => $sent]);
    }
}
