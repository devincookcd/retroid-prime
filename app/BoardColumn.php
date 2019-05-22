<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class BoardColumn extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color', 'key', 'order'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board_columns';

    //
    /**
     * Get the board for the board column
     */
    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    /**
     * Get the board items for the board column
     */
    public function items()
    {
        return $this->hasMany('App\BoardItem');
    }
}
