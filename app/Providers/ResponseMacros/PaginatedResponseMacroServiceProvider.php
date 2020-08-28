<?php

namespace App\Providers\ResponseMacros;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class PaginatedResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register paginated response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('paginated', function (LengthAwarePaginator $paginator, string $resource) {
            $collection = $resource::collection($paginator);
            return new JsonResponse([
                'success' => true,
                'data' => $collection,
                'pagination' => [
                    'total' => $paginator->total(),
                    'count' => $paginator->count(),
                    'per_page' => $paginator->perPage(),
                    'current_page' => $paginator->currentPage(),
                    'total_pages' => $paginator->lastPage(),
                ],
            ]);
        }
        );
    }
}
