<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
   // use Factory;
    //
    public function user()
    {
       return $this->hasMany('App\User');
    }

    public function profil()
    {
       return $this->belongsTo('App\Model\Profil');
    }

    public function post()
    {
       return $this->belongsTo('App\Model\Post');
    }

    public function perusahaan()
    {
       return $this->belongsTo('App\Perusahaan');
    }
}
