<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class profile extends Model
{
    //
	
	public function user(){
		return $this->belongsTo(user::class);
	}
	
}
