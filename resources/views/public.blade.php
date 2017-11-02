@extends('layouts.app')

@section('content')

	<div class="container-fluid">
	    <div class="fb-profile">
	        <img align="left" class="fb-image-lg" src="{{ $profile_background }}" alt="Background Image"/>
	        <img align="left" class="fb-image-profile thumbnail" src="{{ $profile_pic }}" alt="Profile Picture"/>
	        <div class="fb-profile-text">
	            <h1>{{ $user->name }} {{ $user->surname }}</h1>
	        </div>
	    </div>
	</div> <!-- /container --> 
	<div class="clearfix"></div>
	<div class="container">
		<div class="row"><div class="col-sm-12"><hr /></div></div>
	</div>
	<div class="container">
		<div class="row">
	    	<div class="col-sm-8">

                <div class="form-group">
                    <label for="username" class="col-md-4 control-label">Username</label>

                    <div class="col-md-6">
                        <label for="username" class="control-label">: {{ $user->username }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <label for="username" class="control-label">: {{ $user->name }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="surname" class="col-md-4 control-label">Surname</label>

                    <div class="col-md-6">
                        <label for="username" class="control-label">: {{ $user->surname }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dob" class="col-md-4 control-label">Date Of Birth</label>

                    <div class="col-md-6">
                        <label for="username" class="control-label">: {{ $user->dob }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cause_of_death" class="col-md-4 control-label">Cause Of Birth</label>

                    <div class="col-md-6">
                        <label for="username" class="control-label">: {{ $user->cause_of_death }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="summary" class="col-md-4 control-label">Summary</label>

                    <div class="col-md-6">
                        
                        <p>: {{ $user->summary }}</p>

                    </div>
                </div>

	    	</div>

            <div class="col-sm-4">
                <p><a href="{{ $qrcode_url }}">{{ $qrcode_url }}</a></p>
                <p><img src="{!! QrCode::size(200)->generate( $qrcode_url ) !!}"></p>
                <p>
                    <a class="btn btn-danger" target="_blank" href="{{ $pdf_url }}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Save Profile
                    </a>
                </p>
            </div>

	    </div>
	</div>

	<div class="clearfix"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<h1 class="header">Uploaded Media</h1>


				<div class="row">
					@foreach ( $other_images as $image )
					<div class="col-sm-3">
						<div class="thumbnail">
							<img src="{{ asset( 'imgs/other/' . $image->media_path ) }}" alt="{{ $image->media_name }}" width="250px" height="250px">
							<div class="caption">
								<h3>{{ $image->media_name }}</h3>
							</div>
						</div>
					</div>
					@endforeach
				</div>

			</div>


		</div>
	</div>

	<!-- Footer -->

	<div class="container">
		<hr >
        <div class="text-center center-block">
            <p class="txt-railway">- Profiling -</p>
            <br />
            <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
            <a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
            <a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
            <a href="mailto:bootsnipp@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
		</div>

	</div>

@endsection