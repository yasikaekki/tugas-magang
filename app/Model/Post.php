<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    //
   //  use HasFactory;

    public function user()
    {
       return $this->belongsTo('App\User');
    }
    public function perusahaan()
    {
       return $this->belongsTo('App\Perusahaan');
    }
    public function lamaran()
    {
       return $this->hasMany('App\Model\Lamaran');
    }
   //  public function favorites()
   //  {
   //     return $this->hasMany('App\Favorite');
   //  }
    public function bookmarks()
    {
       return $this->belongsToMany('App\FavoriteUser');
    }
    public function bidang_pekerjaan()
    {
       return $this->belongsTo('App\BidangPekerjaan');
    }
    protected $fillable = [
        'judul_pekerjaan',
        'bidang_pekerjaan',
        'employee',
        'deskripsi_pekerjaan',
        'persyaratan',
        'masa_berakhir',
    ];

    // public function getCreatedAttribute(){
    //     return Carbon::parse($this->attributes['created_at'])
    //         ->translatedFormat('d F Y');
    // }

    // protected $guarded = [
    //     'user_id',
    // ];
}
