<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\User;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pagename = "Dashboard Admin";
        $judul = "Dashboard Admin";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = DB::table('users')->whereNull('deleted_at')->where('role', 'admin')->orWhere('role', 'super admin')->get();
        $biodata = Admin::all();
        $aktivitas = DB::table('activity_log')->where('role', 'admin')->get();
        $jumlahadmin = count($user);
        $jumlahbiodata = count($biodata);
        $jumlahaktivitas = count($aktivitas);
        $profil = DB::table('admins')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');

        $chart = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->where('role', 'admin')
                    ->orWhere('role', 'super admin')
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
        $chartactivity = Activity::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
          
        // return view('chart', compact('users'));

        if($userrole == 'super admin'){
            return view('admin.dashboard.admin.index', compact('profil','nomor','jumlahadmin','jumlahbiodata','jumlahaktivitas','useradmin', 'judul', 'user', 'notifikasi', 'pagename', 'chart', 'chartactivity'));
        }else{
            return view('errors.404');
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
