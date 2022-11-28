<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function post(){
        return $this->hasMany('App\Model\Post');
    }
}
