<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Models\admin_role;
use App\Models\role;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('Has_role', function ($expresstion) {
            if (session()->get('admin_id')) {
                $role = role::where('name', $expresstion)->first();
                if ($role) {
                    $ad = admin_role::where('admin_id', session()->get('admin_id'))->where('role_id', $role->id)->first();
                    if ($ad) {
                        return true;
                    }
                }
                return false;
            }
        });
    }
}
