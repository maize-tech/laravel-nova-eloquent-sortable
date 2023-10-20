<?php

namespace Maize\NovaEloquentSortable\Support;

use Maize\NovaEloquentSortable\Actions\CanRunSortableAction;
use Maize\NovaEloquentSortable\Actions\CanSeeSortableAction;

class Config
{
    public static function getCanSeeSortableAction(): CanSeeSortableAction
    {
        $action = config('nova-eloquent-sortable.can_see_sortable_action')
            ?? CanSeeSortableAction::class;

        return app($action);
    }

    public static function getCanRunSortableAction(): CanRunSortableAction
    {
        $action = config('nova-eloquent-sortable.can_run_sortable_action')
            ?? CanRunSortableAction::class;

        return app($action);
    }
}
