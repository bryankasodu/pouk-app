<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;    
use App\Imports\AnggotaImport;
use Illuminate\Support\Facades\DB;
use Auth;

class AnggotaNewController extends Controller
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
    public function index()
    {
        $role = Auth::user()->role;

        $keluargaList = DB::table('keluarga')
        ->join('anggota','id_kepala','=','anggota.anggota_id')
        ->select('keluarga.*','anggota.nama as nama_kepala')
        ->paginate(15);

        // $log = (string) $keluargaList;
        // Log::info($log);
        

        return view('anggota.new', compact('keluargaList'), compact('role'));
    }

    public function fileImport(Request $request) 
    {
        $role = Auth::user()->role;
        // dd($request);
        $anggotaList = Excel::toArray(new AnggotaImport, $request->file('file')->store('temp'));
        // Excel::import(new AnggotaImport, $request->file('file')->store('temp'));

        // dd($anggotaList);

        return back()->with(['arr' => $anggotaList]);
    }

    public function add(Request $request) 
    {
        // dd($request->all());

        $role = Auth::user()->role;
        
        // dd("1");
        
        $name = $request->input('name-input');
        $keluarga = $request->input('keluarga-input');
        $tempatLahir = $request->input('tempat_lahir-input');
        $tanggalLahir = $request->input('tanggal_lahir-input');
        $alamat1 = $request->input('alamat1-input');
        $alamat2 = $request->input('alamat2-input');
        $telpon1 = $request->input('telpon1-input');
        $telpon2 = $request->input('telpon2-input');
        $gender = $request->input('gender-input');
        $hubungan = $request->input('hubungan-input');
        $pekerjaan = $request->input('pekerjaan-input');
        $status = $request->input('status-input');
        
        $tempatBaptis = $request->input('tempat_baptis-input');
        $tanggalBaptis = $request->input('tanggal_baptis-input');
        $tempatSidi = $request->input('tempat_sidi-input');
        $tanggalSidi = $request->input('tanggal_sidi-input');
        $tempatMenikah = $request->input('tempat_nikah-input');
        $tanggalMenikah = $request->input('tanggal_nikah-input');
        $gerejaAsal = $request->input('gereja_asal-input');
        $gerejaTerdaftar = $request->input('gereja_terdaftar-input');
        
        // dd(gettype($status));
        
        DB::table('anggota')->insertOrIgnore([
            ['nama' => $name, 
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
            'gereja_terdaftar' => $gerejaTerdaftar]
        ]);
        // dd("Test");
        $type = "good";
        $mesages = "Data Sucsesfully Added";

        $sent=array();
        array_push($sent, $type, $mesages);
        

        // dd($sent);

        return back()->with(['arr2' => $sent]);
    }

    public function addBulk(Request $request) 
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
