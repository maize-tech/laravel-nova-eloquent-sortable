<?php

namespace Maize\NovaEloquentSortable\Actions;

use Laravel\Nova\Http\Requests\NovaRequest;

class CanSeeSortableAction
{
    public function __invoke(NovaRequest $request, $model = null): bool
    {
        return true;
    }
}
