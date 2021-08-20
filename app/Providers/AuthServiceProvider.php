<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Models\Permission;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Question' => 'App\Policies\rolePolicy',
        'App\Models\Answere' => 'App\Policies\rolePolicy',
        'App\Models\user' => 'App\Policies\rolePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        foreach ($this->getPermission() as $permission) {
            $gate->define($permission->name, function($user) use ($permission) {
               return $user->hasRole($permission->roles);
            });
        }
    }

    protected function getPermission(){
        return Permission::with('roles')->get();
    }
}
