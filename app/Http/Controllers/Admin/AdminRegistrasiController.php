<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Model\Admin;
use App\User;
use Auth;
use DB;

class AdminRegistrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pagename = 'Biodata Admin';
        $judul = 'Biodata Admin';
        $mencari = 'Cari Biodata Admin';
        $no = 1;
        $authprofil=Auth::id();
        $userrole = Auth::user()->role;
        $useradmin = User::find($authprofil);
        $notifikasi = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $profil = DB::table('admins')->where('user_id', $authprofil)->select('nama_lengkap')->value('nama_lengkap');
        $user=Admin::all()->sortByDesc('created_at')->take(10);
        
        $foto_profil = DB::table('admins')->where('user_id', $authprofil)->select('ubah_foto')->value('ubah_foto');  
        $keywoard = $request->hasil_cari;
        if ($request->hasil_cari) {
            $fitur_cari = DB::table('admins')->where('nama_lengkap','like','%'.$request->hasil_cari.'%')
            ->paginate(10);
            $fitur_cari->appends($request->all());
            $hasil = DB::table('admins')->where('nama_lengkap','like','%'.$request->hasil_cari.'%')->get();
        }else{
            $hasil = DB::table('admins')->where('nama_lengkap','like','%'.$request->hasil_cari.'%')->get();
            $fitur_cari = DB::table('admins')->paginate(10);
        }


        return view('admin.registrasi.admin.index', compact('hasil', 'request', 'mencari','keywoard','fitur_cari','nomor','profil','no','useradmin','judul','pagename', 'user','foto_profil', 'notifikasi', 'userrole'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
