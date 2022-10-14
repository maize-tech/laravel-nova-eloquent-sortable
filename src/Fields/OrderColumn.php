<?php

namespace Maize\NovaEloquentSortable\Fields;

use Laravel\Nova\Fields\Number;
use Maize\NovaEloquentSortable\Actions\EloquentSortableAction;

class OrderColumn extends Number
{
    public static function new(
        mixed $name,
        string $resource
    ) {
        return static::make($name, static::attribute($resource))
            ->onlyOnIndex()
            ->canSee(fn ($request) => EloquentSortableAction::canSeeSortable($request, null, static::class));
    }

    public static function attribute(string $resource): string
    {
        return (new $resource::$model)->determineOrderColumnName();
    }
}
