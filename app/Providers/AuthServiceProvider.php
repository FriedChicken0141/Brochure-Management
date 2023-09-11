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

        // ロールIDが1なら一般ユーザー
        Gate::define('admin-higher', function ($user) {
            return ($user->role_id == 1);
        });
        // ロールIDが0なら管理者
        Gate::define('user-higher', function ($user) {
            return ($user->role_id == 0);
        });
    }
}
