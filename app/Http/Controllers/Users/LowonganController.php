<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;
use App\User;
use App\Model\Lamaran;
use App\Model\Post;
use App\Model\Profil;
use DB;
use App\Perusahaan;
use App\BidangPekerjaan;
use Spatie\Activitylog\Models\Activity;

class LowonganController extends Controller
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
        $mencari = "Cari Postingan Lowongan Magang";
        $uid = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $judul = "Postingan Lowongan Magang";
        $pagename = "Postingan Lowongan Magang";
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $userrole = Auth::user()->role;

        $keywoard = $request->hasil_cari;
        $useradmin = User::find($uid);
        if ($request) {
            $fitur_cari = DB::table('posts')->orderBy('created_at','desc')->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
            ->paginate(5);
            $fitur_cari->appends($request->all());
        }
        $post = DB::table('posts')->orderBy('created_at','desc')->paginate(5);
        $foto_profil = DB::table('perusahaans')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
        $masaberakhir = DB::table('posts')->where('user_id', $uid)->select('masa_berakhir')->value('masa_berakhir');
        $no = 1;

        return view('admin.lowongan.index', compact('nomor','no','useradmin','pagename','keywoard','fitur_cari','judul', 'notifikasi', 'foto_profil', 'mencari', 'post', 'masaberakhir', 'no', 'userrole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $judul = 'Buat Postingan Lowongan Magang';
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
        
        $userauth = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $userauth)->orderBy('created_at','desc')->paginate(5);
        $userid = DB::table('perusahaans')->select('id')->value('id');
        $notifku = DB::table('activity_log')->where('causer_id', $userauth)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $lengkapi = DB::table('perusahaans')->where('user_id', $userauth)->select('nama_perusahaan')->value('nama_perusahaan');

        $userauth = Auth::user()->role;
        if($userauth == 'admin'){
            return view('user.pengaturan.emails.index', compact('email', 'pagename', 'pagename1'));
        }else if($userauth == 'user'){
            // return view('user.lowong.index', compact('email', 'pagename', 'pagename1'));
        }else if($userauth == 'perusahaan'){
            $bidang = BidangPekerjaan::all();
            $uid = Auth::user()->id;
            $post = Post::all()->where('user_id', $userauth);
            $userid = User::find($uid);
            // $foto = Perusahaan::all()->where('user_id', $uid);
            
            return view('company.lowongan.create', compact('userid', 'bidang','nomor','lengkapi', 'judul', 'post', 'cari', 'mencari','userid', 'notifikasi'));
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
        $this->validate($request,[
            'judul_pekerjaan' => 'required',
            'bidang_pekerjaan' => 'required',
            'employee' => 'required',
            'deskripsi_pekerjaan' => 'required',
            'persyaratan' => 'required',
            'masa_berakhir' => 'required',
        ]);

        $uid = Auth::user()->id;
        $alamatperusahaan = DB::table('perusahaans')->where('user_id', $uid)->select('alamat_perusahaan')->value('alamat_perusahaan');
        $namaperusahaan = DB::table('perusahaans')->where('user_id', $uid)->select('nama_perusahaan')->value('nama_perusahaan');
        $fotouser = DB::table('perusahaans')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
        $iduser = DB::table('perusahaans')->where('user_id', $uid)->select('id')->value('id');
        // $buatset = Post::all()->masa_berakhir();
        // $setformat = date('d/m/Y');
        // $settanggal = date_create($masaberakhir);
        // $setbuat = date_create();
        // $diff = date_diff($buat , $berakhir);

        
        $settanggal = date_create($request->masa_berakhir);
        $setformat = date_format($settanggal, "d-m-Y");

        $post = new Post;
   
        $post->user_id = Auth::user()->id;
        $post->judul_pekerjaan = $request->judul_pekerjaan;
        $post->perusahaan_id = $iduser;
        $post->bidang_pekerjaan_id = $request->bidang_pekerjaan;
        $post->employee = $request->employee;
        $post->deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
        $post->persyaratan = $request->persyaratan;
        // $post->masa_berakhir = $request->masa_berakhir;
        $post->masa_berakhir = $setformat;
        // $post->masa_berakhir = $diff->d . 'hari' . $diff->h . 'jam' . $diff->i . 'menit';
        $post->nama_perusahaan = $namaperusahaan;
        $post->alamat_perusahaan = $alamatperusahaan;
        $post->foto = $fotouser;


        $post->save();
        

        activity()
        ->log('Anda berhasil membuat lowongan');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'create';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect('home')->with('sukses', 'Postingan berhasil dibuat');
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
        $judul = Post::find($id);
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
        $lowongan = [
            DB::table('posts')->paginate(3)
        ];

        // $random = Post::all()->random(3);
        // $random = Arr::random($lowongan);
        $uid = Auth::id();
        $userrole = Auth::user()->role;
        $post = Post::all()->where('user_id', $uid);
        $postingan = Post::find($id);
        $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
        $cek = DB::table('perusahaans')->where('user_id', $postingan->user_id)->select('id')->value('id');
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        // $uid = User::find($id);
        $userauth = Auth::user()->role;
        if($userauth == 'admin' || $userauth == 'super admin'){
            $uid = Auth::id();
            $post = Post::all()->where('user_id', $uid);
            $useradmin = User::find($uid);
            $postingan = Post::find($id);
            // $judul = DB::table('posts')->where('user_id', $postingan->user_id)->select('judul_pekerjaan')->value('judul_pekerjaan');
            $judul = Post::find($id);
            $userrole = Auth::user()->role;
            $pagename = 'nama_postingan';
            $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
            $cek = DB::table('perusahaans')->where('user_id', $postingan->user_id)->select('id')->value('id');
            $foto_profil = DB::table('admins')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');

            return view('admin.lowongan.show', compact('nomor','pagename','useradmin','perusahaan','post','judul','foto_profil','postingan','cek','mencari', 'notifikasi', 'userrole'));
        }else if($userauth == 'user'){
            $lengkapi_profil = DB::table('profils')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
            $user = DB::table('profils')->select('id')->value('id');
            // $user = Auth::find($id);
            // $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
            $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
            // $perusahaan = DB::table('perusahaans')->where('user_id', $postingan->user_id)->paginate(3);
            $rekomendasi = Perusahaan::all();
            $userid = User::find($uid);
            $hitung = Post::all();
            $jumlahdata = count($hitung);

            if($jumlahdata < 3){
                $randompost = Post::all();
                $jumlahdata = count($post);
                return view('user.lowongan.show', compact('randompost', 'jumlahdata', 'rekomendasi', 'user','lengkapi_profil','nomor','perusahaan', 'post', 'postingan','userid', 'cek','judul','cari','mencari', 'notifikasi'));
            }
            
            $randompost = Post::all()->random(3);
            return view('user.lowongan.show', compact('randompost', 'jumlahdata', 'rekomendasi', 'user','lengkapi_profil','nomor','perusahaan', 'post', 'postingan','userid', 'cek','judul','cari','mencari', 'notifikasi'));
            // return view('user.pengaturan.emails.index', compact('email', 'pagename', 'pagename1'));
        }else if($userauth == 'perusahaan'){
            $postingan = Post::find($id);
            $userid = User::find($uid);

            return view('company.lowongan.show', compact('nomor','postingan','perusahaan','post','judul','userid','postingan','cek','cari','mencari', 'notifikasi'));
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
        $judul = 'Edit Postingan Lowongan Magang';
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
        $uid = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $nomor = count($notifikasi);
        $bidang = BidangPekerjaan::all();

        $post = Post::find($id);
        $namapost = Post::find($id)->judul_pekerjaan;
        $userid = User::find($uid);

        return view('company.lowongan.edit',compact('bidang', 'nomor','post', 'namapost', 'judul', 'cari', 'mencari','userid', 'notifikasi'));
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
        $request->validate([
            'judul_pekerjaan'=>'required',
            'bidang_pekerjaan'=>'required',
            'employee'=>'required',
            'deskripsi_pekerjaan'=>'required',
            'persyaratan'=>'required',
            'masa_berakhir'=>'required'
        ]);

        $settanggal = date_create($request->masa_berakhir);
        $setformat = date_format($settanggal, "d-m-Y");
        $post = Post::find($id);

        $post->user_id = Auth::user()->id;
        $post->judul_pekerjaan=$request->get('judul_pekerjaan');
        $post->bidang_pekerjaan_id=$request->get('bidang_pekerjaan');
        $post->employee=$request->get('employee');
        $post->deskripsi_pekerjaan=$request->get('deskripsi_pekerjaan');
        $post->persyaratan=$request->get('persyaratan');
        $post->masa_berakhir=$setformat;
        
        $post->save();


        activity()
        ->log('Anda telah memperbarui lowongan');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect('home')->with('sukses','Postingan berhasil diupdate');
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

        activity()
        ->log('Anda telah menghapus lowongan');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'delete';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();


        return redirect('home')->with('sukses', 'Postingan "'. $namapost .'" berhasil dihapus', 'notifikasi');
    }


    public function getlamaran($id)
    {
        $judul = Post::find($id);
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
        $uid = Auth::id();
        
        $post = Post::all()->where('user_id', $uid);
        $postingan = Post::find($id);
        $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
        $cek = DB::table('perusahaans')->where('user_id', $postingan->user_id)->select('id')->value('id');
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        // $uid = User::find($id);
        $nomor = count($notifikasi);
        $userauth = Auth::user()->role;
        if($userauth == 'admin'){
            return view('user.pengaturan.emails.index', compact('email', 'pagename', 'pagename1'));
        }else if($userauth == 'user'){
            $userid = User::find($uid);
            // $sudahmelamar = Post::find($id);
            // $sudahmelamar = DB::table('lamarans')->where('post_id', $id)->where('profil_id', $uid)->select('profil_id')->value('profil_id');
            // $sudahmelamar = Lamaran::all()->where('profil_id', $uid)->where('post_id', $id);
            return view('user.lowongan.show', compact('nomor','perusahaan', 'post', 'postingan','userid', 'cek','judul','cari','mencari', 'notifikasi'));
            // return view('user.pengaturan.emails.index', compact('email', 'pagename', 'pagename1'));
        }else if($userauth == 'perusahaan'){
            $userid = User::find($uid);;
            return view('company.lowongan.show', compact('nomor','perusahaan','post','judul','userid','postingan','cek','cari','mencari', 'notifikasi'));
        }
    }

    public function lamaran(Request $request, Post $post, $id)
    {
        $uid = Auth::id();
        $uemail = Auth::user()->email;
        $orangmelamar = Lamaran::all()->where('post_id', $id);
        $banyakpelamar = count($orangmelamar);

        $namauser = DB::table('profils')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
        $teleponuser = DB::table('profils')->where('user_id', $uid)->select('telepon')->value('telepon');
        
        $userid = DB::table('posts')->where('id', $id)->select('user_id')->value('user_id');
        $getperusahaan = Post::find($id)->nama_perusahaan;
        $perusahaanid = DB::table('perusahaans')->where('nama_perusahaan', $getperusahaan)->select('user_id')->value('user_id');
        
        // $sudahmelamar = Lamaran::find($id)->profil_id;
        $sudahmelamar = DB::table('lamarans')->where('post_id', $id)->where('profil_id', $uid)->select('profil_id')->value('profil_id');
        // $postingan = Post::all()->where('user_id', $perusahaanid)->where('id', $id);
        // $waktu = Post::all()->where('user_id', $perusahaanid)->where('id', $id);
        $postingan = DB::table('posts')->where('user_id', $userid)->where('id', $id)->select('judul_pekerjaan')->value('judul_pekerjaan');
        // $postingan = DB::table('posts')->where('user_id', $perusahaanid)->where('id', $id)->select('judul_pekerjaan')->value('judul_pekerjaan');
        $waktu = DB::table('posts')->where('user_id', $userid)->where('id', $id)->select('masa_berakhir')->value('masa_berakhir');
        $profil = DB::table('profils')->where('user_id', $uid)->select('id')->value('id');

        if($sudahmelamar != $uid){
            $status = "diproses";
            $lamar = new Lamaran;
            $lamar->post_id = $id; 
            $lamar->profil_id = $profil;
            $lamar->email = $uemail;
            $lamar->nama = $namauser;
            $lamar->telepon = $teleponuser;
            $lamar->status_lamaran = $status;
            $lamar->nama_lowongan = $postingan;
            $lamar->waktu_berakhir = $waktu;
            $lamar->perusahaan_id =  $userid;
            $lamar->save(); 
            
            $lamar->update(); 
            $post = new Post;
            $post = Post::find($id);
            $post->pelamar = $banyakpelamar + 1 . " " . "orang";
            $post->save();

            activity()
            ->log('Anda berhasil mengirimkan lamaran');
            $lastActivity = Activity::all()->last();
            $lastActivity->name = Auth::user()->name;
            $lastActivity->log_name = 'post';
            $lastActivity->role = Auth::user()->role;
            $lastActivity->description;
            $lastActivity->save();


            return redirect('/home')->with('sukses', 'Lamaran anda telah terkirim!');
        }else{
            activity()
            ->log('Anda gagal mengirimkan lamaran');
            $lastActivity = Activity::all()->last();
            $lastActivity->name = Auth::user()->name;
            $lastActivity->log_name = 'post';
            $lastActivity->role = Auth::user()->role;
            $lastActivity->description;
            $lastActivity->save();

            return redirect('/home')->with('gagal', 'Lamaran tidak terkirim! karena anda telah mengirimkan lamaran sebelumnya');
        }
    }
}
