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
     * Get the comments for the blog post.
     */
    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
