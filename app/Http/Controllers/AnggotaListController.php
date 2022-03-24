<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Anggota;
use Auth;
use Illuminate\Support\Facades\DB;

class AnggotaListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    // public function index()
    // {
    //     return view('dashboard');
    // }



    public function index(){
      // console.log("TEST");
      $role = Auth::user()->role;
      $listAnggota = Anggota::paginate(15);
      
      return view('anggota.list', compact('listAnggota'), compact('role'));
    }

    public function search(Request $request){
      // Get the search value from the request
      $role = Auth::user()->role;

      $search = $request->input('search');

      // dd($search);
  
      // Search in the title and body columns from the posts table
      $listAnggota = DB::table('anggota')
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

      DB::table('anggota')->where('anggota_id', '=', $id)->delete();

      $listAnggota = Anggota::paginate(15);
      // Return the search view with the resluts compacted
      return view('anggota.list', compact('listAnggota'), compact('role'));
    }

}
