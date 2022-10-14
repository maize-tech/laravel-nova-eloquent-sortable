<?php

namespace Maize\NovaEloquentSortable\Actions;

use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class MoveToEndAction extends EloquentSortableAction
{
    public function name(): string
    {
        return __('Move to end');
    }

    public static function canSeeSortable(NovaRequest $request, $model = null, $resource = null): bool
    {
        if ($model?->isLastInOrder()) {
            return false;
        }

        if (static::isUriKey($request->action)) {
            return true;
        }

        return parent::canSeeSortable($request, $model, $resource);
    }

    public function handle(ActionFields $fields, Collection $models): mixed
    {
        $models->each->moveToEnd();

        return Action::message(__('Order moved to end.'));
    }
}
