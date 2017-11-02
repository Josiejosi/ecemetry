<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'label',
    ];

    public $timestamps = false;

    public function addPermission( $permission ) {

    	return $this->create( $permission ) ;
    	
    }

    public function roles() {

    	return $this->belongsToMany( Role::class ) ;

    }
}
