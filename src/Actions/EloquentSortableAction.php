<?php

namespace Maize\NovaEloquentSortable\Actions;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maize\NovaEloquentSortable\Support\Config;

abstract class EloquentSortableAction extends Action
{
    public static function for(Resource $resource): self
    {
        return static::make()
            ->withoutConfirmation()
            ->onlyInline()
            ->canSee(fn (NovaRequest $request) => static::canSeeSortable(
                $request,
                $resource->model()
            ));
    }

    public static function canSeeSortable(NovaRequest $request, $model = null): bool
    {
        return Config::getCanSeeSortableAction()($request, $model);
    }

    public static function isUriKey(?string $uri): bool
    {
        return $uri === static::make()->uriKey();
    }
}
