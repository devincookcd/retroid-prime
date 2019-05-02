<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_columns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('board_id');
            $table->foreign('board_id')
                  ->references('id')
                  ->on('boards')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('color');
            $table->integer('order');
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
        Schema::dropIfExists('board_columns');
    }
}
