<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function assignee() {
        return $this->belongsTo('App\Assignee');
    }	       

    public function types() {
    	return $this->belongsToMany('App\Type');

    }

}
