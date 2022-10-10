<?php

namespace Maize\NovaEloquentSortable\Tests\Support\Resources;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maize\NovaEloquentSortable\Concerns\HasEloquentSortable;
use Maize\NovaEloquentSortable\Tests\Support\Models\Item;

class ItemResource extends Resource
{
    use HasEloquentSortable;

    public static $model = Item::class;

    public function fields(NovaRequest $request)
    {
        return [];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}
