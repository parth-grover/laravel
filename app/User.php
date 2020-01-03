<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User_profile;
use App\post;
use App\role;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password', 'token'
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
	
	public function profile(){
		return $this->hasOne(User_profile::class);
	}
	
	public function post(){
		return $this->hasMany(post::class);
	}
	
	public function roles(){
		return $this->belongsToMany(role::class,'role_user');
	}
	
	public function setUsernameAttribute($username){
		$username = str_replace(' ','-',$username);
	    $this->attributes['username'] = strtolower($username);
	}
}
