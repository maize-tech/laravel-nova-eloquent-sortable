# Laravel Nova Eloquent Sortable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/maize-tech/laravel-nova-eloquent-sortable.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-nova-eloquent-sortable)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/maize-tech/laravel-nova-eloquent-sortable/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/maize-tech/laravel-nova-eloquent-sortable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/maize-tech/laravel-nova-eloquent-sortable/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/maize-tech/laravel-nova-eloquent-sortable/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/maize-tech/laravel-nova-eloquent-sortable.svg?style=flat-square)](https://packagist.org/packages/maize-tech/laravel-nova-eloquent-sortable)

Easily add inline sortable actions to any resource in Laravel Nova.

>This package is heavily based on Spatie's [Eloquent Sortable](https://github.com/spatie/eloquent-sortable).
>Please make sure to read its documentation and installation guide before proceeding!

<p align="center"><img src="/art/preview.gif" alt="Laravel Nova Eloquent Sortable in action"></p>

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
    | See sortable action permission
    |--------------------------------------------------------------------------
    |
    | Here you may specify the fully qualified class name of the invokable class
    | used to determine whether a user can see sortable actions or not.
    | If null, all users who have access to Nova will have the permission.
    |
    */

    'can_see_sortable_action' => null,

    /*
    |--------------------------------------------------------------------------
    | Run sortable action permission
    |--------------------------------------------------------------------------
    |
    | Here you may specify the fully qualified class name of the invokable class
    | used to determine whether a user can sort a given model or not.
    | If null, all users who have access to Nova will have the permission.
    |
    */

    'can_run_sortable_action' => null,

];
```

## Usage

To use the package, add the `Maize\NovaEloquentSortable\HasEloquentSortable` trait to the nova resource where you want to have marks:

```php
use Laravel\Nova\Resource;
use Maize\NovaEloquentSortable\HasEloquentSortable;

class MyResource extends Resource {
    use HasEloquentSortable;
}
```

Once done, all you have to do is include all the actions you need for the given resource:

```php
use Maize\NovaEloquentSortable\Actions\MoveOrderDownAction;
use Maize\NovaEloquentSortable\Actions\MoveOrderUpAction;
use Maize\NovaEloquentSortable\Actions\MoveToEndAction;
use Maize\NovaEloquentSortable\Actions\MoveToStartAction;

public function actions(NovaRequest $request)
{
    return [
        MoveOrderDownAction::make(),
        MoveToEndAction::make(),
        MoveOrderUpAction::make(),
        MoveToStartAction::make(),
    ];
}
```

You can also include the custom OrderColumn field, which allows you to show the order of each entity when indexing them:

```php
use Maize\NovaEloquentSortable\Fields\OrderColumn;

public function fields(NovaRequest $request)
{
    return [
        OrderColumn::new('Order', static::class),
    ];
}
```

## Available Actions

- [`MoveOrderDownAction`](#moveorderdownaction)
- [`MoveToEndAction`](#movetoendaction)
- [`MoveOrderUpAction`](#moveorderupaction)
- [`MoveToStartAction`](#movetostartaction)

### MoveOrderDownAction

The `MoveOrderDownAction` inline action moves the given model down by a single position.

The action is automatically hidden when the model is already in the last position.

### MoveToEndAction

The `MoveToEndAction` inline action moves the given model to the last position.

The action is automatically hidden when the model is already in the last position.

### MoveOrderUpAction

The `MoveOrderUpAction` inline action moves the given model up by a single position.

The action is automatically hidden when the model is already in the first position.

### MoveToStartAction

The `MoveToStartAction` inline action moves the given model to the first position.

The action is automatically hidden when the model is already in the first position.

## Define a custom visibility

By default, all users who have access to Laravel Nova will be able to see all included sort actions.

If you want to restrict their visibility for some users, you can define a custom `CanSeeSortableAction` invokable class.

Here's an example class checking user's permissions:

```php
use Laravel\Nova\Http\Requests\NovaRequest;

class CanSeeSortableAction
{
    public function __invoke(NovaRequest $request): bool
    {
        return $request->user()->can('sort_models');
    }
}
```

Once done, all you have to do is reference your custom class in `can_see_sortable_action` attribute under `config/nova-eloquent-sortable.php`:

``` php
'can_see_sortable_action' => \Path\To\CanSeeSortableAction::class,
```

## Define a custom run permission

By default, all users who have access to Laravel Nova will be able to run all included sort actions.

If you want to restrict the permission for some users, you can define a custom `CanRunSortableAction` invokable class.

Here's an example class checking user's permissions:

```php
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;

class CanRunSortableAction
{
    public function __invoke(NovaRequest $request, Model $model): bool
    {
        return $request->user()->can('sort_model', $model);
    }
}
```

Once done, all you have to do is reference your custom class in `can_run_sortable_action` attribute under `config/nova-eloquent-sortable.php`:

``` php
'can_run_sortable_action' => \Path\To\CanRunSortableAction::class,
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/maize-tech/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/maize-tech/.github/security/policy) on how to report security vulnerabilities.

## Credits

- [Enrico De Lazzari](https://github.com/enricodelazzari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
