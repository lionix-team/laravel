<?php

namespace App\Providers\ResponseMacros;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ErrorResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register error response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('error', function ($data, int $status = null): JsonResponse {
            return new JsonResponse([
                'success' => false,
                'error' => $data,
            ], $status ?? JsonResponse::HTTP_BAD_REQUEST);
        });

        Response::macro('errorMessage', function ($message, int $status = null): JsonResponse {
            return Response::error(compact('message'), $status);
        });

        Response::macro('unauthenticated', function ($message) {
            return Response::errorMessage(
                $message, JsonResponse::HTTP_UNAUTHORIZED
            );
        });

        Response::macro('forbidden', function ($message): JsonResponse {
            return Response::errorMessage(
                $message, JsonResponse::HTTP_FORBIDDEN
            );
        });

        Response::macro('notFound', function ($message): JsonResponse {
            return Response::errorMessage(
                $message, JsonResponse::HTTP_NOT_FOUND
            );
        });
    }
}
