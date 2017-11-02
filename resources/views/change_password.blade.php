@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="row">
            
            <div class="col-sm-8">

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" readonly="true" name="email" value="{{ auth()->user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                
            </div>

            <div class="col-sm-4">
                <a href="{{ url( 'admin/dashboard' ) }}" class="btn btn-success btn-block">
                    <i class="fa fa-home" aria-hidden="true"></i> Home
                </a>
                <a href="{{ url( 'edit/user' ) }}/{{ auth()->user()->id }}" class="btn btn-info btn-block">
                    <i class="fa fa-list-ol" aria-hidden="true"></i> View My Profile
                </a>
                <a href="{{ url( 'change_password' ) }}" class="btn btn-danger btn-block">
                    <i class="fa fa-user" aria-hidden="true"></i> Change Password
                </a>                
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