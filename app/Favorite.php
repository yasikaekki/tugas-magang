<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    public function post()
    {
    return $this->belongsTo('App\Model\Post');
    }
    public function user()
    {
    return $this->belongsTo('App\User');
    }
    public function favorite_users()
    {
    return $this->belongsToMany('App\FavoriteUser');
    }
}
