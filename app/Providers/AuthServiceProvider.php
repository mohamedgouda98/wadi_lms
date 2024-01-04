<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('student', function ($user) {
            return $user->user_type == 'Student';
        });

        Gate::define('admin', function ($user) {
            return $user->user_type == 'Admin';
        });

        Gate::define('instructor', function ($user) {
            return $user->user_type == 'Instructor';
        });

        Passport::routes();
    }
}
