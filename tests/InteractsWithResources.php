<?php

namespace Tests;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Testing\TestResponse;
use Throwable;

trait InteractsWithResources
{
    /**
     * Check if response resource is of a given type.
     *
     * @param string $resourceClassName
     * @param \Illuminate\Testing\TestResponse $response
     * @param string $message
     *
     * @return void
     */
    public function assertJsonResponseResource(
        string $resourceClassName,
        TestResponse $response,
        string $message = 'The response resource %s does not match the %s resource'
    ): void {
        $responseOriginal = $response->baseResponse->getOriginalContent();
        try {
            $this->assertInstanceOf($resourceClassName, $responseOriginal['data']);
        } catch (Throwable $t) {
            $data = $responseOriginal['data'] ?? null;

            $this->assertTrue(false, sprintf(
                $message,
                is_object($data) ? get_class($data) : gettype($data),
                $resourceClassName
            ));
        }
    }

    /**
     * Check if response resource colection is of a given type.
     *
     * @param string $resourceClassName
     * @param \Illuminate\Testing\TestResponse $response
     * @param string $message
     *
     * @return void
     */
    public function assertJsonResponseResourceCollection(
        string $resourceClassName,
        TestResponse $response,
        string $message = 'The response collection does not match the %s resource collection'
    ): void {
        $responseOriginal = $response->baseResponse->getOriginalContent();
        try {
            $this->assertInstanceOf(AnonymousResourceCollection::class, $responseOriginal['data'], $message);

            foreach ($responseOriginal['data'] as $resource) {
                $this->assertInstanceOf($resourceClassName, $resource);
            }
        } catch (Throwable $t) {
            $this->assertTrue(false, sprintf($message, $resourceClassName));
        }

    }
}
