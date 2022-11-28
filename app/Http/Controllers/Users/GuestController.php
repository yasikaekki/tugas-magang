<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Model\Post;
use App\Perusahaan;
use DB;

class GuestController extends Controller
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
        $perusahaan = Perusahaan::all();
        $keywoard = $request->hasil_cari;
        $post = DB::table('posts')->orderBy('created_at','desc')->paginate(5);

        if ($request) {
            $fitur_cari = DB::table('posts')->orderBy('created_at','desc')->where('judul_pekerjaan','like','%'.$request->hasil_cari.'%')
            ->orWhere('bidang_pekerjaan_id','like','%'.$request->hasil_cari.'%')
            ->paginate(5);
            $fitur_cari->appends($request->all());
        }      
        
        return view('guest.dashboard', compact('keywoard','fitur_cari','mencari', 'judul', 'post', 'perusahaan'));

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

        $postingan = Post::find($id);
        $perusahaan = Perusahaan::all()->where('user_id', $postingan->user_id);
        $cek = DB::table('perusahaans')->where('user_id', $postingan->user_id)->select('id')->value('id');
        
        $hitung = Post::all();
        $jumlahdata = count($hitung);
        if ($jumlahdata < 3) {
            $randompost = Post::all();
            $jumlahdata = count($post);

            return view('guest.show', compact('jumlahdata','randompost','perusahaan','judul', 'postingan','cek', 'mencari'));
        }

        $randompost = Post::all()->random(3);
        
        return view('guest.show', compact('jumlahdata','randompost','perusahaan','judul', 'postingan','cek', 'mencari'));
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
}
