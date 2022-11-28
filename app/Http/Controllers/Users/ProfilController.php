<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\User;
use App\Model\Admin;
use App\Model\Post;
use App\Perusahaan;
use App\Model\Profil;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Akun';
        $judul = 'Akun';
        $uid = Auth::id();

        // return view('user.profiles.index', compact('profil','pagename'));
        $authprofil=Auth::id();
        $names=Profil::all();
        $userprofil = Profil::find($authprofil);
        $profil=$names->where('user_id',$authprofil);
        $notifikasi = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        // $profiledit = Profil::all()->where('user_id', $authprofil)->select('user_id')-get();
        // $profiledit = Profil::find($authprofil);
        $nomor = count($notifku);
        // return view('user.profiles.index', compact('profil','pagename'));

        $userauth = Auth::user()->role;
        if ($userauth == 'super admin') {
            return view('errors.404');
        }else if($userauth == 'admin'){
            $user = Admin::all()->where('user_id', $authprofil);
            $useradmin = User::find($uid);
            $lengkapi_profil = DB::table('profils')->where('user_id', $authprofil)->select('nama_lengkap')->value('nama_lengkap');
            $userrole = Auth::user()->role;
            return view('admin.profiles.index',compact('nomor','userrole','pagename','notifikasi','uid','user','useradmin', 'judul'));
       
        }else if($userauth == 'user'){

            $user=Profil::all()->where('user_id', $authprofil);
            $profil = DB::table('profils')->where('user_id', $authprofil)->select('user_id')->value('user_id');
            $lengkapi_profil = DB::table('profils')->where('user_id', $authprofil)->select('nama_lengkap')->value('nama_lengkap');
            $userid = User::find($authprofil);
   
            
            return view('user.profiles.index', compact('nomor','profil', 'judul','pagename', 'user','lengkapi_profil', 'userid', 'notifikasi'));

        }else if($userauth == 'perusahaan'){
            
            $post = Post::all()->where('user_id', $authprofil);
            $user=Perusahaan::all()->where('user_id', $authprofil);
            $profil = DB::table('perusahaans')->where('user_id', $authprofil)->select('user_id')->value('user_id');
            $lengkapi_profil = DB::table('perusahaans')->where('user_id', $authprofil)->select('nama_perusahaan')->value('nama_perusahaan');
            $userid = User::find($authprofil);
            
           
            return view('company.profiles.index', compact('nomor','profil', 'post', 'lengkapi_profil', 'judul', 'pagename', 'user','userid', 'notifikasi'));
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
        $judul = 'Lengkapi Akun';

        $authprofil = Auth::id();
        $notifikasi = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->paginate(5);
        $perusahaan = Perusahaan::find($authprofil);
        $profil = Profil::find($authprofil);
        $usercompany=Perusahaan::all()->where('user_id', $authprofil);
        
        $profilcreate = DB::table('perusahaans')->where('user_id', $authprofil)->select('user_id')->value('user_id');

        // return view('user.profiles.edit', compact('profil', 'authprofil'));

        $userauth = Auth::user()->role;
        // $user = User::find($id);
        if($userauth == 'admin'){
            
            return view('user.profiles.index', compact('profil','pagename', 'cari', 'mencari'));
       
        }else if($userauth == 'user'){
            
            $user=Profil::all()->where('user_id', $authprofil);
            $foto_profil = DB::table('profils')->where('user_id', $authprofil)->select('ubah_foto')->value('ubah_foto');

            return view('user.profiles.edit', compact('profil', 'judul','user', 'foto_profil', 'notifikasi'));

        
        }else if($userauth == 'perusahaan'){
            
            $post = Post::all()->where('user_id', $authprofil);
            $user=Perusahaan::all()->where('user_id', $authprofil);
            $foto_profil = DB::table('perusahaans')->where('user_id', $authprofil)->select('ubah_foto')->value('ubah_foto');

            return view('company.profiles.create', compact('profilcreate', 'post', 'perusahaan', 'judul',  'foto_profil','user', 'notifikasi', 'usercompany'));

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
        $authprofil = Auth::id();
        $perusahaan=Perusahaan::find($authprofil);
        $userauth = Auth::user()->role;
        $judul = 'Akun';
        $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
        

        if($userauth == 'admin'){
    
            $authemail = Auth::id();
            $profil = new Profil;
            $profil=Profil::find($authemail);
            $profil->nama_lengkap=$request->nama_lengkap;
            $profil->tempat_lahir = $request->tempat_lahir;
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->alamat_rumah = $request->alamat_rumah;
            $profil->telepon = $request->telepon;
            $profil->surat_keterangan = $request->surat_km;
            $profil->cv = $request->surat_cv;
            $profil->portofolio = $request->surat_portofolio;
            $profil->save();

            activity()
            ->log('Anda telah mengisi profile');
            $lastActivity = Activity::all()->last();
            $lastActivity->description;
            
            return redirect('/home/profil')->with('sukses', 'Profil berhasil dilengkapi');
        }else if($userauth == 'user'){


            $authemail = Auth::id();
            $profil = new Profil;
            $profil=Profil::find($authemail);
            $profil->nama_lengkap=$request->nama_lengkap;
            $profil->tempat_lahir = $request->tempat_lahir;
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->alamat_rumah = $request->alamat_rumah;
            $profil->pendidikan_user = $request->pendidikan_user;
            $profil->telepon = $request->telepon;
            $profil->ubah_foto = $imageName; $profil->lokasi_foto = $request->upload_foto->move(public_path('images'), $imageName);
            $profil->save();

            activity()
            ->log('Anda telah mengisi profile');
            $lastActivity = Activity::all()->last();
            $lastActivity->description;
            
            return redirect('/home/profil')->with('sukses', 'Profil berhasil dilengkapi');
        }else if($userauth == 'perusahaan'){
            
            $authemail = Auth::id();
            $profil = new Perusahaan;
            $perusahaan=Perusahaan::find($authemail);
            $perusahaan->nama_perusahaan=$request->nama_perusahaan;
            $perusahaan->alamat_perusahaan = $request->alamat_perusahaan;
            $perusahaan->jumlah_karyawan = $request->jumlah_karyawan;
            $perusahaan->tentang_perusahaan = $request->tentang_perusahaan;
            $perusahaan->no_npwp = $request->no_npwp;
            $perusahaan->telepon = $request->telepon;
            $perusahaan->industri = $request->industri;
            $perusahaan->lokasi_foto = $request->upload_foto->move(public_path('imagesPerusahaan'), $imageName);
            $perusahaan->ubah_foto = $imageName;
            $perusahaan->save();

            activity()
            ->log('Anda telah mengisi profile');
            $lastActivity = Activity::all()->last();
            $lastActivity->description;
    
            return redirect('/home/profil')->with('sukses', 'Profil berhasil dilengkapi');
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
        $uid = Auth::id();
        // print_r($uid);die;
        //
        $pagename = 'judul';
        $judul = 'Mengubah Akun';

        $authprofil = Auth::id();
        $perusahaan = Perusahaan::find($authprofil);
       
        // $profil = Profil::find($authprofil);
        $akun = DB::table('profils')->where('user_id', $authprofil);
        $akunedit = DB::table('profils')->where('user_id', $authprofil)->select('user_id')->value('user_id');

       
        
        $usercompany=Perusahaan::all()->where('user_id', $authprofil);
        $profiledit = DB::table('perusahaans')->where('user_id', $authprofil)->select('user_id')->value('user_id');
        $notifikasi = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $authprofil)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);

        $userauth = Auth::user()->role;

        $user = User::find($id);
        if ($userauth == 'super admin') {
            return view('errors.404');
        }else if($userauth == 'admin'){
            $user = User::all();
            $useradmin = User::find($authprofil);
            $akun = Admin::find($id); 
            $userrole = Auth::user()->role;
            
            return view('admin.profiles.edit',compact('akun','nomor','userrole','pagename','notifikasi','user','useradmin', 'judul'));
        }else if($userauth == 'user'){
            $user = Profil::find($id);
            $userid = User::find($authprofil);
            
            return view('user.profiles.edit', compact('nomor','authprofil','akun', 'judul', 'userid', 'notifikasi', 'akunedit', 'user'));
        }else if($userauth == 'perusahaan'){
            $post = Post::all()->where('user_id', $authprofil);
            $userid = User::find($authprofil);        

            return view('company.profiles.edit', compact('nomor','profiledit', 'post', 'perusahaan', 'judul',  'user', 'userid','usercompany', 'notifikasi'));
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
        $authprofil = Auth::id();
       
        $perusahaan=Perusahaan::find($authprofil);
        $userauth = Auth::user()->role;
        // $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
                    
        $judul = 'Akun';
        if($userauth == 'admin' || $userauth == 'super admin'){
            $this->validate($request,[
                'nama_lengkap' => 'required',
                'tentang_saya' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'pendidikan_user' => 'required',
                'keahlian' => 'required',
                'pekerjaan' => 'required',
                'jenis_kelamin' => 'required',
                'alamat_rumah' => 'required',
                'telepon' => 'required|numeric|digits_between:6,13',
                'upload_foto' => 'mimes:jpeg,jpg,png',
            ]);

            if (!$request->upload_foto) {
                return back()->with('gagal', 'Foto harus diisi');
            } else {
                $authemail = Auth::id();
                $getidprofil = DB::table('admins')->where('user_id', $authemail)->select('id')->value('id');
                $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
                $profil=Admin::find($getidprofil);
                $profil->nama_lengkap=$request->nama_lengkap;
                $profil->tentang_saya=$request->tentang_saya;
                $profil->tempat_lahir = $request->tempat_lahir;
                $profil->tanggal_lahir = $request->tanggal_lahir;
                $profil->pendidikan_user = $request->pendidikan_user;
                $profil->keahlian = $request->keahlian;
                $profil->pekerjaan = $request->pekerjaan;
                $profil->jenis_kelamin = $request->jenis_kelamin;
                $profil->alamat_rumah = $request->alamat_rumah;
                $profil->telepon = $request->telepon;
                $profil->lokasi_foto = $request->upload_foto->move(public_path('imagesadmin'), $imageName);;
                $profil->ubah_foto = $imageName;
                $profil->update();
                
                activity()
                ->log('Profil berhasil diperbaruhi');
                $lastActivity = Activity::all()->last();
                $lastActivity->name = Auth::user()->name;
                $lastActivity->log_name = 'update';
                $lastActivity->role = Auth::user()->role;
                $lastActivity->description;
                $lastActivity->save();

                return redirect('/home/profil')->with('sukses', 'Profil berhasil diperbaruhi');
            }

        }else if($userauth == 'user'){

            $this->validate($request,[
                'nama_lengkap' => 'required',
                'tentang_saya' => 'required',
                'pendidikan_user' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'alamat_rumah' => 'required',
                'telepon' => 'required|numeric|digits_between:6,13',
                'upload_foto' => 'required|mimes:jpeg,jpg,png',
                'upload_sk' => 'required|mimes:pdf',
                'upload_cv' => 'required|mimes:pdf',
                'upload_portofolio' => 'required|mimes:pdf'
            ]);

            $skName = $request->upload_sk->getClientOriginalName() . '_' . time() . '.' . $request->upload_sk->extension();
            $cvName = $request->upload_cv->getClientOriginalName() . '_' . time() . '.' . $request->upload_cv->extension();
            $portofolioName = $request->upload_portofolio->getClientOriginalName() . '_' . time() . '.' . $request->upload_portofolio->extension();
            $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
            
            // $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
            $authemail = Auth::id();
            $profil=Profil::find($id);
            $profil->nama_lengkap=$request->nama_lengkap;
            $profil->tentang_saya=$request->tentang_saya;
            $profil->pendidikan_user = $request->pendidikan_user;
            $profil->tempat_lahir = $request->tempat_lahir;
            $profil->tanggal_lahir = $request->tanggal_lahir;
            $profil->jenis_kelamin = $request->jenis_kelamin;
            $profil->alamat_rumah = $request->alamat_rumah;
            $profil->telepon = $request->telepon;

            $profil->lokasi_foto = $request->upload_foto->move(public_path('images'), $imageName);
            $profil->lokasi_sk = $request->upload_sk->move(public_path('surat_keterangan'), $skName);
            $profil->lokasi_cv = $request->upload_cv->move(public_path('cv'), $cvName);
            $profil->lokasi_portofolio = $request->upload_portofolio->move(public_path('portofolio'), $portofolioName);

            $profil->ubah_foto = $imageName;
            $profil->surat_keterangan = $skName;
            $profil->cv = $cvName;
            $profil->portofolio = $portofolioName;
            
            $profil->update();

            activity()
            ->log('Profil berhasil diperbaruhi');
            $lastActivity = Activity::all()->last();
            $lastActivity->name = Auth::user()->name;
            $lastActivity->log_name = 'update';
            $lastActivity->role = Auth::user()->role;
            $lastActivity->description;
            $lastActivity->save();

            return redirect('/home/profil')->with('sukses', 'Profil berhasil diperbaruhi');
            

        }else if($userauth == 'perusahaan'){
            // dd('ams');
            $this->validate($request,[
                'nama_perusahaan' => 'required',
                'tentang_perusahaan' => 'required',
                'no_npwp' => 'required',
                'jumlah_karyawan' => 'required',
                'industri' => 'required',
                'alamat_perusahaan' => 'required',
                'industri' => 'required',
                'telepon' => 'required|numeric|digits_between:6,13',
                'upload_foto' => 'required|mimes:jpeg,jpg,png',
                'upload_nib' => 'required|mimes:pdf',
                'upload_siup' => 'required|mimes:pdf',
                'upload_akta' => 'required|mimes:pdf',
            ]);
            
            // dd($request->upload_foto);
            $imageName = $request->upload_foto->getClientOriginalName() . '_' . time() . '.' . $request->upload_foto->extension();
            $nib = $request->upload_nib->getClientOriginalName() . '_' . time() . '.' . $request->upload_nib->extension();
            $siup = $request->upload_siup->getClientOriginalName() . '_' . time() . '.' . $request->upload_siup->extension();
            $akta = $request->upload_akta->getClientOriginalName() . '_' . time() . '.' . $request->upload_akta->extension();
            
            $authemail = Auth::id();
            $getidprofil = DB::table('perusahaans')->where('user_id', $authemail)->select('id')->value('id');
            
            $perusahaan = Perusahaan::find($getidprofil);
            $perusahaan->nama_perusahaan=$request->nama_perusahaan;
            $perusahaan->alamat_perusahaan = $request->alamat_perusahaan;
            $perusahaan->jumlah_karyawan = $request->jumlah_karyawan;
            $perusahaan->tentang_perusahaan = $request->tentang_perusahaan;
            $perusahaan->no_npwp = $request->no_npwp;
            $perusahaan->telepon = $request->telepon;
            $perusahaan->industri = $request->industri;
            
            $perusahaan->lokasi_foto = $request->upload_foto->move(public_path('imagesPerusahaan'), $imageName);
            $perusahaan->lokasi_nib = $request->upload_nib->move(public_path('nib'), $nib);
            $perusahaan->lokasi_siup = $request->upload_siup->move(public_path('siup'), $siup);
            $perusahaan->lokasi_akta = $request->upload_akta->move(public_path('akta'), $akta);
            $perusahaan->ubah_foto = $imageName;
            $perusahaan->nib = $nib;
            $perusahaan->siup = $siup;
            $perusahaan->akta_perusahaan = $akta;
            // $perusahaan->update();
            
            $perusahaan->update();

            activity()
            ->log('Profil berhasil diperbaruhi');
            $lastActivity = Activity::all()->last();
            $lastActivity->name = Auth::user()->name;
            $lastActivity->log_name = 'update';
            $lastActivity->role = Auth::user()->role;
            $lastActivity->description;
            $lastActivity->save();
                
            
            return redirect('/home/profil')->with('sukses', 'Profil berhasil diperbaruhi');
        }

        // $this->validate($request,[
        //     'nama_lengkap' => 'required',
        //     'tempat_lahir' => 'required',
        //     'tanggal_lahir' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'alamat_rumah' => 'required',
        //     'telepon' => 'required|numeric|digits_between:6,13',
        // ]);
        
        // $authemail = Auth::id();
        // $profil=Profil::find($authemail);
        // $profil->nama_lengkap=$request->nama_lengkap;
        // $profil->tempat_lahir = $request->tempat_lahir;
        // $profil->tanggal_lahir = $request->tanggal_lahir;
        // $profil->jenis_kelamin = $request->jenis_kelamin;
        // $profil->alamat_rumah = $request->alamat_rumah;
        // $profil->telepon = $request->telepon;
        // $profil->surat_keterangan = $request->surat_km;
        // $profil->cv = $request->surat_cv;
        // $profil->portofolio = $request->surat_portofolio;
        // $profil->update();
        
        // return redirect('/home/profil')->with('sukses', 'Profil berhasil diperbaruhi');
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
