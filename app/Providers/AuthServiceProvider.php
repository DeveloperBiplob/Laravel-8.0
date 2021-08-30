<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
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

        // Gates define---->

        Gate::define('isSupperAdmin', function (User $user) {
            return $user->role === 'supperAdmin';
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('isEditor', function (User $user) {
            return $user->role === 'editor';
        });

        

        Gate::define('edit-category', function(User $user, Category $category){
            return $user->id === $category->user_id;
        });
    }
}
