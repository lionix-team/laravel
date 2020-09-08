<?php

namespace App\Providers;

use App\Providers\Routes\ApiRouteSerivceProvider;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register route service providers.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ApiRouteSerivceProvider::class);
    }
}
