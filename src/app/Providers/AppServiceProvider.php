<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ゲートの登録
        // 認証済みユーザー（ユーザーインスタンス）を取得できれば、コールバックが実行される
        Gate::define('view-admin-page', function (User $user) {
            return $user->is_admin;
        });
    }
}
