<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserStatusVerify;
use App\Model\Admin;
use App\Model\Profil;
use Auth;
use DB;
use Hash;
use Spatie\Activitylog\Models\Activity;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Data User";
        $pagename = "Data User";
        $mencari = "Cari Data User";
        $uid = Auth::user()->id;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        // $user = User::all()->where('role','user');
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $no = 1;
        $user = DB::table('users')->where('role', 'user')->orderBy('created_at','desc')->where('deleted_at', null)
            ->paginate(10);
        // $fitur_cari = DB::table('users')->where('deleted_at', null)->where('role', 'user')->orderBy('created_at','desc')
        //     ->paginate(10);
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('users')->where('name','like','%'.$request->hasil_cari.'%')->where('role', 'user')->orderBy('created_at','desc')->where('deleted_at', null)
            ->paginate(10);
            $fitur_cari->appends($request->all());
        }

        if($request->verified){
            $fitur_cari = DB::table('users')
            ->where('deleted_at', null)
            ->where('email_verified_at', $request->verified, null)
            ->where('role', 'user')
            // ->orderBy('name', $request->sortname)
            ->paginate(10);
        }

        // if($request->sortname && in_array($request->sortname, ['asc', 'desc'])){
        //     // $fitur_cari = $user->orderBy('name', $request->sortname);
        //     $fitur_cari = DB::table('users')->where('deleted_at', null)->where('role', 'user')->orderBy('name', $request->sortname)
        //     ->paginate(10);
        // }

        if($request->sortname && in_array($request->sortname, ['asc', 'desc'])){
            // $fitur_cari = $user->orderBy('name', $request->sortname);
            $fitur_cari = DB::table('users')->where('deleted_at', null)->where('role', 'user')->orderBy('name', $request->sortname)
            ->paginate(10);
        }

        return view('admin.data.user.index', compact('request', 'mencari','no','nomor','keywoard','fitur_cari','judul', 'notifikasi', 'useradmin', 'user', 'pagename', 'userrole'));
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
        $pagename = "Membuat akun user";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $tes = Profil::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = User::all()->where('role', $userrole);
        return view('admin.data.user.create', compact('nomor', 'tes', 'useradmin', 'judul', 'user', 'notifikasi', 'pagename', 'userrole'));
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
            'nama_user'=> 'required',
            // 'email_user'=> 'required|email|unique:users,email',
            'password'=> 'required|same:passwordkonfirmasi',
        ]);
        $userrole = Auth::user()->role;

        $user=new User();
        $user->name=$request->nama_user;
        $user->email=$request->email_user;
        $user->password=Hash::make($request->password);
        $user->role='user';
        $user->created_at=\Carbon\Carbon::now();
        // $user->email_verified_at=\Carbon\Carbon::now();
        $user->save();

        $statusverif = new UserStatusVerify;
        $statusverif->status = '1';
        $statusverif->save();

        $profil = new Profil;
        $profil->user_id = $user->id;
        $profil->user_id = $user->id;
        $profil->save();
        

        activity()
            ->log('Akun user ' . $user->name . ' berhasil dibuat');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'create';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();
        
        return redirect()->route('data_user.index')->with('sukses', 'akun user berhasil dibuat');
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
        $pagename = "Mengubah akun user";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $user = User::find($id);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        

        return view('admin.data.user.edit', compact('useradmin', 'judul', 'user', 'nomor', 'notifikasi', 'pagename', 'userrole'));
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
            'nama_user'=> 'required',
            // 'email_user'=> 'required|email|unique:users,email',
            'password'=> 'required|same:passwordkonfirmasi',
        ]);

        $userrole = Auth::user()->role;
        $user = User::find($id);
        $user->name=$request->nama_user;
        $user->email=$request->email_user;
        $user->password=Hash::make($request->password);
        $user->updated_at=\Carbon\Carbon::now();
        // $user->email_verified_at=\Carbon\Carbon::now();
        $user->save();

        activity()
            ->log('Akun user ' . $user->name . ' berhasil diperbarui');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect()->route('data_user.index')->with('sukses', 'akun user berhasil diperbarui');
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
            ->log('Akun user ' . $user->name . ' berhasil dihapus');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'delete';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return back()->with('hapus', 'User "'. $user->name .'" berhasil dihapus');
    }
}
