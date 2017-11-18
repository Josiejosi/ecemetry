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
});

Auth::routes();

Route::get('dashboard', 			'HomeController@index')->name('dashboard') ;

Route::get('view/{username}', 		'PublicController@index') ;
Route::get('save/pdf/{username}', 	'PublicController@save_pdf') ;
Route::get('save/user/pdf/{username}', 	'HomeController@save_pdf') ;
Route::post('profile/upload', 		'HomeController@profile_update') ;
Route::post('profile/avatar', 		'HomeController@profile_avatar') ;
Route::post('profile/background', 	'HomeController@profile_background') ;
Route::post('profile/other', 		'HomeController@profile_other') ;

Route::get('admin/dashboard', 			'AdminController@index') ;
Route::get('change_password', 			'AdminController@change_password') ;
Route::get('edit/user/{user_id}', 		'AdminController@edit_user') ;
Route::get('delete/user/{user_id}', 	'AdminController@delete_user') ;
Route::get('block/user/{user_id}', 	    'AdminController@block_user') ;
Route::get('user/create', 	    'AdminController@create_user') ;
Route::post('user/store', 	    'AdminController@post_user') ;

Route::get('add_admin', function () {

    $new_user               = \App\User::create([
        'username'          => "Admin",
        'name'              => "Mr",
        'surname'           => "Admin",
        'dob'               => "10-12-2017",
        'cause_of_death'    => '',
        'summary'           => '',
        'is_active'         => 1,
        'email'             => "AdminUser@gmail.com",
        'password'          => bcrypt("450411"),
    ]);

    $role = \App\Role::whereName("Admin")->get() ;

    if ( $new_user ) $new_user->assignRole( "Admin" ) ;

});
