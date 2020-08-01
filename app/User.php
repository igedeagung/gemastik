<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Awobaz\Compoships\Compoships;

class User extends Authenticatable
{
    use Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nrp', 'no_hp'
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

    // public function teams(){
    //     return $this->hasMany('App\Team', 'leader_id');
    // }
    // public function teams2(){
    //     return $this->hasMany('App\Team', 'user1_id');
    // }
    // public function teams3(){
    //     return $this->hasMany('App\Team', 'user2_id');
    // }
    // public function join_users(){
    //     return $this->hasMany('App\Join', 'id');
    // }
}
