@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
    <div class="nine columns" >

        <div class='row ltblue'>
           <div class='one column' id=idno>
	       <h6>ID</h6>
           </div>
           <div class='three columns' id=subject>
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

           <div class='one column' id='actions'>
	       <h6>Actions</h6>
           </div>

       </div>

       @php ($ii = 0)

        @foreach($tasks as $task)
	   @if ($ii == 0)
              <div class='row white' >	      
	      @php ($ii=1)
	   @else
              <div class='row gray' >	      
	      @php ($ii=0)
	   @endif
              <div class='one column' id=idno>
	          {{ $task->id }}	   
              </div>
	      <div class='three columns' id=subject>
                  {{ $task->subject }}
		  </br>
	          @foreach ($task->types as $type)
                      {{ $type->name }} &nbsp;
                  @endforeach
              </div>
              <div class='two columns' id=assignee>
	          {{ $assignees_list[$task->assignee_id] }} 
              </div>
              <div class='one columns' id=priority>
	          {{ $task->priority }}
              </div>
              <div class='one columns' id=status>
	          {{ $task->status }}
              </div>
              <div class='one columns' id='actions'>
	        <a href="/task/delete/{{ $task->id }}"><img src="../images/trash.png" alt="trash task" style="width:26px;height:26px;border:0;"></a>
	        <a href="/task/edit/{{ $task->id }}  "><img src="../images/edit.png"  alt="edit task"  style="width:26px;height:26px;border:0;"></a>
 	        <a href="/task/view/{{ $task->id }}  "><img src="../images/view.png"  alt="view task"  style="width:26px;height:26px;border:0;"></a>
	      </div>

          </div>
        @endforeach



@endsection
