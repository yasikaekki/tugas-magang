<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\User;
use Auth;
Use DB;

class AdminAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Aktivitas Admin";
        $mencari = "Cari Aktivitas";
        
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $no = 1;
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $notif = DB::table('activity_log')->orderBy('created_at','desc')->where('role', 'admin')->paginate(10);

        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('activity_log')->orderBy('created_at','desc')->where('description','like','%'.$request->hasil_cari.'%')->where('role', 'admin')->orWhere('name','like','%'.$request->hasil_cari.'%')->where('role', 'admin')          
            ->paginate(10);
            $fitur_cari->appends($request->all());
        }

        $pagename = 'Aktivitas Admin';
        $foto_profil = DB::table('profils')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
        

        return view('admin.aktivitas.admin.index', compact('nomor','notif','useradmin','pagename','keywoard','fitur_cari','judul', 'mencari', 'notifikasi','foto_profil', 'no', 'userrole'));
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
