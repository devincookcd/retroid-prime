<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Board;
use App\BoardColumn;

class BoardController extends Controller
{
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
        // TODO: Validate request

        $board = new Board;

        $board->name = $request->name;
        $columns = $request->columns;

        // print_r($)
        // return [
        //     'columns' => $columns
        // ];
        // $columnData = array();

        // foreach ($columns as $column) {
        //     if(!empty($column)) {
        //         // $column = new Board;
        //     }
        // }
        $board->url_hash = str_random(20);
        $board->user_id = Auth::user()->id;

        $board->save();

        $board->columns()->createMany($columns);

        // BoardColumn::insert($columns);
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

        $board = Board::where('url_hash', $hash)->first();
        $board->columns;

        if (!$board) {
            abort(404, 'Board Not Found.');
        }
        return [
            'board' => $board,
            // 'columns' => $board->columns
        ];

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
    }
}
