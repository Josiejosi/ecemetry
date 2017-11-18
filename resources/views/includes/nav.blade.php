            <div class="col-sm-4">
                <a href="{{ url( 'admin/dashboard' ) }}" class="btn btn-success btn-block">
                    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
                </a>
                <a href="{{ url( 'edit/user' ) }}/{{ auth()->user()->id }}" class="btn btn-info btn-block">
                    <i class="fa fa-list-ol" aria-hidden="true"></i> View My Profile
                </a>
                <a href="{{ url( 'change_password' ) }}" class="btn btn-danger btn-block">
                    <i class="fa fa-user" aria-hidden="true"></i> Change Password
                </a>                
            </div>