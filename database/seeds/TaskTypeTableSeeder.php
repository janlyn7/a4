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
        //
	$tasks = [
	    '1' => ['blue', 'orange'],
	    '2' => ['green'],
	    '3' => ['blue', 'orange', 'red'],
	    '4' => ['yellow', 'red'],
	    '5' => ['pink'],
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
