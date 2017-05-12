<?php

use Illuminate\Database\Seeder;

use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$types = ['Issue','Software','Engineering','Proposal','Maintenance','Documentation', 'Design' ];
	
	foreach ($types as $typeName) {
	    $type = new Type();
	    $type->name = $typeName;
	    $type->save();
	}

    }

}
