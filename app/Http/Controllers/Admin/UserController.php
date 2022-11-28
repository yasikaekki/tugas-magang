<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Profil;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Dashboard User";
        $pagename = "Dashboard User";
        $uid = Auth::user()->id;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $user = User::all()->where('role','user');
        $biodata = Profil::all();
        $aktivitas = Activity::all()->where('role', 'user');
        $jumlahuser = count($user);
        $jumlahbiodata = count($biodata);
        $jumlahaktivitas = count($aktivitas);
        $profil = DB::table('admins')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
        $chart = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->where('role', 'user')
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $chartactivity = Activity::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->where('role', 'user')
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('admin.dashboard.user.index', compact('profil','nomor','jumlahuser','jumlahbiodata','jumlahaktivitas','judul', 'notifikasi', 'useradmin', 'user', 'pagename', 'userrole', 'chart', 'chartactivity'));
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
