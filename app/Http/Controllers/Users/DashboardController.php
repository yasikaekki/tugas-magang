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
use App\BidangPekerjaan;
use App\Favorite;
use App\FavoriteUser;
use Auth;
use DB;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $judul = 'Situs Penyedia Jasa Informasi Magang Terpercaya dan Terlengkap di Kabupaten Banyuwangi';
        $cari = [
            'Cari Lowongan Magang Pemrograman Web',
            'Cari Lowongan Magang Design Grafis',
            'Cari Lowongan Magang Jaringan Komputer',
            'Cari Lowongan Magang Service Komputer',
            'Cari Lowongan Magang Kerja Kantor',
            'Cari Lowongan Magang Seller',
            'Cari Lowongan Magang Digital Marketing',
            'Cari Lowongan Magang Pelayanan Masyarakat',
            'Cari Lowongan Magang Konten Kreator'
        ];

        $mencari = Arr::random($cari);
        $uid = Auth::id();

        // $fitur_cari = Post::all();
        $keywoard = $request->hasil_cari;
        
        $perusahaan = Perusahaan::all();
        
        $notifikasi = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->paginate(5);
        $notifku = DB::table('activity_log')->where('causer_id', $uid)->orderBy('created_at','desc')->get();
        $nomor = count($notifku);
        $userauth = Auth::user()->role;
        $bidangpekerjaan = BidangPekerjaan::all();
        if($userauth == 'admin' || $userauth == 'super admin'){
            // foreach($perusahaan as $i => $perusahaans){
            //     $jumlah = $perusahaans->id;
            // }
            
            $pagename = 'Dashboard';
            $judul = "Dashboard";
            $user = User::all()->where('role','user');
            $admin = DB::table('users')->where('role', 'admin')->orWhere('role', 'super admin')->get();
            $perusahaan = User::all()->where('role', 'perusahaan');
            $pengunjung = DB::table('users')->where('role','user')->orWhere('role','perusahaan')->get();
            $useradmin = User::find($uid);
            $jumlahuser = count($user);
            $jumlahadmin = count($admin);
            $jumlahperusahaan = count($perusahaan);
            $jumlahpengunjung = count($pengunjung);
            $userrole = Auth::user()->role;
            
            
            return view('admin.dashboard', compact('nomor','userrole','jumlahpengunjung','pagename','notifikasi','jumlahuser', 'jumlahadmin', 'jumlahperusahaan','useradmin', 'judul'));

        }else if($userauth == 'user'){

            if ($request) {
                $fitur_cari = DB::table('posts')->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
                ->orWhere('bidang_pekerjaan_id','like','%'.$request->hasil_cari.'%')->orderBy('created_at','desc')
                ->paginate(5);
                $favorit = DB::table('posts');
                $cek = Post::all();
                $fitur_cari->appends($request->all());
            }

            // $klik = Favorite::find($userauth);
            // $klik = true;
            // $klik = true;

            $profil = DB::table('profils')->where('user_id', $uid)->select('nama_lengkap')->value('nama_lengkap');
            $userid = User::find($uid);
            $post = DB::table('posts')->orderBy('created_at','desc')->paginate(5);
            $foto_profil = DB::table('profils')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
            $favorite = Favorite::all()->where('user_id', $uid);
            $klik = DB::table('favorites')->where('user_id', $uid)->select('post_id')->value('post_id');


            $tes = Favorite::all()->where('user_id', $uid);
            $tessa = [];
            foreach($tes as $tess){
                if($tess->user_id == $uid){
                    $tessa = $tess->post_id;
                }
            }
            $fav = DB::table('favorites');
            $tes = Post::all();
            // $bidangpekerjaan = BidangPekerjaan::all()->take(3);
            // $bidangpekerjaanlainnya = $tes[count($tes)-1];
            // foreach($favorite as $favorites){
            //     $tes = $favorites->post_id;
            // }

            if($request->filter_bidang){
                $fitur_cari = DB::table('posts')->where('bidang_pekerjaan_id', $request->filter_bidang)->paginate(5);
            }

            if($request->filter_sort){
                if($request->filter_sort == 1){
                    $fitur_cari = DB::table('posts')->orderBy('created_at', 'desc')->paginate(5);
                }elseif ($request->filter_sort == 2) {
                    $fitur_cari = DB::table('posts')->orderBy('created_at', 'asc')->paginate(5);
                }elseif ($request->filter_sort == 3) {
                    $fitur_cari = DB::table('posts')->orderBy('judul_pekerjaan', 'asc')->paginate(5);
                }elseif ($request->filter_sort == 4) {
                    $fitur_cari = DB::table('posts')->orderBy('judul_pekerjaan', 'desc')->paginate(5);
                }else{
                }
            }


            return view('user.dashboard', compact('fav', 'klik', 'tessa', 'tes', 'uid','bidangpekerjaan', 'favorite', 'cek', 'userid','nomor','keywoard','fitur_cari','mencari', 'judul', 'post', 'perusahaan','foto_profil','notifikasi', 'profil'));
        }else if($userauth == 'perusahaan'){
            if ($request) {
                $fitur_cari = DB::table('posts')->where('user_id',$uid)->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
                ->orderBy('created_at','desc')
                ->paginate(5);
                $fitur_cari->appends($request->all());
            }
            

            $mencari = 'Cari Lowongan Anda';
            $postingan = Post::all()->where('user_id', $uid)->sortByDesc('created_at');
            $post = DB::table('posts')->where('user_id', $uid)->orderBy('created_at','desc')->paginate(5);
            $userid = User::find($uid);
            $profil = DB::table('perusahaans')->where('user_id', $uid)->select('nama_perusahaan')->value('nama_perusahaan');
            // $tes = BidangPekerjaan::all();
            // $bidangpekerjaan = BidangPekerjaan::all()->take(3);
            // $bidangpekerjaanlainnya = $tes[count($tes)-1];

            $foto_profil = DB::table('perusahaans')->where('user_id', $uid)->select('ubah_foto')->value('ubah_foto');
            return view('company.dashboard', compact('userid', 'bidangpekerjaan','nomor','keywoard','fitur_cari','mencari', 'judul', 'postingan', 'perusahaan', 'post', 'foto_profil', 'notifikasi', 'profil'));
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

    public function favorite($id)
    {
        //
        $cek = Favorite::all()->where('user_id', Auth::user()->id)->where('post_id', $id);
        if($cek->count() == null){
            $favorit = new Favorite;
            $favorit->user_id = Auth::user()->id;
            $favorit->post_id = $id;
            $favorit->save();

            // $favorituser = new FavoriteUser;
            // $favorituser->user_id = Auth::user()->id;
            // $favorituser->post_id = $id;
            // $favorituser->save();

            return back();
        }
        return back()->with('gagal', 'Anda telah memasukkan favorit anda');
    }
}
