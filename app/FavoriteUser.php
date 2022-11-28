<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteUser extends Model
{
    //
    public function posts()
    {
       return $this->belongsToMany('App\Model\Post');
    }
}
