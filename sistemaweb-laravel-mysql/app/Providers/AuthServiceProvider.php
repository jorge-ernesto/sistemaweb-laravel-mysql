<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
         * Definimos Gates
         * Gates reciben user autenticado de forma automatica
         */         
        Gate::define('haveaccess', function(User $user, $perm){
            //Verificacion de usuario autenticado
            // dump($user, $perm);
            // echo "<pre>";
            // echo $user;
            // echo "</pre>";
            //Cerrar Verificacion de usuario autenticado

            return $user->havePermission($perm);
        });
    }
}
