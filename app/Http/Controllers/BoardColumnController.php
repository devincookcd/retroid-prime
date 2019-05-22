<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Board;
use App\BoardColumn;
// use Spatie\EloquentSortable\Sortable;
// use Spatie\EloquentSortable\SortableTrait;

class BoardColumnController extends Controller
{
    // use SortableTrait;

    // public $sortable = [
    //     'order_column_name' => 'order',
    //     'sort_when_creating' => true,
    // ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $column = new BoardColumn;

        $column->color = $request->color;
        $column->name = $request->name;
        $column->order = $request->order;
        $column->board_id = $request->board_id;

        $column->save();

        return [
            'column' => $column
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        // $column = BoardColumn::where('id', $id)->first();
        $column = BoardColumn::findOrFail($id);

        $column->update([
            'name' => $request->name,
            'color' => $request->color
        ]);

        return [
            'column' => $column,
            'message' => 'Column name updated.'
        ];
    }

    /**
     * Reorder the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        //
        $order = $request->order;
        BoardColumn::setNewOrder($order);
        // $column = BoardColumn::where('id', $id)->first();
        // $column = BoardColumn::findOrFail($id);

        // $column->update([
        //     'name' => $request->name
        // ]);

        return [
            'message' => 'Column order updated.'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $column = BoardColumn::findOrFail($id);

        $column->delete();

        // $board = Board::findOrFail($column->board_id);
        // $board->columns;

        return [
            'message' => 'Column deleted successfully.',
            // 'board' => $board
        ];
    }
}
