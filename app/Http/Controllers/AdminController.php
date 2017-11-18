<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF ;
use App\User ;
use App\UserMedia ;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    	$data = [
    		"users" => User::all(),
    	] ;
    	return view( "admin_dashboard", $data ) ;
    }

    public function change_password() {
    	return view( "change_password" ) ;
    }

    public function edit_user( $user_id ) {

		$user = User::find($user_id) ;

        $data = [
            'user'                  => $user,
            'profile_pic'           => asset( $this->get_avatar($user_id) ),
            'profile_background'    => asset( $this->get_background($user_id) ),
            'other_images'          => UserMedia::whereUserId( $user_id )->whereMediaType( "other" )->get(),
            'qrcode_url'            => url('/') . "/view/" .  $user->username,
            'pdf_url'				=> url('/') . "/save/pdf/" .  $user->username,
        ] ;

        return view( 'edit_user_profile', $data ) ;
    }

    public function block_user( $user_id ) {
    	User::find($user_id)->update(['is_active', 0]) ;
    	return redirect( "admin/dashboard" ) ;
    }

    public function delete_user( $user_id ) {
    	User::find($user_id)->delete() ;
    	return redirect( "admin/dashboard" ) ;
    }


    
    private function get_avatar( $user_id ) {
        if ( UserMedia::whereUserId( $user_id )->whereMediaType( "avatar" )->count() == 1 ) {
            return "imgs/avatar/" . ( UserMedia::whereUserId( $user_id )->whereMediaType( "avatar" )->first() )->media_path ;
        } else {
            return "defaults/avatar.png" ;
        }
    }

    private function get_background( $user_id ) {

        if ( UserMedia::whereUserId( $user_id )->whereMediaType( "background" )->count() == 1 ) {
            return "imgs/background/" . ( UserMedia::whereUserId( $user_id )->whereMediaType( "background" )->first() )->media_path ;
        } else {
            return "defaults/background.jpg" ;
        }
    }

    public function create_user() {
        return view( "user" ) ;
    }

    public function post_user(Request $request) {


        $this->validate($request, [
            'username'          => 'required|unique:users|max:255',
            'email'             => 'required|unique:users|max:255',
            'name'              => 'required',
            'surname'           => 'required',
            'role'              => 'required',
        ]);

        $new_user               = User::create([
            'username'          => $request->username,
            'name'              => $request->name,
            'surname'           => $request->surname,
            'dob'               => isset( $request->dob ) ? $request->dob : '',
            'dod'               => isset( $request->dod) ? $request->dod : '',
            'cause_of_death'    => isset( $request->cause_of_death ) ? $request->cause_of_death : '',
            'summary'           => isset( $request->summary ) ? $request->summary : '',
            'is_active'         => 1,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
        ]);

        if ( $new_user ) $new_user->assignRole( $request->role ) ;

        session()->flash("success_message", "Successfully created a new user.") ;
        return redirect()->back() ;
    }
}
