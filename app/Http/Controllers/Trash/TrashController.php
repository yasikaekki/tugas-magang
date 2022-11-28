<?php

namespace App\Http\Controllers\Trash;

use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Perusahaan;
use App\Model\Admin;
use App\User;
use App\Model\Post;
use App\Model\Lamaran;
use Auth;
use DB;
use App\Model\Profil;

class TrashController extends Controller
{
    //
    public function Index(Request $request)
    {
        //
        $pagename = "Sampah";
        $judul = "Sampah";
        $mencari = "Cari sampah";
        $uid = Auth::id();
        $useradmin = User::find($uid);
        $userrole = Auth::user()->role;
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $no = 1;
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $user = DB::table('users')->where('role', 'user')->orWhere('role', 'perusahaan')->paginate(10);

        $sampah = User::onlyTrashed()->paginate(10);
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = User::onlyTrashed()->where('name','like','%'.$request->hasil_cari.'%')
            ->paginate(10);
            $fitur_cari->appends($request->all());
        }
        return view('admin.sampah.index' , compact('keywoard','fitur_cari','judul', 'userrole', 'notifikasi', 'nomor', 'useradmin', 'pagename', 'sampah'));
    }
    
    public function restore($id)
    {
        //
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        activity()
            ->log('Akun ' . $user->name . ' berhasil dipulihkan');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect()->route('trash.index')->with('restore', 'Berhasil memulihkan akun '.$user->name);
    }
    
    public function HapusSelamanya($id)
    {
        //
        $lamaran = Lamaran::all();
        $post = Post::all();
        $user = User::withTrashed()->findOrFail($id);
        if($user->role == 'admin'){
            $admin = Admin::where('user_id', $id);
            $admin->delete();
        }elseif ($user->role == 'user') {
            $profil = Profil::where('user_id', $id);
            $profil->delete();
            if(!$lamaran->count() > 0){
                $lamaran = Lamaran::where('user_id', $id);
                $lamaran->delete();
            }
        }elseif ($user->role == 'perusahaan') {
            $perusahaan = Perusahaan::where('user_id', $id);
            $perusahaan->delete();
            // post
            if(!$post->count() == 0){
                $post = Post::where('user_id', $id);
                $post->delete();
            }
            // ada lamaran
            if(!$lamaran->count() == 0){
                $lamaran = Lamaran::where('perusahaan_id', $id);
                $lamaran->delete();
            }
        }
        $user->forceDelete();

        activity()
            ->log('Akun ' . $user->name . ' berhasil dihapus permanen');
        $lastActivity = Activity::all()->last();
        $lastActivity->name = Auth::user()->name;
        $lastActivity->log_name = 'update';
        $lastActivity->role = Auth::user()->role;
        $lastActivity->description;
        $lastActivity->save();

        return redirect()->route('trash.index')->with('delete', 'Berhasil menghapus permanen '.$user->name);
    }
}
