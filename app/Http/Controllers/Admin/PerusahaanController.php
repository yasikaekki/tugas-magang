<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Perusahaan;
use App\Model\Post;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Dashboard Perusahaan";
        $pagename = "Dashboard Perusahaan";
        $uid = Auth::user()->id;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $profil = DB::table('admins')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
        $user = DB::table('users')->where('deleted_at', null)->where('role', 'perusahaan')->get();

        $biodata = Perusahaan::all();
        $aktivitas = Activity::all()->where('role', 'perusahaan');
        $lowongan = Post::all();
        $jumlahperusahaan = count($user);
        $jumlahbiodata = count($biodata);
        $jumlahaktivitas = count($aktivitas);
        $jumlahlowongan = count($lowongan);

        $chart = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->where('role', 'perusahaan')
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $chartactivity = Activity::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.dashboard.perusahaan.index', compact('profil','jumlahlowongan','jumlahperusahaan','jumlahbiodata','jumlahaktivitas','judul', 'notifikasi', 'useradmin', 'user', 'pagename', 'userrole', 'nomor', 'chart', 'chartactivity'));

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
