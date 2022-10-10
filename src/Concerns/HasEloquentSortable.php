<?php

namespace Maize\NovaEloquentSortable\Concerns;

use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Actions\EloquentSortableAction;

trait HasEloquentSortable
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (EloquentSortableAction::canSeeSortable($request)) {
            $query->getQuery()->orders = [];

            return $query->ordered();
        }

        return $query;
    }
}
