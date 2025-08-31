<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        Model::automaticallyEagerLoadRelationships();

        Gate::define('add-friend', [UserPolicy::class, 'addFriend']);
        Gate::define('remove-friend', [UserPolicy::class, 'removeFriend']);
        Gate::define('send-message', [UserPolicy::class, 'sendMessage']);
        Gate::define('view-message', [UserPolicy::class, 'viewMessage']);
        Gate::define('update-profile', [UserPolicy::class, 'update']);
        Gate::define('access', [UserPolicy::class, 'access']);

    }
}
