<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create('task_type', function(Blueprint $table) {
	    $table->integer('task_id')->unsigned();
	    $table->integer('type_id')->unsigned();

	    $table->foreign('task_id')->references('id')->on('tasks');
	    $table->foreign('type_id')->references('id')->on('types');

	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

	Schema::drop('task_type');

    }
}
