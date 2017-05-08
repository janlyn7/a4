<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function tasks() {
        return $this->belongsToMany('App\Type');
    }

    public static function getListOfTypes() {
        $types = Type::orderBy('id', 'ASC')->get();
        foreach ($types as $type) {
            $types_list[$type->id] = $type->name;
        }

        return $types_list;
    }
    

}
