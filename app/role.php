<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;
class role extends Model
{
    public function users(){
		return $this->belongsToMany(user::class,'role_user');
	}
}
