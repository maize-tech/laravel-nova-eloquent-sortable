# Laravel Nova Eloquent Sortable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/maize-tech/laravel-nova-eloquent-sortable.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-nova-eloquent-sortable)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/maize-tech/laravel-nova-eloquent-sortable/run-tests?label=tests)](https://github.com/maize-tech/laravel-nova-eloquent-sortable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/maize-tech/laravel-nova-eloquent-sortable/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/maize-tech/laravel-nova-eloquent-sortable/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/maize-tech/laravel-nova-eloquent-sortable.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-nova-eloquent-sortable)

This package allows you to easily add sortable actions to any model in Laravel Nova.

> This project is a work-in-progress. Code and documentation are currently under development and are subject to change.

## Installation

You can install the package via composer:

```bash
composer require maize-tech/laravel-nova-eloquent-sortable
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nova-eloquent-sortable-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Sortable permission action
    |--------------------------------------------------------------------------
    |
    | Here you may specify the fully qualified class name of the invokable class
    | used to determine whether a user can see and perform sorts to a given model
    | or not.
    | If null, all users who have access to Nova will have the permission.
    |
    */

    'can_see_sortable_action' => null,

];
```

## Usage

```php
$eloquentSortable = new Maize\EloquentSortable();
echo $eloquentSortable->echoPhrase('Hello, Maize!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Enrico De Lazzari](https://github.com/enricodelazzari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
