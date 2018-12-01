<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        // custom provider
        \Auth::provider('own-user', function ($app, $config) {
            return new OwnUserProvider($this->app['hash'], $config['model']);
        });

        // ACL
        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function($user) use($permission){
                return $user->hasRole($permission->roles);   
            });
        }
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
