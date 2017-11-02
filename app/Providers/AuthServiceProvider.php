<?php

namespace App\Providers;

use App\Permission ;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Authorization using gate facade.
        //
        foreach ( $this->getPermissions() as $permission ) {

            Gate::define( $permission->name, function( $user ) use ( $permission ) {
                return $user->hasRole( $permission->roles() ) ;
            }) ;

        }
    }

    protected function getPermissions() {

        if ( Schema::hasTable('permissions') ) {
            if ( Permission::count() > 0 ) {
                return Permission::with('roles')->get() ;
            }
        }

        return [] ;
    }
}
