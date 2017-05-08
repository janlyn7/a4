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
    public function index() {
        $tasks = Task::with('types')->get();

	$tasksByPerson = $tasks->sortByDesc('assignee');
	$tasksByPriority = $tasks->sortByDesc('priority');
	$tasksByStatus = $tasks->sortByDesc('status');
	
	dump($tasksByPerson);

	$tasksByType = collect();
	foreach ($tasks as $task) {
	   $names = $task->types()->get()->pluck('name')->implode(',');

	   if( strpos( $names, 'orange' ) !== false ) {
	       $tasksByType->push($task);
	   }
	}

	
	//dump($tasksByType);

	$assignees_list = Assignee::getListOfAssignees();
	//$types_list = Type::getListOfTypes();
	
	return view('task.index')->with([
	    'tasks'     => $tasksByType,
	    'assignees' => $assignees_list,
	    //'types_list'=> $types_list,
        ]);
    }


    public function add(Request $request) {
        $assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

	return view('task.add')->with([
	    'assignees' => $assignees_list,
	    'types_list'=> $types_list,
	    'priority'  => $this->priority,
	    'status'    => $this->status,
	]);
    }


    public function addTask(Request $request) {

        $subject = $request->input('subject');

    	// validate inputs
        $rules = array(
	    'subject' => 'required',
        );

        $validator = Validator::make($request->input(), $rules);

	if ($validator->fails()) {
	   // flash error messages
	   //$errmsgs = $validator->messages();
           Session::flash('error', 'Task addition failed ');

	   $assignees_list = Assignee::getListOfAssignees();  
	   $types_list = Type::getListOfTypes();

	   //return to same view with saved fields
	   return view('task.add')->with([
	       'subject'   => $subject,
	       'assignees' => $assignees_list,
   	       'types_list'=> $types_list,
  	       'priority'  => $this->priority,
	       'status'    => $this->status,
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

	$types = ($request->types) ?: [];
        $task->types()->sync($types);

	$task->save();

	Session::flash('message', 'Task has been added');

	return redirect('/task');

    }


    public function edit($id) {
    	//$task = Task::find($id);
        $task = Task::with('types')->find($id);
    	
        $assignees_list = Assignee::getListOfAssignees();
	$types_list = Type::getListOfTypes();

	$typesForThisTask = [];
        foreach($task->types as $type) {
            $typesForThisTask[] = $type->name;
        }

        return view('task.edit')->with([
	    'task'      => $task,
            'assignees' => $assignees_list,
	    'types_list'=> $types_list,
	    'typesForThisTask' => $typesForThisTask,
            'priority'  => $this->priority,
            'status'    => $this->status,
        ]);
    }


    public function editTask(Request $request) {
    	$task = Task::with('types')->find($request->id);

    	// validate inputs
        $rules = array(
	    'subject' => 'required',
        );

        $validator = Validator::make($request->input(), $rules);

	if ($validator->fails()) {
	   // flash error messages
	   //$errmsgs = $validator->messages();
           Session::flash('error', 'Task addition failed ');

	   $assignees_list = Assignee::getListOfAssignees();  
	   $types_list = Type::getListOfTypes();

	   //return to same view with saved fields
	   return view('task.add')->with([
	       'task'      => $task,
	       'subject'   => $subject,
	       'assignees' => $assignees_list,
  	       'types_list'=> $types_list,
  	       'priority'  => $this->priority,
	       'status'    => $this->status,
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

	Session::flash('message', 'Task #'.$request->id.'has been updated');

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
        # Get the task to be deleted
        $task = Task::find($request->id);
        if(!$task) {
            Session::flash('error', 'Deletion failed; task '.$task->id.' not found.');
            return redirect('/task');
        }
        $task->types()->detach();
        $task->delete();

        # Finish
        Session::flash('message', 'Task #'.$task->id.' was deleted.');
        return redirect('/task');
    }
}
