<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF ;
use App\User ;
use App\UserMedia ;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $data = [
            'user'                  => auth()->user(),
            'profile_pic'           => $this->get_avatar(),
            'profile_background'    => $this->get_background(),
            'other_images'          => UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "other" )->get(),
            'qrcode_url'            => url('/') . "/view/" .  auth()->user()->username,
            'pdf_url'               => url('/') . "/save/user/pdf/" . auth()->user()->username,
        ] ;

        return view( 'dashboard', $data ) ;
    }
    
    public function profile_update( Request $request ) {

        $user                       = User::find( $request->user_id )->update([
            'name'                  => $request->name,
            'surname'               => $request->surname,
            'dob'                   => $request->dob,
            'dod'                   => $request->dod,
            'cause_of_death'        => isset( $request->cause_of_death ) ? $request->cause_of_death : '',
            'summary'               => isset( $request->summary ) ? $request->summary : '' ,
        ]) ;

        return redirect( 'dashboard' ) ;
    }
    
    public function profile_avatar( Request $request ) {

        if ( $request->hasFile('avatar') ) {

            $file                   = $request->file( 'avatar' );
            $name                   = time() . '.' . $file->getClientOriginalExtension();

            $request->file('avatar')->move( "imgs/avatar/", $name );

            if ( UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "avatar" )->count() == 1 ) {
                UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "avatar" )->update([
                    'media_path'    => $name,
                ]) ;
            } else {
                UserMedia::create([
                    'media_type'    => "avatar",
                    'media_name'    => "avatar",
                    'media_path'    => $name,
                    'user_id'       => auth()->user()->id,
                ]) ;
            }

            return redirect( 'dashboard' ) ;
        }

    }
    
    public function profile_background( Request $request ) {

        if ( $request->hasFile('background_iage') ) {

            $file                   = $request->file( 'background_iage' );
            $name                   = time() . '.' . $file->getClientOriginalExtension();

            $request->file( 'background_iage' )->move( "imgs/background/", $name );

            if ( UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "background" )->count() == 1 ) {
                UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "background" )->update([
                    'media_path'    => $name,
                ]) ;
            } else {
                UserMedia::create([
                    'media_type'    => "background",
                    'media_name'    => "background",
                    'media_path'    => $name,
                    'user_id'       => auth()->user()->id,
                ]) ;
            }

            return redirect( 'dashboard' ) ;
        }
    }

    public function profile_other( Request $request ) {

        if ( $request->hasFile('other_image') ) {

            $file                   = $request->file( 'other_image' );
            $name                   = time() . '.' . $file->getClientOriginalExtension();

            $request->file( 'other_image' )->move( "imgs/other/", $name );

            UserMedia::create([
                'media_type'    => "other",
                'media_name'    => $request->file_name,
                'media_path'    => $name,
                'user_id'       => auth()->user()->id,
            ]) ;

            return redirect( 'dashboard' ) ;
        }
    }



    public function save_pdf( $username ) {

        $user = User::whereUsername($username)->first() ;

        $user_id = $user->id ;

        $data = [
            'user'                  => $user,
            'profile_pic'           => asset( $this->get_avatar($user_id) ),
        ] ;

        $file_name = $username . "_public_profile.pdf" ;

        $pdf = PDF::loadView( 'profile_pdf', $data ) ;

        return $pdf->stream( $file_name );

    }

    private function get_avatar() {
        if ( UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "avatar" )->count() == 1 ) {
            $user_media = UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "avatar" )->first() ;
            return "imgs/avatar/" . $user_media->media_path ;
        } else {
            return "defaults/avatar.png" ;
        }
    }

    private function get_background() {

        if ( UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "background" )->count() == 1 ) {
            $user_media = UserMedia::whereUserId( auth()->user()->id )->whereMediaType( "avatar" )->first() ;
            return "imgs/background/" . $user_media->media_path ;
        } else {
            return "defaults/background.jpg" ;
        }
    }
}
