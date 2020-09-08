# Laravel API Boilerplate

This repository is forked from [laravel/laravel](https://github.com/laravel/laravel) and represents configrations, console commands and abstractions our team came with developing Web APIs with Laravel.

-   [Artisan Code Generator Shorthand](#artisan-code-generator-shorthand)
-   [Linting](#linting)
-   [Response macros](#response-macros)
-   [Todo](#todo)

## Artisan Code Generator Shorthand

In order to minimize boilerplate code generation process we came up with the idea to union needed commands in one to generate required components for new entities.

| Signature                       | Short Description                                       |
| ------------------------------- | ------------------------------------------------------- |
| `app:make-api {name} {--pivot}` | Generate model, factory, resource, policy and migration |

**Note:** with `--pivot` option a pivot model will be generated (pivot model wont have resource and policy for obvious reasons).

## Linting

Application utilizes [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) to lint the codebase.
Codesniffer configrations are based in `phpcs.xml` and contain basic rules we use to while developing. Feel free to modify it to your needs.

Following artisan console command was added on top of the PHP_CodeSniffer:

| Signature          | Short Description                          |
| ------------------ | ------------------------------------------ |
| `app:lint {--fix}` | Lint application code with PHP_CodeSniffer |

## Response macros

We added some of the most used JSON response macros to the application to have all our responses consistent and structured.

```php
/**
 * @param mixed $data
 * @param int? $status (200)
 */
response()->success(new UserResource($user)); // {"success":true,"data":{"id":1,"email":"email@mail.com"}}
{
    "success":true,
    "data":{
        "id": 1,
        "email": "email@mail.com"
    }
}

/**
 * @param string $message
 * @param int? $status (200)
 */
response()->successMessage(trans('messages.success')); // {"success":true,"data":{"message":"messages.success"}}

/**
 * @param mixed $data
 */
response()->created(new UserResource($user)); // {"success":true,"data":{"id":1,"email":"email@mail.com"}} <- status code 201

/**
 * @param string $message
 */
response()->createdMessage(trans('messages.created')); // {"success":true,"data":{"message":"messages.created"}} <- status code 201

/**
 * @param mixed $data
 * @param int? $status (400)
 */
response()->error(trans('messages.invalid_email')); // {"success":false,"error":"messages.invalid_email"} <- status code 400

/**
 * @param string $message
 * @param int? $status (400)
 */
response()->errorMessage(trans('messages.invalid_email')); // {"success":false,"error":{"message":"messages.invalid_email"}}

/**
 * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
 * @param string $resourceClassName
 */
response()->paginated(User::paginate(), UserResource::class);
// {
//     "success":true,
//     "data": [
//         {"id":1,"email":"email@mail.com"},
//         {"id":2,"email":"email2@mail.com"}
//     ],
//     "pagination": {
//         "total":2,
//         "count":2,
//         "per_page":10,
//         "current_page":1,
//         "total_pages":1
//     }
// }
```

## Todo

-   [x] Add PHP_CodeSniffer lint.
-   [x] Remove package.json and sass/js default resources.
-   [x] Add `app:make-api` shorthand command.
-   [x] Setup common response marcos.
-   [x] Adjust test, request, console command stubs.
-   [x] Remove console, channels, web routes and configure the route service providers.
-   [x] Install and configure `laravel/passport`.
-   [x] Add Services/Repositories.
-   [x] Setup testing environment (phpunit.xml, exception handler, passport migraitions, response macro, resource helpers).
