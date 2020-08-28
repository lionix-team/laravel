<?php

namespace App\Providers\ResponseMacros;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class SuccessResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register success response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, int $status = null): JsonResponse {
            return new JsonResponse([
                'success' => true,
                'data' => $data,
            ], $status ?? JsonResponse::HTTP_OK);
        });

        Response::macro('successMessage', function ($message, int $status = null): JsonResponse {
            return Response::success(compact('message'), $status);
        });

        Response::macro('created', function ($data): JsonResponse {
            return Response::success($data, JsonResponse::HTTP_CREATED);
        });

        Response::macro('createdMessage', function ($message): JsonResponse {
            return Response::successMessage($message, JsonResponse::HTTP_CREATED);
        });
    }
}
