<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\role;
use App\Countries;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles','profile'])->get();
		return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = role::all();
		$countries = Countries::all();
		return view('dashboard.users.create',compact('countries','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = [
			'username' => $request->username,
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password)
		];
		$user = User::create($users);
		$filename = sprintf('photo_%s.jpg',random_int(1,1000));
		if($request->hasFile('photo')){
			$filename = $request->file('photo')->storeAs('profiles',$filename,'public');
		}else{
			$filename = null;
		}
		if($users){
			$profile = new \App\User_profile([
				'user_id' => $user->id,
				'city' => $request->city,
				'country_id' => $request->country,
				'photo' => $filename,
				'phono' => $request->phone
			]);
			$profile->save();
			//$user->profile()->save($profile);
			$user->roles()->attach($request->roles);
			return redirect()->route('users.index');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$user = User::with('profile','roles')->find($id);
		return view('dashboard.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('profile','roles')->find($id);
		$roles = role::all();
		$countries = Countries::all();
		return view('dashboard.users.edit',compact('user','countries','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
		$user->name = $request->name;
		$user->email = $request->email;
		if($user->save()){
			$user_profile = \App\User_profile::where('user_id',$user->id)->first();
			$filename = sprintf('photo_%s.jpg',random_int(1,1000));
			if($request->hasFile('photo')){
				$filename = $request->file('photo')->storeAs('profiles',$filename,'public');
			}else{
				$filename = $user_profile->photo;
			}
			$user_profile->city = $request->city;
			$user_profile->country_id = $request->country;
			$user_profile->photo = $filename;
			$user_profile->city = $request->city;
			$user_profile->save();
			$user->roles()->sync($request->roles);
			return redirect()->route('users.index');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
