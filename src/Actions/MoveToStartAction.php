<?php

namespace Maize\NovaEloquentSortable\Actions;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class MoveToStartAction extends EloquentSortableAction
{
    public function name(): string
    {
        return __('Move to start');
    }

    public static function canSeeSortable(NovaRequest $request, $model = null, $resource = null): bool
    {
        if ($model?->isFirstInOrder()) {
            return false;
        }

        if (static::isUriKey($request->action)) {
            return true;
        }

        return parent::canSeeSortable($request, $model, $resource);
    }

    public function handle(ActionFields $fields, Collection $models): mixed
    {
        $models->each->moveToStart();

        return Action::message(__('Order moved to start.'));
    }
}
