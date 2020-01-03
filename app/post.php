<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;
use App\categories;

class post extends Model
{
   protected $guards = [];
   protected $fillable = ['user_id','title', 'content', 'thumbnail','slug'];
	
   public function user(){
	   return $this->belongsTo(user::class);
   }
   
   public function categories(){
	   return $this->belongsToMany(categories::class,'categories_posts','post_id','category_id','id','id');
   }
   
   public function setSlugAttribute($val){
	   $slug = str_replace(' ','-',$val);
	   $this->attributes['slug'] = strtolower($slug);
   }
   
   public static function getSlugAttribute($val){
	   return $val;
   }
   
}
