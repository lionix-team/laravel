# Laravel API Boilerplate

This repository is forked from [laravel/laravel](https://github.com/laravel/laravel) and represents configrations, console commands and abstractions our team came with developing Web APIs with Laravel.

-   [Linting](#linting)
-   [Todo](#todo)

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
-   [ ] Add `app:make-api` shorthand command.
-   [ ] Setup common response marcos.
-   [ ] Adjust test, request, console command stubs.
-   [ ] Remove console, channels, web routes and configure the route service providers.
-   [ ] Add Guards and guard validation rule.
-   [ ] Install and configure `laravel/passport`.
-   [ ] Add Services/Repositories (service providers, example `UserService` implementation).
-   [ ] Setup testing environment (phpunit.xml, exception handler, passport migraitions, response macro, resource, guards helpers).
