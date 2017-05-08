<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{
    //
    public function tasks() {
        return $this->hasMany('App\Task');    
    }

    public static function getListOfAssignees() {
        $assignees = Assignee::orderBy('last_name', 'ASC')->get();
        foreach ($assignees as $assignee) {
            $assignees_list[$assignee->id] = $assignee->first_name." ".$assignee->last_name;
        }

	return $assignees_list;
    }

}
