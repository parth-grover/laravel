<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		Gate::define('isAdmin',function($user){
			$roles = $user->roles->pluck('name')->toArray();
			return in_array('ADMIN',$roles);
		});
		
		Gate::define('isAllowed',function($user,$allowed){
			$allowed = explode(':',$allowed);
			$roles = $user->roles->pluck('name')->toArray();
			return array_intersect($allowed,$roles);
		});
		
		Gate::define('inAllowed',function($user,$allowed){
			$allowed = $allowed->all();
			$roles = $user->roles->pluck('name')->toArray();
			return array_intersect($allowed,$roles);
		});
		
		Gate::define('isuserPost',function($user,$post_user){
			return $user->id === $post_user;
		});
        //
		
		Gate::define('edit-allowed',function($user,$user_id){
			return $user->id === $user_id ? Response::allow() : Response::deny("You are not Authorized to Edit This Post");
		});
    }
}
