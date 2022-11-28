<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profil(){
        return $this->hasOne('App\Model\Profil');
    }
    public function admin(){
        return $this->hasOne('App\Model\Admin');
    }

    public function perusahaan(){
        return $this->hasOne('App\Perusahaan');
    }
    
    public function post()
    {
    return $this->hasMany('App\Model\Post');
    }
    
    public function lamaran()
    {
    return $this->hasMany('App\Model\Lamaran');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_users');
    // } 

    // public function roles()
    // {
    //     return $this->belongsToMany(RoleUser::class, 'role_users');
    // } 

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Model\RoleUser', 'role_users');
    // } 

    // public function hasRole($role) 
    // {
    //     return $this->roles()->where('name', $role)->count() == 1;
    // }
}
