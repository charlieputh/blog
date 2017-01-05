<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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

        // super user
         Gate::define('manageUser',function($user){
            return $user->isAdmin();
         });
        //manage user
        Gate::define('manage',function($user){
            return $user->isAdmin() || $user->isTeacher();
        });
        // //normal user
         Gate::define('opArticle', function($user,$post){
            return ($user->id === $post->user) || $user->isAdmin();
         });
        //
    }
}
