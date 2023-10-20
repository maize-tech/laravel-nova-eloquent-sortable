<?php

namespace Maize\NovaEloquentSortable\Actions;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;

class CanRunSortableAction
{
    public function __invoke(NovaRequest $request, Model $model): bool
    {
        return true;
    }
}
