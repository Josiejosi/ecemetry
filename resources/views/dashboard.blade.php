@extends('layouts.app')

@section('content')

	<div class="container-fluid">
	    <div class="fb-profile">
	        <img align="left" class="fb-image-lg" src="{{ $profile_background }}" alt="Background Image"/>
	        <img align="left" class="fb-image-profile thumbnail" src="{{ $profile_pic }}" alt="Profile Picture"/>
	        <div class="fb-profile-text">
	            <h1>{{ auth()->user()->name }} {{ auth()->user()->surname }}</h1>
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
	    		 <form class="form-horizontal" method="POST" action="{{ url('profile/upload') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" readonly="true" class="form-control" name="username" value="{{ auth()->user()->username }}" required autofocus>

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                        <label for="surname" class="col-md-4 control-label">Surname</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control" name="surname" value="{{ auth()->user()->surname }}" required autofocus>

                            @if ($errors->has('surname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="dob" class="col-md-4 control-label">Date Of Birth</label>

                        <div class="col-md-6">
                            <input id="dob" type="text" class="form-control" name="dob" value="{{ auth()->user()->dob }}" required autofocus>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cause_of_death') ? ' has-error' : '' }}">
                        <label for="cause_of_death" class="col-md-4 control-label">Cause Of Birth</label>

                        <div class="col-md-6">
                            <input id="cause_of_death" type="text" class="form-control" name="cause_of_death" value="{{ auth()->user()->cause_of_death }}" required autofocus>

                            @if ($errors->has('cause_of_death'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cause_of_death') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                        <label for="summary" class="col-md-4 control-label">Summary</label>

                        <div class="col-md-6">
                            
                            <textarea class="form-control" rows="8" name="summary" id="summary">{{ auth()->user()->summary }}</textarea>

                            @if ($errors->has('summary'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('summary') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
	    	</div>

            <div class="col-sm-4">
                <p><a href="{{ $qrcode_url }}">{{ $qrcode_url }}</a></p>
                <p><img src="{!! QrCode::size(200)->generate( $qrcode_url ) !!}"></p>
                <p>
                    <a class="btn btn-danger" target="_blank" href="{{ $pdf_url }}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Save Profile
                    </a>
                </p>
				<form enctype="multipart/form-data" method="post" action="{{ url('profile/avatar') }}">
        			{{ csrf_field() }}
					<input type="file" class="form-control" name="avatar">
					<button class="btn btn-success btn-block">Update Profile Picture</button>
				</form>
				<hr />
				<form enctype="multipart/form-data" method="post" action="{{ url('profile/background') }}">
        			{{ csrf_field() }}
					<input type="file" class="form-control" name="background_iage">
					<button class="btn btn-success btn-block">Update Background Image</button>
				</form>
				<hr />
				<h4>Other Media</h4>
				<form enctype="multipart/form-data" method="post" action="{{ url('profile/other') }}">
        			{{ csrf_field() }}
					<input type="text" class="form-control" name="file_name" placeholder="File name">
					<input type="file" class="form-control" name="other_image" placeholder="Click to select file">
					<button class="btn btn-success btn-block">Add More Images</button>
				</form>
				<hr />

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
					<?php
						$filename = $image->media_path;
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
					?>
					@if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' )
					<div class="col-sm-3">
						<div class="thumbnail">
							<img src="imgs/other/{{ $image->media_path }}" alt="{{ $image->media_name }}" width="250px" height="250px">
							<div class="caption">
								<h3>{{ $image->media_name }}</h3>
							</div>
						</div>
					</div>
					@else
					<div class="col-sm-3">
						<div class="thumbnail">
							
							<video width="250" height="250" controls>
								<source src="imgs/other/{{ $image->media_path }}" type="video/mp4">
							  	<source src="imgs/other/{{ $image->media_path }}" type="video/ogg">
							  	Your browser does not support the video tag.
							</video>
							<div class="caption">
								<h3>{{ $image->media_name }}</h3>
							</div>
						</div>
					</div>
					@endif
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