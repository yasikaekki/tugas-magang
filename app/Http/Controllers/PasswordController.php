<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Hash;

class PasswordController extends Controller
{
    //
    public function edit()
    {

        $cari = [
            'Cari Lowongan Magang Pengembangan Web',
            'Cari Lowongan Magang Design Grafis',
            'Cari Lowongan Magang Design Web',
            'Cari Lowongan Magang Pengembangan Aplikasi',
            'Cari Lowongan Magang Perbaikan Hardware',
            'Cari Lowongan Magang Manajemen Web',
            'Cari Lowongan Magang Pengelolaan Database',
            'Cari Lowongan Magang Pelayanan Masyarakat',
            'Cari Lowongan Magang Konten Kreator'
        ];
        
        $mencari = Arr::random($cari);

        return view('password.edit',compact('cari','mencari'));
    }
    public function update()
    {
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
            return back()->with('sukses', 'sukses mengganti kata sandi baru');
        }else{
            return back()->with('gagal', 'kata sandi lama salah, silahkan coba lagi');
        }
    }
}
