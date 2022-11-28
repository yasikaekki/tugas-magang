<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Model\Post;
use App\Perusahaan;
use App\Model\Profil;
use App\Model\Lamaran;
use App\User;
use App\Favorite;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = "Favorite";
        $cari = "Mencari";
        $uid = Auth::user()->id;
        $favorite = Favorite::all()->where('user_id', $uid)->sortByDesc('created_at')->take(9);
        // $mencari = Arr::random($cari);
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $userid = User::find($uid);
        $mencari = "Cari Status Riwayat Lamaran Anda";
        $keywoard = $request->hasil_cari;
        if ($request) {
            $fitur_cari = Favorite::all()->where('user_id', $uid)->sortByDesc('created_at')->take(9);
            $page = DB::table('posts')->where('user_id', $uid)->orderBy('created_at','desc')->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
            ->paginate(5);
            $page->appends($request->all());
            // $fitur_cari->appends($request->all());
        }

        return view('user.status.favorite.index', compact('page','favorite', 'fitur_cari', 'keywoard', 'mencari','judul', 'nomor', 'cari', 'notifikasi', 'userid'));
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
        $favorite = Favorite::find($id);
        $favorite->delete();
        // $favorite->save();

        return back()->with('hapus', 'favorit berhasil dihapus!');
    }
}
