<?php 

	namespace App ;

	trait HasRoles {
		
    	public function roles() {

	        return $this->belongsToMany( Role::class ) ;

	    }

	    public function assignRole( $role ) {

	    	if ( is_string( $role ) ) 
	    		return $this->roles()->save( Role::whereName( $role )->first() ) ;

	    	return $this->roles()->save($role) ;

	    }

	    public function hasRole( $role ) {

	        if ( is_string( $role ) ) 
	            return $this->roles->contains( "name", $role ) ;

	        return !! $role->insect( $this->roles )->count() ;

	    }

	}
