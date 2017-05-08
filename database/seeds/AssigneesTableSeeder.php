<?php

use Illuminate\Database\Seeder;
use App\Assignee;

class AssigneesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	$assignees = [
	    ["Emily", "Prentiss"],
	    ["Derek", "Morgan"],
	    ["Spencer", "Reid"],
	    ["Jennifer", "Jareau"],
	    ["Penelope", "Garcia"]
	];

	$timestamp = Carbon\Carbon::now()->subDays(count($assignees));


	foreach($assignees as $assignee){
	    $timestampForAssignee = $timestamp->addDay()->toDateTimeString();
	    Assignee::insert([
		'created_at' => $timestampForAssignee,
		'updated_at' => $timestampForAssignee,
	        'first_name' => $assignee[0],
		'last_name'  => $assignee[1]
	    ]);	
	}
    }


}
