@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
        <div class='row'>
           <div class='one column' id=idno>
	       <h6>ID</h6>
           </div>
           <div class='one column' id=type>
	       <h6>Type</h6>
           </div>
           <div class='two columns' id=assignee>
	       <h6>Assignee</h6>
           </div>
           <div class='four columns' id=subject>
	       <h6>Subject</h6>
           </div>
           <div class='two columns' id=priority>
	       <h6>Priority</h6>
           </div>
           <div class='two columns' id=status>
	       <h6>Status</h6>
           </div>
       </div>



        @foreach($tasks as $task)
           <div class='row'>
              <div class='one column' id=idno>
	          {{ $task->id }}	   
              </div>
              <div class='one column' id=type>
	          @foreach ($task->types as $type)
	              {{ $type->name }}
		  @endforeach
              </div>
              <div class='two columns' id=assignee>
	          {{ $assignees[$task->assignee_id] }} 
              </div>
	      <div class='four columns' id=subject>
                  {{ $task->subject }}
	      </div>
              <div class='two columns' id=priority>
	          {{ $task->priority }}
              </div>
              <div class='two columns' id=status>
	          {{ $task->status }}
              </div>
          </div>
        @endforeach

@endsection
