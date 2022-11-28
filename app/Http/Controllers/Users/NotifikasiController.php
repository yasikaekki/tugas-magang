<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Model\Post;
use App\User;
use Spatie\Activitylog\Models\Activity;
use Auth;
use DB;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Notifikasi";
        $mencari = "Cari Notifikasi";
        
        $uid = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);

        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('activity_log')->where('causer_id',$uid)->orderBy('created_at','desc')->where('description','like','%'.$request->hasil_cari.'%')          
            ->paginate(5);
            $fitur_cari->appends($request->all());
        }

        $userauth = Auth::user()->role;
        if ($userauth == 'admin' || $userauth == 'super admin') {
            $judul = "Notifikasi";
            $pagename = 'Notifikasi';
            $user = User::all()->where('role', 'perusahaan');
            $userrole = Auth::user()->role;
            $useradmin = User::find($uid);
           
            return view('admin.notifikasi.index', compact('userrole','nomor','pagename','useradmin','fitur_cari','keywoard','mencari','user','judul', 'notifikasi'));
        } elseif ($userauth == 'user') {
            
            $userid = User::find($uid);
        

            return view('user.notifikasi.index', compact('keywoard','fitur_cari','judul', 'mencari', 'notifikasi','userid', 'nomor'));

        } elseif ($userauth == 'perusahaan') {

            $userid = User::find($uid);
            $post = Post::all()->where('user_id', $uid);

            return view('company.notifikasi.index', compact('nomor','keywoard','fitur_cari','judul', 'post','mencari', 'notifikasi','userid'));
        }

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
