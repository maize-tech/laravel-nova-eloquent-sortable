<?php

use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maize\NovaEloquentSortable\Actions\MoveOrderDownAction;
use Maize\NovaEloquentSortable\Actions\MoveOrderUpAction;
use Maize\NovaEloquentSortable\Actions\MoveToEndAction;
use Maize\NovaEloquentSortable\Actions\MoveToStartAction;
use Maize\NovaEloquentSortable\Tests\Support\Models\Item;

it('can see', function (string $class, bool $canRunFirst, bool $canRunMiddle, bool $canRunLast) {
    $request = new NovaRequest();

    $items = Item::factory()->count(5)->create();
    $first = $items->first();
    $middle = $items[2];
    $last = $items->last();

    $action = $class::make();

    expect($action->canRunSortable($request, $first))->toBe($canRunFirst);
    expect($action->canRunSortable($request, $middle))->toBe($canRunMiddle);
    expect($action->canRunSortable($request, $last))->toBe($canRunLast);
})->with([
    [
        'class' => MoveOrderDownAction::class,
        'canRunFirst' => true,
        'canRunMiddle' => true,
        'canRunLast' => false,
    ],
    [
        'class' => MoveToEndAction::class,
        'canRunFirst' => true,
        'canRunMiddle' => true,
        'canRunLast' => false,
    ],
    [
        'class' => MoveOrderUpAction::class,
        'canRunFirst' => false,
        'canRunMiddle' => true,
        'canRunLast' => true,
    ],
    [
        'class' => MoveToStartAction::class,
        'canRunFirst' => false,
        'canRunMiddle' => true,
        'canRunLast' => true,
    ],
]);

it('can move', function (string $class, int $moveFirst, int $moveMiddle, int $moveLast) {
    $fields = new ActionFields(collect(), collect());

    $items = Item::factory()->count(5)->create();
    $first = $items->first();
    $middle = $items[2];
    $last = $items->last();

    $action = $class::make();

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
