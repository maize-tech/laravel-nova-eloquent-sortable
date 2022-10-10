<?php

namespace Maize\NovaEloquentSortable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NovaEloquentSortableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-nova-eloquent-sortable')
            ->hasConfigFile();
    }
}
