<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectAssigneesAndTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::table('tasks', function (Blueprint $table) {
	    $table->integer('assignee_id')->unsigned();
	    $table->foreign('assignee_id')->references('id')->on('assignees');
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
	Schema::table('tasks', function (Blueprint $table) {
	    $table->dropForeign('tasks_assignee_id_foreign');
	    $table->dropColumn('assignee_id');
	});

    }
}
