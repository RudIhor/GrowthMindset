<?php

namespace App\Providers;

use App\Guards\TokenGuard;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::extend('token', function (Application $app, string $name, array $config) {
            return new TokenGuard(Auth::createUserProvider($config['provider']));
        });
    }
}
