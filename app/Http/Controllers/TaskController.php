<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Assignee;
use App\Task;

use Session;
use Validator;

class TaskController extends Controller
{
    public $priority = ['High', 'Medium', 'Low'];
    public $status   = ['Open', 'In Progress', 'Fixed', 'Installed', 'Closed', 'Rejected'];

    //
    public function index($id='number') {

	$assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

        if ($id == 'add')        
	    return view('task.add')->with([
                'assignees_list' => $assignees_list,
                'types_list'=> $types_list,
                'priority_list'  => $this->priority,
                'status_list'    => $this->status,
            ]);


        $tasks = Task::with('types', 'assignee')->get();

	if ($id =='assignee')	
	    $tasks = $tasks->sortBy('assignee.last_name');
	elseif ($id == 'priority')
  	    $tasks = $tasks->sortBy('priority');
	elseif ($id == 'status')
	    $tasks = $tasks->sortBy('status');

	/*
	$tasksByType = collect();
	foreach ($tasks as $task) {
	   $names = $task->types()->get()->pluck('name')->implode(',');

	   if( strpos( $names, 'orange' ) !== false ) {
	       $tasksByType->push($task);
	   }
	}
	*/
	
	if ($id == 'type')
            Session::flash('message', 'Sorting by Type has not been implemented.');

	return view('task.index')->with([
	    'tasks'     => $tasks,
	    'assignees_list' => $assignees_list,
	    'types_list'=> $types_list,
	    'iamhere'   => $id,
        ]);
    }


    public function add(Request $request) {
        $assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

	return view('task.add')->with([
	    'assignees_list' => $assignees_list,
	    'types_list'=> $types_list,
	    'priority_list'  => $this->priority,
	    'status_list'    => $this->status,
	]);
    }


    public function addTask(Request $request) {
    	// validate inputs
        $subject = $request->input('subject');
        $rules = array(
	    'subject' => 'required|max:190',
        );

        $validator = Validator::make($request->input(), $rules);

	$types = ($request->types) ?: [];

	if ($validator->fails()) {
	   // flash error messages
	   $errmsgs = 'Task addition failed: ';

	   foreach ($validator->messages()->all() as $error) {
	       $errmsgs = $errmsgs.$error;
	   }
	   
           Session::flash('error', $errmsgs);

	   $assignees_list = Assignee::getListOfAssignees();  
	   $types_list = Type::getListOfTypes();

	   $typesForThisTask = [];
	   if (!empty($request->types) ) {
               foreach($request->types as $type) {
                   $typesForThisTask[] = $type;
               }
	   }

	   //return to same view with saved fields
	   return view('task.add')->with([
	       'subject' => $subject,
	       'assignees_list' => $assignees_list,
	       'description' => $request->description,
	       'assignee_id' => $request->assignee, 
	       'types' => $request->types,
	       'priority' => $request->priority,
	       'status'  => $request->status,
	       'comments'   => $request->comments,
   	       'types_list'=> $types_list,
  	       'priority_list'  => $this->priority,
	       'status_list'    => $this->status,
               'typesForThisTask' => $typesForThisTask,
	   ]);
	}

	// add new task
	$task = new Task();
	$task->subject = $request->subject;
	$task->assignee_id = $request->assignee;
	$task->priority = $request->priority;
	$task->status = $request->status;
	$task->description = $request->description;
	$task->comments = $request->comments;

	$task->save();

        $task->types()->sync($types);

	$task->save();

	Session::flash('message', 'Task has been added');

	return redirect('/task');

    }


    public function show($id) {
        $task = Task::with('types')->find($id);
        if(!$task) {
            Session::flash('error', 'Task '.$id.' not found.');
            return redirect('/task');
        }

        $assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

	$typesForThisTask = [];
        foreach($task->types as $type) {
            $typesForThisTask[] = $type->name;
        }

        return view('task.show')->with([
	    'task'      => $task,
            'assignees_list' => $assignees_list,
	    'types_list'=> $types_list,
	    'typesForThisTask' => $typesForThisTask,
        ]);
    }


    public function edit($id) {

        $task = Task::with('types')->find($id);
    	
        if(!$task) {
            Session::flash('error', 'Task '.$id.' not found.');
            return redirect('/task');
	}

        $assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

	$typesForThisTask = [];
        foreach($task->types as $type) {
            $typesForThisTask[] = $type->name;
        }

        return view('task.edit')->with([
	    'task'      => $task,
            'assignees_list' => $assignees_list,
	    'types_list'=> $types_list,
	    'typesForThisTask' => $typesForThisTask,
            'priority_list'  => $this->priority,
            'status_list'    => $this->status,
        ]);
    }


    public function editTask(Request $request) {
    	$task = Task::with('types')->find($request->id);

        if(!$task) {
            Session::flash('error', 'Task '.$id.' not found.');
            return redirect('/task');
   	}

    	// validate inputs
        $rules = array(
	    'subject' => 'required|max:190',
        );

        $validator = Validator::make($request->input(), $rules);

	if ($validator->fails()) {
	   // flash error messages
	   $errmsgs = 'Task update failed: ';

	   foreach ($validator->messages()->all() as $error) {
	       $errmsgs = $errmsgs.$error;
	   }
	   
           Session::flash('error', $errmsgs);

	   $assignees_list = Assignee::getListOfAssignees();  
	   $types_list = Type::getListOfTypes();

	   //return to same view with saved fields
	   return redirect('/task/edit/'.$request->id)->with([
	       'task'      => $task,
	       'assignees_list' => $assignees_list,
  	       'types_list'=> $types_list,
  	       'priority_list'  => $this->priority,
	       'status_list'    => $this->status,
	   ]);
	}

	// edit task
	$task->subject = $request->subject;
	$task->assignee_id = $request->assignee;
	$task->priority = $request->priority;
	$task->status = $request->status;
	$task->description = $request->description;
	$task->comments = $request->comments;
	$task->save();

        $types = ($request->types) ?: [];
        $task->types()->sync($types);

        $task->save();

	Session::flash('message', 'Task #'.$request->id.' has been updated');

	return redirect('/task');

    }

    public function delete($id) {
        $task = Task::find($id);
        if(!$task) {
            Session::flash('error', 'Task '.$id.' not found.');
            return redirect('/task');
        }
        return view('task.delete')->with('task', $task);
    }


    public function deleteTask(Request $request) {
        $task = Task::find($request->id);
        if(!$task) {
            Session::flash('error', 'Deletion failed; task '.$task->id.' not found.');
            return redirect('/task');
        }
        $task->types()->detach();
        $task->delete();

        Session::flash('message', 'Task #'.$task->id.' was deleted.');
        return redirect('/task');
    }
}
