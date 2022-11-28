<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\User;
use App\Perusahaan;
use App\Model\Profil;
use App\Model\Post;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class SettingEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename1 = 'Ubah email';
        $pagename = 'Pengaturan';
        $judul = 'Pengaturan';

        $authemail = Auth::id();
        $emails=User::all();
        $user = User::find($authemail);
        $email=$emails->where('id',$authemail);
        $notifikasi = DB::table('activity_log')->where('causer_id', $authemail)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $authemail)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $userauth = Auth::user()->role;
        if($userauth == 'admin' || $userauth == 'super admin'){
            $user = User::all();
            $useradmin = User::find($authemail);
            $userrole = Auth::user()->role;
            // return view('admin.pengaturan.emails.index',compact('user','useradmin', 'judul', 'userrole'));
        }else if($userauth == 'user'){
            $userid = User::find($authemail);
            return view('user.pengaturan.emails.index', compact('nomor','email', 'judul', 'pagename1', 'user','userid', 'notifikasi'));
        }else if($userauth == 'perusahaan'){
            $post = Post::all()->where('user_id', $authemail);
            $userid = User::find($authemail);
            return view('company.pengaturan.emails.index', compact('nomor','email', 'post','judul', 'pagename1', 'user','userid', 'notifikasi'));
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
        // $this->validate($request, [
        //     'txtemail_user'=> 'required|email|unique:users,email',
        // ]);

        // $user=new User();
        // $user->email=$request->txtemail_user;
        // $user->save();

        // return redirect()->route('user.index')->with('sukses', 'User berhasil dibuat');
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
        $authemail = Auth::id();
        $emails=User::all();
        $email=$emails->where('id',$authemail);
        $user=User::find($authemail);
        $notifikasi = DB::table('activity_log')->where('causer_id', $authemail)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $authemail)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        // return view('user.pengaturan.emails.index', compact('user', 'authemail'));
        $userauth = Auth::user()->role;
        if ($userauth == 'super admin') {
            return view('errors.404');
        }else if($userauth == 'admin'){
            $judul = 'Pengaturan';
            $pagename = 'Email';
            $useradmin=User::find($authemail);
            $userrole = Auth::user()->role;
            return view('admin.pengaturan.emails.edit', compact('nomor','pagename','notifikasi','email','useradmin','judul', 'userrole'));
        }else if($userauth == 'user'){
            $foto_profil = DB::table('profils')->where('user_id', $authemail)->select('ubah_foto')->value('ubah_foto');
            return view('user.pengaturan.emails.index', compact('user', 'authemail','foto_profil', 'notifikasi'));
        }else if($userauth == 'perusahaan'){
            $post = Post::all()->where('user_id', $authprofil);
            $foto_profil = DB::table('perusahaans')->where('user_id', $authemail)->select('ubah_foto')->value('ubah_foto');
            return view('company.pengaturan.emails.index', compact('user', 'post','authemail','foto_profil', 'notifikasi'));
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
        $this->validate($request,[
            'txtemail_user' => 'required|email',
        ]);

        $authemail = Auth::id();
        $user=User::find($authemail);
        $user->email=$request->txtemail_user;
        $user->email_verified_at = null;
        $user->update();

        activity()
        ->log('Email anda berhasil diperbaruhi');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        $target = Auth::user()->email;

        // return redirect('/home/pengaturan/email')->with('sukses', 'Email berhasil diperbaruhi dari '. $target);
        // return redirect('/home/setting/email')->with('sukses', 'Email berhasil diperbaruhi dari '. $target);

        $userauth = Auth::user()->role;
        if($userauth == 'admin' || $userauth == 'super admin'){
            return redirect('/home/pengaturan/email/{edit}/edit')->with('sukses', 'Email berhasil diperbaruhi dari '. $target);
        }else if($userauth == 'user'){
            return redirect('/home/pengaturan/email')->with('sukses', 'Email berhasil diperbaruhi dari '. $target);
        }else if($userauth == 'perusahaan'){
            return redirect('/home/pengaturan/email')->with('sukses', 'Email berhasil diperbaruhi dari '. $target);
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
    }
}
