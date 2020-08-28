# Laravel API Boilerplate

This repository is forked from [laravel/laravel](https://github.com/laravel/laravel) and represents configrations, console commands and abstractions our team came with developing Web APIs with Laravel.

-   [Linting](#linting)

## Linting

Application utilizes [squizlabs/php_codesniffer](https://github.com/squizlabs/PHP_CodeSniffer) to lint the codebase.
Codesniffer configrations are based in `phpcs.xml` and contain basic rules we use to while developing. Feel free to modify it to your needs.

Following artisan console command was added on top of the PHP_CodeSniffer:

| Signature          | Short Description                          |
| ------------------ | ------------------------------------------ |
| `app:lint {--fix}` | Lint application code with PHP_CodeSniffer |
