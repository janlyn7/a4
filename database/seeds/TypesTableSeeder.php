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
        //
	$types = ['red','orange','yellow','green','blue','purple', 'pink' ];
	
	foreach ($types as $typeName) {
	    $type = new Type();
	    $type->name = $typeName;
	    $type->save();
	}

    }

}
