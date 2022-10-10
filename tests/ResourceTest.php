<?php

use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Fields\OrderColumn;
use Maize\NovaEloquentSortable\Tests\Support\Models\Item;
use Maize\NovaEloquentSortable\Tests\Support\Resources\ItemResource;

it('can use order column field', function () {
    $field = OrderColumn::new('Order column', ItemResource::class);

    expect($field->name)->toBe('Order column');
    expect($field->attribute)->toBe('order_column');
    expect($field->showOnIndex)->toBeTrue();
});

it('can sort by order_column', function () {
    $request = new NovaRequest();
    $query = Item::query()->orderBy('id');

    $query = ItemResource::indexQuery($request, $query);

    expect($query->toSql())->toBe('select * from "test_models" order by "order_column" asc');
});
