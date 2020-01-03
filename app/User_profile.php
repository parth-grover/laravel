<?php

namespace App;
use App\user;
use App\UserProfile;
use App\Countries;
use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $guarded = [];
	
	public function country(){
		return $this->belongsTo(Countries::class,'country_id','id');
	}
	
}
