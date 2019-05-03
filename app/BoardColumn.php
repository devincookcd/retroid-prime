<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardColumn extends Model
{
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
