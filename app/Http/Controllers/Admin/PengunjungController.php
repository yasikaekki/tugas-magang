<?php

namespace App\Http\Controllers\Admin;

use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Perusahaan;
use App\User;
use Auth;
use DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pagename = "Pengunjung";
        $judul = "Pengunjung";
        $mencari = "Cari Data Pengunjung";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $no = 1;
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = DB::table('users')->where('role', 'user')->orWhere('role', 'perusahaan')->paginate(10);
        $profil = DB::table('admins')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('users')->where('name','like','%'.$request->hasil_cari.'%')->where('role', 'user')->orWhere('name','like','%'.$request->hasil_cari.'%')->where('role', 'perusahaan')
            ->paginate(10);
            $fitur_cari->appends($request->all());
        }

        return view('admin.pengunjung.index', compact('profil','mencari','userrole','nomor','keywoard','fitur_cari','pagename','useradmin', 'judul', 'user', 'no', 'notifikasi'));
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
