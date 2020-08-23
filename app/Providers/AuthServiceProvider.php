<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::before(function ($user, $permission){
            if ($user->isAdmin()) {
                return true;
            }

            return $user->permissions()->contains($permission);
        });

        Gate::define('update-users', function ($user) {
            return $user->isAdmin;
        });

        Gate::after(function ($user, $permission, $result, $arguments) {
            if ($user->isAdmin()) {
                return true;
            }

            return $user->permissions()->contains($permission);
        });
    }
}
