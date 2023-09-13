<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // ロールが1なら管理者ユーザー
        Gate::define('admin-higher', function ($user) {
            return ($user->role == 1);
        });
        // ロールが0なら一般ユーザー
        Gate::define('user-higher', function ($user) {
            return ($user->role == 0);
        });
    }
}
