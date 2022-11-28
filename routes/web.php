<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Model\Post; 
use App\User;
use App\BidangPekerjaan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $judul = 'Selamat Datang';
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

    $keywoard = $request->searching;

    if ($request) {
        $fitur_cari = Post::where('judul_pekerjaan','like','%'.$request->searching.'%')
        ->orWhere('bidang_pekerjaan_id','like','%'.$request->searching.'%')
        ->paginate(5);
        $fitur_cari->appends($request->all());
        $tes = BidangPekerjaan::all();
        $bidangpekerjaan = BidangPekerjaan::all()->take(3);
        $bidangpekerjaanlainnya = $tes[count($tes)-1];
    } 

    return view('welcome',compact('keywoard', 'bidangpekerjaan', 'bidangpekerjaanlainnya', 'fitur_cari','judul','mencari'));
});

Route::resource('/dashboard', 'Users\GuestController');

Auth::routes(['verify' => true]);

Route::get('/create', function () {
    return Auth::user()->id;
});
Route::get('/role', function () {
    return Auth::user()->role;
});

Route::get('/users/{user}', function ($id) {
    $user = User::with('post')->find($id);
    return response()->json($user, 200);
});
Route::get('chart', 'ChartController@index');


Route::group(['prefix' => 'home', 'middleware' => 'auth'], function(){
    Route::get('/', 'Users\DashboardController@index')->name('menu.index');
    // Route::get('/', 'Users\DashboardController@index');
    Route::get('/notifikasi', 'Users\NotifikasiController@index')->name('notifikasi.index');
    Route::get('/admin', 'Users\AdminController@index')->name('admin.index');
    Route::get('/perusahaan', 'Admin\PerusahaanController@index')->name('perusahaan.index');
    Route::get('/user', 'Admin\UserController@index')->name('user.index');
    Route::get('/aktivitas/aktivitas_user', 'Admin\UserAktivitasController@index')->name('aktivitas_user.index');
    Route::get('/aktivitas/aktivitas_admin', 'Admin\AdminAktivitasController@index')->name('aktivitas_admin.index');
    Route::get('/aktivitas/aktivitas_perusahaan', 'Admin\PerusahaanAktivitasController@index')->name('aktivitas_perusahaan.index');
    Route::get('chart', 'ChartController@index');
    Route::get('/view', 'File\FileController@index')->name('view.index');
    Route::get('/get/{filename}', 'File\FileController@getfile')->name('get.getfile');
    Route::resource('/data_user', 'Admin\DataUserController');
    Route::resource('/data_admin', 'Admin\DataAdminController');
    Route::resource('/data_perusahaan', 'Admin\DataPerusahaanController');
    Route::get('/registrasi/user_registrasi', 'Admin\UserRegistrasiController@index')->name('user_registrasi.index');
    Route::get('/registrasi/admin_registrasi', 'Admin\AdminRegistrasiController@index')->name('admin_registrasi.index');
    Route::get('/registrasi/perusahaan_registrasi', 'Admin\PerusahaanRegistrasiController@index')->name('perusahaan_registrasi.index');
    Route::get('/pengunjung', 'Admin\PengunjungController@index')->name('pengunjung.index');
    // Route::resource('/admin', 'Admin\AdminController');
    Route::get('/status/lamaran/{lamaranshow}/{id}/{melihatuser}', 'Users\StatusController@read')->name('melihatuser.read');
    Route::resource('/profil', 'Users\ProfilController');
    Route::resource('/lowongan','Users\LowonganController');
    Route::post('/lowongan/submit/{submit}','Users\LowonganController@lamaran')->name('lowongan.submit');
    Route::get('/lowongan/submit/{submit}','Users\LowonganController@getlamaran')->name('lowongan.lamaran');
    Route::resource('/pengaturan/email','Users\SettingEmailController');
    
    Route::resource('/status/favorite', 'Users\FavoriteController');
    Route::resource('/status/lamaran', 'Users\StatusController');
    Route::patch('/status/lamaran/diterima/{lamaran}', 'Users\StatusController@diterima')->name('lamaran.diterima');
    Route::patch('/status/lamaran/ditolak/{lamaran}', 'Users\StatusController@ditolak')->name('lamaran.ditolak');
    Route::resource('/pengaturan/kata_sandi','Users\SettingPasswordController');

    //sampah
    Route::get('/trash', 'Trash\TrashController@Index')->name('trash.index');
    Route::post('/restore/{id}', 'Trash\TrashController@restore')->name('restore.store');
    Route::delete('/forcedelete/{id}', 'Trash\TrashController@HapusSelamanya')->name('forcedelete.destroy');
    
    //favorite
    Route::post('/user/favorite/{id}', 'Users\DashboardController@favorite')->name('favorite.store');
});