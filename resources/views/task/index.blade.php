@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
        <div class="ten columns" >

        <div class='row'>
           <div class='one column' id=idno>
	       <h6>ID</h6>
           </div>
           <div class='four columns' id=subject>
	       <h6>Subject</h6>
           </div>
           <div class='two columns' id=assignee>
	       <h6>Assignee</h6>
           </div>
           <div class='one columns' id=priority>
	       <h6>Priority</h6>
           </div>
           <div class='one columns' id=status>
	       <h6>Status</h6>
           </div>

           <div class='one column' id=actions>
	       <h6>Actions</h6>
           </div>

       </div>

        @foreach($tasks as $task)
           <div class='row'>
              <div class='one column' id=idno>
	          {{ $task->id }}	   
              </div>
	      <div class='four columns' id=subject>
                  {{ $task->subject }}
		  </br>
	          @foreach ($task->types as $type)
                      {{ $type->name }} &nbsp;
                  @endforeach
              </div>
              <div class='two columns' id=assignee>
	          {{ $assignees[$task->assignee_id] }} 
              </div>
              <div class='one columns' id=priority>
	          {{ $task->priority }}
              </div>
              <div class='one columns' id=status>
	          {{ $task->status }}
              </div>
              <div class='one columns' id=actions>
	        <a href="task/delete/{{ $task->id }}"><img src="images/trash.png" alt="trash task" style="width:20px;height:20px;border:0;"></a>
	        <a href="task/edit/{{ $task->id }}  "><img src="images/edit.png"  alt="edit task"  style="width:20px;height:20px;border:0;"></a>
 	        <a href="task/view/{{ $task->id }}  "><img src="images/view.png"  alt="view task"  style="width:20px;height:20px;border:0;"></a>
	      </div>

          </div>
        @endforeach



@endsection
