<?php

use Illuminate\Database\Seeder;

use App\Task;
use App\Type;

class TaskTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //['Issue','Software','Engineering','Proposal','Maintenance','Documentation', 'Design' ];

	$tasks = [
	    '1' => ['Documentation'],
	    '2' => ['Proposal'],
	    '3' => ['Design', 'Engineering'],
	    '4' => ['Issue', 'Maintenance', 'Software'],
	    '5' => ['Issue'],
	];

	foreach ($tasks as $id => $types) {
	    $task = Task::where('id', 'like', $id)->first();
	    
	    foreach ($types as $typeName) {
	        $type = Type::where('name', 'LIKE', $typeName)->first();
		$task->types()->save($type);
	    }
	}
    }
}
