<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class PassportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap passport services.
     *
     * @return void
     */
    public function boot()
    {
        // Passport::routes(function (\Laravel\Passport\RouteRegistrar $router) {
        //     $router->forAccessTokens();
        // });

        Passport::tokensCan(config('passport.scopes'));

        Passport::tokensExpireIn(
            now()->addDays(config('passport.tokens_expire_in'))
        );

        Passport::personalAccessTokensExpireIn(
            now()->addDays(config('passport.personal_access_tokens_expire_in'))
        );

        Passport::refreshTokensExpireIn(
            now()->addDays(config('passport.refresh_tokens_expire_in'))
        );
    }
}
