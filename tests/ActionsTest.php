<?php

use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Actions\MoveOrderDownAction;
use Maize\NovaEloquentSortable\Actions\MoveOrderUpAction;
use Maize\NovaEloquentSortable\Actions\MoveToEndAction;
use Maize\NovaEloquentSortable\Actions\MoveToStartAction;
use Maize\NovaEloquentSortable\Tests\Support\Models\Item;
use Maize\NovaEloquentSortable\Tests\Support\Resources\ItemResource;

it('can see', function (string $class, bool $canSeeFirst, bool $canSeeMiddle, bool $canSeeLast) {
    $request = new NovaRequest();
    $resource = new ItemResource(null);

    $items = Item::factory()->count(5)->create();
    $first = $items->first();
    $middle = $items[2];
    $last = $items->last();

    $action = $class::for($resource);

    expect($action->canSeeSortable($request, $first))->toBe($canSeeFirst);
    expect($action->canSeeSortable($request, $middle))->toBe($canSeeMiddle);
    expect($action->canSeeSortable($request, $last))->toBe($canSeeLast);
})->with([
    [
        'class' => MoveOrderDownAction::class,
        'canSeeFirst' => true,
        'canSeeMiddle' => true,
        'canSeeLast' => false,
    ],
    [
        'class' => MoveToEndAction::class,
        'canSeeFirst' => true,
        'canSeeMiddle' => true,
        'canSeeLast' => false,
    ],
    [
        'class' => MoveOrderUpAction::class,
        'canSeeFirst' => false,
        'canSeeMiddle' => true,
        'canSeeLast' => true,
    ],
    [
        'class' => MoveToStartAction::class,
        'canSeeFirst' => false,
        'canSeeMiddle' => true,
        'canSeeLast' => true,
    ],
]);

it('can move', function (string $class, int $moveFirst, int $moveMiddle, int $moveLast) {
    $resource = new ItemResource(null);
    $fields = new ActionFields(collect(), collect());

    $items = Item::factory()->count(5)->create();
    $first = $items->first();
    $middle = $items[2];
    $last = $items->last();

    $action = $class::for($resource);

    $action->handle($fields, collect([$first->refresh()]));
    expect($first->refresh()->order_column)->toBe($moveFirst);

    $action->handle($fields, collect([$middle->refresh()]));
    expect($middle->refresh()->order_column)->toBe($moveMiddle);

    $action->handle($fields, collect([$last->refresh()]));
    expect($last->refresh()->order_column)->toBe($moveLast);
})->with([
    [
        'class' => MoveOrderDownAction::class,
        'moveFirst' => 2,
        'moveMiddle' => 4,
        'moveLast' => 5,
    ],
    [
        'class' => MoveToEndAction::class,
        'moveFirst' => 5,
        'moveMiddle' => 5,
        'moveLast' => 5,
    ],
    [
        'class' => MoveOrderUpAction::class,
        'moveFirst' => 1,
        'moveMiddle' => 2,
        'moveLast' => 4,
    ],
    [
        'class' => MoveToStartAction::class,
        'moveFirst' => 1,
        'moveMiddle' => 1,
        'moveLast' => 1,
    ],
]);
