<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class BoardItem extends Model
{
    // use SortableTrait;

    // public $sortable = [
    //     'order_column_name' => 'order',
    //     'sort_when_creating' => true,
    // ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'board_id', 'board_column_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board_items';

    //
    /**
     * A BoardItems's Board
     */
    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    /**
     * A BoardItems's Column
     */
    public function column()
    {
        return $this->belongsTo('App\BoardColumn');
    }
}
