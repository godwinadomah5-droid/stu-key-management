<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define role-based gates
        Gate::define('access-security', function ($user) {
            return $user->hasRole('security');
        });

        Gate::define('access-hr', function ($user) {
            return $user->hasRole('hr');
        });

        Gate::define('access-admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('access-manager', function ($user) {
            return $user->hasRole('manager');
        });

        // You can add more gates for other roles as needed
        Gate::define('access-auditor', function ($user) {
            return $user->hasRole('auditor');
        });

        Gate::define('access-finance', function ($user) {
            return $user->hasRole('finance');
        });

        Gate::define('access-it', function ($user) {
            return $user->hasRole('it');
        });
    }
}