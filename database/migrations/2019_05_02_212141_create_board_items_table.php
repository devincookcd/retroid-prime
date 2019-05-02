<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('board_column_id');

            $table->foreign('board_id')
                  ->references('id')
                  ->on('boards')
                  ->onDelete('cascade');

            $table->foreign('board_column_id')
                  ->references('id')
                  ->on('board_columns')
                  ->onDelete('cascade');

            $table->string('text');
            $table->integer('up_votes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_items');
    }
}
