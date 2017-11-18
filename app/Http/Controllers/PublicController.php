<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\User ;
use App\UserMedia ;

class PublicController extends Controller
{
    public function index($username) {

    	$user_count = User::whereUsername($username)->count() ;

    	if ( $user_count == 1 ) {

    		$user = User::whereUsername($username)->first() ;

    		$user_id = $user->id ;

	        $data = [
	            'user'                  => $user,
	            'profile_pic'           => asset( $this->get_avatar($user_id) ),
	            'profile_background'    => asset( $this->get_background($user_id) ),
	            'other_images'          => UserMedia::whereUserId( $user_id )->whereMediaType( "other" )->get(),
	            'qrcode_url'            => url('/') . "/view/" .  $username,
	            'pdf_url'				=> url('/') . "/save/pdf/" .  $username,
	        ] ;

	        return view( 'public', $data ) ;
    	} else {
    		return redirect("/") ;
    	}

    }

    public function save_pdf( $username ) {

		$user = User::whereUsername($username)->first() ;

		$user_id = $user->id ;

        $data = [
            'qrcode_url'            => url('/') . "/view/" .  $username,
            'user'                  => $user,
            'profile_pic'           => asset( $this->get_avatar($user_id) ),
        ] ;

        $file_name = $username . "_public_profile.pdf" ;

		$pdf = PDF::loadView( 'profile_pdf', $data ) ;

		return $pdf->stream( $file_name );

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
}
