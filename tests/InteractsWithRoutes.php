<?php

namespace Tests;

use Illuminate\Support\Facades\Route;
use InvalidArgumentException;

trait InteractsWithRoutes
{
    /**
     * Assert if the route has middleware.
     *
     * @param string $routeName
     * @param array $middleware
     *
     * @return void
     */
    public function assertRouteHasMiddleware(string $routeName, array $middleware): void
    {
        $route = Route::getRoutes()->getByName($routeName);

        if (!$route) {
            throw new InvalidArgumentException('Route named "' . $routeName . '" doesn\'t exist!');
        }

        $routeMiddlewareMap = array_flip($route->gatherMiddleware());

        foreach ($middleware as $middlewareName) {
            $this->assertArrayHasKey(
                $middlewareName,
                $routeMiddlewareMap,
                'Route "' . $routeName . '" doesn\'t apply "' . $middlewareName . '" middleware'
            );
        }
    }
}
