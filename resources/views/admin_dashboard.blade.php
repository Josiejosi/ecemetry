@extends('layouts.app')

@section('content')

    <div class="container">
        
        <div class="row">
            
            <div class="col-sm-8">

                <p><a href="{{ url('user/create') }}" class="btn btn-default">New User</a></p>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Date Of Birth</th>
                                <th>Date Of Death</th>
                                <th>Cause Of Birth</th>
                                <th>
                                    <p class="text-center"><i class="fa fa-gear"></i></p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if ($user->is_active === 1 && !$user->hasRole( "Admin" ) )
                                    <tr>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->name}} {{$user->surname}}</td>
                                        <td>{{$user->dob}}</td>
                                        <td>{{$user->dod}}</td>
                                        <td>{{$user->cause_of_death}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ url( 'edit/user' ) }}/{{ $user->id }}" target="_blank" class="btn btn-info">
                                                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ url( 'delete/user' ) }}/{{ $user->id }}" class="btn btn-danger">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ url( 'block/user' ) }}/{{ $user->id }}" class="btn btn-warning">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>

            @include("includes.nav")

        </div>

    </div>


	<!-- Footer -->

	<div class="container">
		<hr >
        <div class="text-center center-block">
            <p class="txt-railway">- Profiling -</p>
            <br />
            <a href="https://www.facebook.com/"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
            <a href="https://twitter.com/"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
            <a href="https://plus.google.com/"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
		</div>

	</div>

@endsection
