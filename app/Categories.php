<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $guard  = [];
    public function childrens(){
		return $this->hasMany(categories::class,'parent_id','id');
	}
	
	public function parent(){
		return $this->belongsTo(categories::class,'parent_id','id');
	}
}
