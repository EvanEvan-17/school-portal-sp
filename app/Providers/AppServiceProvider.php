<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\StudentClass;

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
        Gate::define('add-event', function (User $user) {
            return $user->isSuperAdmin()
            // || (!empty($class->teacher_id) && $user->getKey() == $class->teacher_id);
            ;
        });

        Gate::define('delete-event', function (User $user) {
            return $user->isSuperAdmin();
        });
        // Gate::define('add-event-without-approval', function (User $user, StudentClass $class) {
        //     return $user->isSuperAdmin();
        // });
    }
}
