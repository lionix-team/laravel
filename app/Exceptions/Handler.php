<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class,
        \Illuminate\Validation\UnauthorizedException::class,
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Http\Exceptions\ThrottleRequestsException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\Console\Exception\CommandNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Get the context with request and url variables for logging.
     *
     * @return array
     */
    protected function context()
    {
        return array_merge(
            parent::context(),
            [
                'url' => request()->fullUrl(),
                'request' => request()->except($this->dontFlash),
            ]
        );
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        return response()
            ->error($e->errors(), $e->status);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()
            ->unauthenticated($exception->getMessage());
    }

    /**
     * Define if given exception should render as not found.
     *
     * @param  \Throwable  $e
     * @return boolean
     */
    protected function isHttpNotFoundException(Throwable $e)
    {
        return $e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException || $e instanceof MethodNotAllowedHttpException;
    }

    /**
     * Define if given exception should render as forbidden.
     *
     * @param  \Throwable  $e
     * @return boolean
     */
    protected function isForbiddenException(Throwable $e)
    {
        return $e instanceof ThrottleRequestsException || $e instanceof AuthorizationException;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request   Request class instance
     * @param \Throwable               $exception Throwable class instance
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->isHttpNotFoundException($e)) {
            return response()->notFound($e->getMessage() ?: trans('messages.http.404'));
        }

        if ($this->isForbiddenException($e)) {
            return response()->forbidden($e->getMessage());
        }

        return parent::render($request, $e);
    }
}
