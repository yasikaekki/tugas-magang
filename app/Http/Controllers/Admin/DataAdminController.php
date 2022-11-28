<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Admin;
use App\UserStatusVerify;
use Auth;
use DB;
use Hash;
use Spatie\Activitylog\Models\Activity;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $pagename = "Data Admin";
        $judul = "Data Admin";
        $mencari = "Cari Data Admin";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $no = 1;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = DB::table('users')->where('role', 'admin')->orWhere('role', 'super admin')->orderBy('created_at','desc')->paginate(10);
        
        $aktivitas = Activity::all();
        
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('users')->where('name','like','%'.$request->hasil_cari.'%')->where('role', 'super admin')->Orwhere('name','like','%'.$request->hasil_cari.'%')->where('role', 'admin')->orderBy('created_at','desc')->where('deleted_at', null)
            ->paginate(10);
            $fitur_cari->appends($request->all());
        }

        if($request->sortname && in_array($request->sortname, ['asc', 'desc'])){
            // $fitur_cari = $user->orderBy('name', $request->sortname);
            $fitur_cari = DB::table('users')->whereNull('deleted_at')->where('role', 'admin')->orWhere('role', 'super admin')->orderBy('name', $request->sortname)
            ->paginate(10);
        }

        if($userrole == 'super admin'){
        return view('admin.data.admin.index', compact('userrole','mencari','nomor','keywoard','fitur_cari','useradmin', 'judul', 'user', 'no', 'notifikasi', 'pagename'));
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
        $judul = "Membuat Akun";
        $pagename = "Membuat akun admin";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = User::all()->where('role', $userrole);
        
        if($userrole == 'super admin'){
            return view('admin.data.admin.create', compact('useradmin', 'userrole', 'judul', 'user', 'nomor', 'notifikasi', 'pagename'));
        }else{
            return view('errors.404');
        }
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
        $this->validate($request, [
            'nama_admin'=> 'required',
            'email_admin'=> 'required|email|unique:users,email',
            'password'=> 'required|same:password_konfirmasi',
            'password_konfirmasi'=> 'required',
        ]);
        $userrole = Auth::user()->role;

        $user=new User();
        $user->name=$request->nama_admin;
        $user->email=$request->email_admin;
        $user->password=Hash::make($request->password);
        $user->role='admin';
        $user->created_at=\Carbon\Carbon::now();
        // $user->email_verified_at=\Carbon\Carbon::now();
        $user->save();

        $profil = new Admin;
        $profil->user_id = $user->id;
        $profil->save();

        $statusverif = new UserStatusVerify;
        $statusverif->user_id = $user->id;
        $statusverif->status = '1';
        $statusverif->save();

        activity()
            ->log('Akun admin ' . $user->name . ' berhasil dibuat');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'create';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();
        
        $userrole = Auth::user()->role;
        if($userrole == 'super admin'){
            return redirect()->route('data_admin.index')->with('sukses', 'akun admin berhasil dibuat');
        }else{
            return view('errors.404');
        }
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
        $judul = "Mengubah Akun";
        $pagename = "Mengubah akun admin";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $admin = User::find($id);
        $nomor = count($notifku);
        $user = User::all()->where('role', $userrole);

        if($userrole == 'super admin'){
            return view('admin.data.admin.edit', compact('useradmin', 'userrole', 'judul', 'admin', 'user', 'nomor', 'notifikasi', 'pagename'));
        }else{
            return view('errors.404');
        }
        
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
        $this->validate($request, [
            'nama_admin'=> 'required',
            // 'email_admin'=> 'required|email|unique:users,email',
            'password'=> 'required|same:passwordkonfirmasi',
        ]);

        $userrole = Auth::user()->role;
        $user = User::find($id);
        $user->name=$request->nama_admin;
        $user->email=$request->email_admin;
        $user->password=Hash::make($request->password);
        $user->updated_at=\Carbon\Carbon::now();
        // $user->email_verified_at=\Carbon\Carbon::now();
        $user->save();

        activity()
            ->log('Akun admin ' . $user->name . ' berhasil dibuat');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        $userrole = Auth::user()->role;
        if($userrole == 'super admin'){
            return redirect()->route('data_admin.index')->with('sukses', 'akun admin berhasil diperbarui');
        }else{
            return view('errors.404');
        }
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
        $user = User::find($id);
        $user->delete();

        activity()
            ->log('Akun admin ' . $user->name . ' berhasil dihapus');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'delete';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        $userrole = Auth::user()->role;
        // if($userrole == 'super admin'){
            return back()->with('hapus', 'Akun admin "'. $user->name .'" berhasil dihapus');
        // }else{
        //     return view('errors.404');
        // }
    }
}
