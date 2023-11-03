<?php

namespace Maize\NovaEloquentSortable\Fields;

use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Actions\EloquentSortableAction;

class OrderColumn extends Number
{
    public static function new(
        mixed $name,
        string $resource
    ) {
        return static::make($name, static::attribute($resource))
            ->onlyOnIndex()
            ->canSee(fn (NovaRequest $request) => EloquentSortableAction::canSeeSortable($request));
    }

    public static function attribute(string $resource): string
    {
        return (new $resource::$model)->determineOrderColumnName();
    }
}
