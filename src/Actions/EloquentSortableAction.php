<?php

namespace Maize\NovaEloquentSortable\Actions;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Support\Config;

abstract class EloquentSortableAction extends Action
{
    public function __construct()
    {
        $this
            ->onlyInline()
            ->canSee(fn (NovaRequest $request) => static::canSeeSortable($request))
            ->canRun(fn (NovaRequest $request, Model $model) => static::canRunSortable($request, $model));
    }

    public static function canSeeSortable(NovaRequest $request): bool
    {
        return Config::getCanSeeSortableAction()($request);
    }

    public static function canRunSortable(NovaRequest $request, Model $model): bool
    {
        return Config::getCanRunSortableAction()($request, $model);
    }
}
