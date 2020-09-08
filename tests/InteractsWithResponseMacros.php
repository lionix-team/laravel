<?php

namespace Tests;

use Illuminate\Testing\TestResponse;

trait InteractsWithResponseMacros
{
    /**
     * Assert paginated response macro.
     *
     * @param \Illuminate\Testing\TestResponse $response
     *
     * @return void
     */
    public function assertPaginatedJsonResponse(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'success',
            'data',
            'pagination' => [
                'total',
                'count',
                'per_page',
                'current_page',
                'total_pages',
            ],
        ]);
    }

    /**
     * Assert success response macro.
     *
     * @param \Illuminate\Testing\TestResponse $response
     *
     * @return void
     */
    public function assertSuccessJsonResponse(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'success',
            'data',
        ]);
    }

    /**
     * Assert success message response macro.
     *
     * @param \Illuminate\Testing\TestResponse $response
     *
     * @return void
     */
    public function assertSuccessMessageJsonResponse(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'success',
            'data' => [
                'message',
            ],
        ]);
    }

    /**
     * Assert error response macro.
     *
     * @param \Illuminate\Testing\TestResponse $response
     *
     * @return void
     */
    public function assertErrorJsonResponse(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'success',
            'error',
        ]);
    }

    /**
     * Assert error message response macro.
     *
     * @param \Illuminate\Testing\TestResponse $response
     *
     * @return void
     */
    public function assertErrorMessageJsonResponse(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'success',
            'error' => [
                'message',
            ],
        ]);
    }
}
