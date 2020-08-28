<?php

namespace App\Providers;

use App\Providers\ResponseMacros\ErrorResponseMacroServiceProvider;
use App\Providers\ResponseMacros\PaginatedResponseMacroServiceProvider;
use App\Providers\ResponseMacros\SuccessResponseMacroServiceProvider;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register response macro service providers.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(SuccessResponseMacroServiceProvider::class);
        $this->app->register(ErrorResponseMacroServiceProvider::class);
        $this->app->register(PaginatedResponseMacroServiceProvider::class);
    }
}
