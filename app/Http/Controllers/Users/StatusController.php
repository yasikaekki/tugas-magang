<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Spatie\Activitylog\Models\Activity;
use DB;
use App\User;
use App\Perusahaan;
use App\Model\Post;
use App\Model\Profil;
use App\Model\Lamaran;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $no = 1;
        $mencari = "Cari Lowongan Anda";
        $uid = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $judul = "Status Lowongan";
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('posts')->where('user_id', $uid)->orderBy('created_at','desc')->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
            ->paginate(5);
            $fitur_cari->appends($request->all());
        }

        $userauth = Auth::user()->role;
        if($userauth == 'admin' || $userauth == 'super admin'){
            
        }else if($userauth == 'user'){
            $mencari = "Cari Status Riwayat Lamaran Anda";
            if ($request) {
                $fitur_cari = DB::table('lamarans')->where('profil_id', $uid)->orderBy('created_at','desc')->where('nama_lowongan','like','%'.$request->hasil_cari.'%')
                ->paginate(9);
                $fitur_cari->appends($request->all());
            }
            $lamaran = DB::table('lamarans')->where('profil_id', $uid)->orderBy('created_at','desc')->paginate(9);
            $postingan = Post::find(2);
            $userid = User::find($uid);
            $data = Lamaran::all();

            return view('user.status.lamaran.index', compact('nomor', 'data','judul', 'keywoard', 'fitur_cari','userid','notifikasi', 'mencari', 'lamaran', 'postingan'));
        }else if($userauth == 'perusahaan'){
            $post = DB::table('posts')->where('user_id', $uid)->orderBy('created_at','desc')->paginate(5);
            $userid = User::find($uid);
            $masaberakhir = DB::table('posts')->where('user_id', $uid)->select('masa_berakhir')->value('masa_berakhir');
            
            

            // $dapats = $a + $b;

            // $data = array();
            // foreach($postingan as $dapat){
            //     $data = $dapat->masa_barakhir;
            // }
                


            // $dapats = kalender($postingan);
            // $dapats = kalender(1, 2);
            $no = 1;
            $settanggal = date_create($masaberakhir);
            $setformat = date_format($settanggal, "d-m-Y");
            $setbuat = date_create();
            $diff = date_diff($settanggal , $setbuat);
            return view('company.status.index', compact('nomor','no','keywoard','fitur_cari','judul', 'notifikasi', 'userid', 'mencari', 'post', 'diff', 'setformat', 'masaberakhir', 'no'));
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
    public function show(Request $request ,$id)
    {
        //
        $judul = 'Status Pelamar';
        $mencari = 'Cari Nama Calon Pelamar';
        $lamaran = Lamaran::all()->where('post_id', $id);
        // $pagetitle = $lamaran->select('')
        $postingan = Post::find($id);
        $userauth = Auth::user()->role;
        $uid = Auth::user()->id;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = DB::table('lamarans')->where('post_id', $uid)->orderBy('created_at','desc')->where('nama','like','%'.$request->hasil_cari.'%')
            ->paginate(5);
            $fitur_cari->appends($request->all());
        }

        if($userauth == 'admin' || $userauth == 'super admin'){
           
        }else if($userauth == 'user'){

            // $post = DB::table('posts')->paginate(2);
            // $foto_profil = DB::table('profils')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
           
            
            // return view('user.dashboard', compact('keywoard','fitur_cari','mencari', 'judul', 'post', 'perusahaan','foto_profil','notifikasi'));
        }else if($userauth == 'perusahaan'){
            $settanggal = date_create($postingan->masa_berakhir);
            $settanggal1 = date_create($postingan->masa_berakhir);
            $setformat = date_format($settanggal, "d-m-Y");
            $setformat2 = date_format($settanggal1, "m-d-Y");
            $setbuat = date_create();
            $diff = date_diff($settanggal , $setbuat);
            $no = 1;
            $pelamar = DB::table('posts')->where('user_id', $uid)->where('id', $id)->select('pelamar')->value('pelamar');
            $linkpelamar = DB::table('posts')->where('user_id', $uid)->where('id', $id)->select('id')->value('id');
            
            $userid = User::find($uid);
            // $profil = Profil::all()-where('user_id', $id);
            
            return view('company.status.show', compact('nomor','judul', 'keywoard','fitur_cari','userid','notifikasi','mencari', 'lamaran', 'postingan', 'diff', 'setformat2', 'no', 'pelamar', 'linkpelamar'));
        }else{
            return view('errors.404');
        }


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

        $ditolak = "ditolak";
        $diterima = "diterima";
        $uid = Auth::id();
        $post = Lamaran::find($id);
        $post->status_lamaran = $diterima;
        $post->save();
        // $post->user_id = Auth::user()->id;
        // $post->judul_pekerjaan=$request->get('judul_pekerjaan');
        // $post->bidang_pekerjaan=$request->get('bidang_pekerjaan');
        // $post->employee=$request->get('employee');
        // $post->deskripsi_pekerjaan=$request->get('deskripsi_pekerjaan');
        // $post->persyaratan=$request->get('persyaratan');
        // $post->masa_berakhir=$request->get('masa_berakhir');
        
        // $post->save();
        activity()
            ->log('Anda telah menerima lamaran');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        // dd($post);
        return redirect('home/status/lamaran')->with('sukses','Berhasil menerima lamaran');
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
        $uid = Auth::id();
        $notifikasi = Activity::all()->where('causer_id', $uid);
        $post = Post::find($id);
        $namapost = Post::find($id)->judul_pekerjaan;
        $post->delete();

        // activity()
        //     ->log('Anda telah menghapus status postingan');
        // $lastActivity = Activity::all()->last();
        // $lastActivity->description;

        activity()
        ->log('Anda telah menghapus status postingan');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'delete';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect('home/status')->with('sukses', 'Status Lowongan "'. $namapost .'" berhasil dihapus', 'notifikasi');
    }

    public function diterima(Request $request, $id)
    {
        $diterima = "diterima";
        $uid = Auth::id();
        $post = Lamaran::find($id);
        $post->status_lamaran = $diterima;
        $post->save();
        // $user = $post->profil_id;
        // $userid = Profil::where('id', $user);
        // $username = User::where('id', $userid->user_id);

        activity()
        ->log('Lamaran'. $post->post->judul_pekerjaan .'anda telah diterima');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = $post->profil->user->name;
        $lastActivity->log_name = 'accept';
        $lastActivity->role = $post->profil->user->role;
        $lastActivity->description;
        $lastActivity->save();
        
        activity()
        ->log('Anda telah menerima lamaran');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'accept';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return back()->with('sukses','Berhasil menerima lamaran');
    }

    public function ditolak(Request $request, $id)
    {
        $ditolak = "ditolak";
        $uid = Auth::id();
        $post = Lamaran::find($id);
        $post->status_lamaran = $ditolak;
        $post->save();

        activity()
        ->log('Anda telah menolak lamaran');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'reject';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return back()->with('sukses','Berhasil menolak lamaran');
    }
    public function read($id)
    {
        
        $uid = Auth::id();
        // $lamaran = DB::table('lamarans')->where('post_id', $id)->select('profil_id')->value('profil_id');
        // $lamaran = Lamaran::all()->where('post_id', $id)->select('profil_id')->value('profil_id');
        // $lamaran = Lamaran::all()->where('post_id', $id);
        $lamaran = Lamaran::find($id);
        $judul = Lamaran::find($id)->nama;
        $foto_profil = DB::table('perusahaans')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
        $notifikasi = DB::table('activity_log')->orderBy('created_at','desc')->where('causer_id', $uid)->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $post = Post::all();
        $userid = User::find($uid);
        // $users = Profil::all()->where('id', $lamaran->profil_id);
        // $users = DB::table('profils')->where('id', 3)->get();
        $users = Profil::find($lamaran->profil_id);
        
        // $user = Profil::all()->where('user_id', $lamaran);
        return view('company.profiles.show', compact('nomor','judul', 'lamaran', 'notifikasi', 'userid', 'users', 'lamaran'));
        dd($post);
    }

}
