<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'label',
    ];

    public $timestamps = false;

    public function permissions() {
    	return $this->belongsToMany( Permission::class ) ;
    }

    public function assignPermision( Permission $permissions ) {
    	return $this->permissions()->save( $permissions ) ;
    }

    public function addRole($role) {
    	return $this->create( $role ) ;
    }
}
