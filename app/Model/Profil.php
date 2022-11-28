<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function lamaran(){
        return $this->hasMany('App\Model\Lamaran');
    }

    protected $fillable = [
        'ubah_foto',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_rumah',
        'jenis_kelamin',
        'telepon',
        'surat_keterangan',
        'cv',
        'portofolio'
    ];



    protected $guarded = [
        'user_id',
    ];




    

    // public function getCreatedAtAttribute()
    // {
    //     return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    // }
}
