<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('profile');

//Route::get('/', 'welcome@showProfile');
Route::prefix('admin')->middleware(['auth','password.confirm','verified','can:isAllowed,"ADMIN:Sales"'])->group(function(){
	Route::view('/','dashboard.admin');
	Route::resource('posts','PostController');
	Route::resource('profile','UserProfileController');
	Route::resource('users','UserController');
	Route::resource('pages','PagesController');
	Route::resource('categories','CategoriesController');
	Route::resource('roles','RoleController');
});


Auth::routes(['verify' => true]);

Route::match(['get','post'],'/home', 'HomeController@index')->name('home');
