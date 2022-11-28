<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\User;
use App\Perusahaan;
use App\Model\Profil;
use App\Model\Post;
use Hash;
use DB;
use Auth;
use Spatie\Activitylog\Models\Activity;

class SettingPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('user.pengaturan.kata_sandi.edit');
        $judul = "Pengaturan";

        $uid = Auth::id();
        $notifikasi = Activity::all()->where('causer_id', $uid);
        $userauth = Auth::user()->role;
        if($userauth == 'admin' || $userauth == 'super admin'){
            $userrole = Auth::user()->role;
            return view('user.pengaturan.kata_sandi.edit', compact('judul', 'userrole'));
        }else if($userauth == 'user'){
            $foto_profil = DB::table('profils')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
            return view('user.pengaturan.kata_sandi.edit', compact('judul','foto_profil', 'notifikasi'));
        }else if($userauth == 'perusahaan'){
            
            $post = Post::all()->where('user_id', $authsandi);
            $foto_profil = DB::table('perusahaans')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
            return view('company.pengaturan.kata_sandi.index', compact('judul', 'post','foto_profil', 'notifikasi'));
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
        $authsandi = Auth::id();
        $user=User::find($authsandi);
        $cari = [
            'Cari Lowongan Magang Pemrograman Web',
            'Cari Lowongan Magang Design Grafis',
            'Cari Lowongan Magang Jaringan Komputer',
            'Cari Lowongan Magang Service Komputer',
            'Cari Lowongan Magang Seller',
            'Cari Lowongan Magang Digital Marketing',
            'Cari Lowongan Magang Pelayanan Masyarakat',
            'Cari Lowongan Magang Konten Kreator'
        ];

        $mencari = Arr::random($cari);
        $notifikasi = DB::table('activity_log')->where('causer_id', $authsandi)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $authsandi)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $userauth = Auth::user()->role;
        $judul = 'Pengaturan';
        if ($userauth == 'super admin') {
            return view('errors.404');
        }else if($userauth == 'admin'){
            $pagename = 'Password';
            $user = User::all();
            $useradmin = User::find($authsandi);
            $userrole = Auth::user()->role;
            return view('admin.pengaturan.kata_sandi.edit',compact('nomor','pagename','notifikasi','user','useradmin', 'judul', 'userrole'));
        }else if($userauth == 'user'){
            $userid = User::find($authsandi);
            return view('user.pengaturan.kata_sandi.edit', compact('nomor','user', 'authsandi', 'judul','userid','cari','mencari', 'notifikasi'));
        }else if($userauth == 'perusahaan'){
            
            $post = Post::all()->where('user_id', $authsandi);
            $userid = User::find($authsandi);
            return view('company.pengaturan.kata_sandi.edit', compact('nomor','authsandi', 'post','user', 'judul','userid','cari','mencari', 'notifikasi'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
        // $authsandi = Auth::id();
        // $user=User::find($authsandi);
        // if($request->txtpassword_user != null){
        //     $user->password=Hash::make($request->txtpassword_user);
        // }
        // $user->update();
        // // dd($request);
        
        // return redirect('/home/setting/email')->with('sukses', 'Kata sandi berhasil diupdate');

        // request()->validate([
        //     'password-lama' => 'required',
        //     'password' => ['required', 'string', 'min:1', 'confirmed']
        // ]);

        // $passwordbaru = auth()->user()->password;
        // $passwordlama = request('password-lama');

        // if(Hash::check($passwordlama, $passwordbaru)){
        //     auth()->user()->update([
        //         'password' => bcrypt(request('password')),
        //     ]);
        //     return back()->with('sukses', 'sukses pak!');
        // }else{
        //     return back()->withErrors(['passwordlama' => 'perbaiki, error pak!']);
        // }

        request()->validate([
            'password_lama' => 'required',
            'password' => ['required', 'string', 'min:1', 'confirmed']
        ]);

        $passwordbaru = auth()->user()->password;
        $password_lama = request('password_lama');

        if(Hash::check($password_lama, $passwordbaru)){
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);

            activity()
            ->log('Kata sandi berhasil diperbaruhi');
            $lastActivity = Activity::all()->last();
            $lastActivity->name = Auth::user()->name;
            $lastActivity->log_name = 'update';
            $lastActivity->role = Auth::user()->role;
            $lastActivity->description;
            $lastActivity->save();

            return back()->with('sukses', 'sukses mengganti kata sandi baru');
        }else{
            return back()->with('gagal', 'kata sandi lama salah, silahkan coba lagi');
        }


        // dd('sd');
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
