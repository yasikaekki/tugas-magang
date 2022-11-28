<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangPekerjaan extends Model
{
    //
    public function Post()
    {
       return $this->hasMany('App\Model\Post');
    }
}
