# Laravel API Boilerplate

This repository is forked from [laravel/laravel](https://github.com/laravel/laravel) and represents configrations, console commands and abstractions our team came with developing Web APIs with Laravel.

-   [Linting](#linting)
-   [Artisan Code Generator Shorthand](#artisan-code-generator-shorthand)
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

## Todo

-   [x] Add PHP_CodeSniffer lint.
-   [x] Remove package.json and sass/js default resources.
-   [x] Add `app:make-api` shorthand command.
-   [ ] Setup common response marcos.
-   [ ] Adjust test, request, console command stubs.
-   [ ] Remove console, channels, web routes and configure the route service providers.
-   [ ] Add Guards and guard validation rule.
-   [ ] Install and configure `laravel/passport`.
-   [ ] Add Services/Repositories (service providers, example `UserService` implementation).
-   [ ] Setup testing environment (phpunit.xml, exception handler, passport migraitions, response macro, resource, guards helpers).
