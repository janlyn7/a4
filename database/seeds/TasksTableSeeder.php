<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Assignee;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	$tasks = json_decode(file_get_contents(database_path().'/tasks.json'), True);

	$timestamp = Carbon\Carbon::now()->subDays(count($tasks));

	foreach($tasks as $id => $task) {
	    $name = explode(' ', $task['assignee']);
	    $lastName = array_pop($name);
	    $assignee_id = Assignee::where('last_name', '=', $lastName)->pluck('id')->first();

	    $timestampForThisTask = $timestamp->addDay()->toDateTimeString();

	    Task::insert([
		'created_at' => $timestampForThisTask,
            	'updated_at' => $timestampForThisTask,
	   	'subject' => $task['subject'],
	    	'assignee_id' => $assignee_id,
	    	'priority' => $task['priority'],
	    	'status'=> $task['status'],
	    	'description' => $task['description'],
	    	'comments' => $task['comments'],
	    ]);
	}
    }
}
