<?php

namespace Maize\NovaEloquentSortable\Tests\Support\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Item extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $table = 'test_models';

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'order_column' => 'integer',
    ];

    protected $fillable = [
        //
    ];
}
