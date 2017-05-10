@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
	<div class="one column">
	&nbsp;
	</div>

       <div class='eight columns'>
         <form method='GET' action='/task/edit/{{$task->id}}' id='view_form'>

           <div class='row'>
	       <h5>Task #{{ $task->id }}</h5>
           </div>

           <div class='row ltblue'>
	       Subject
           </div>
           <div class='row'>
               {{ $task->subject }}
           </div>


           <div class='row ltblue'>
               Task Types
           </div>
           <div class='row'>
               <ul id='view_types'>
                   @foreach($types_list as $id => $name)
		       @if (in_array($name, $typesForThisTask))
		           <li> {{ $name }} </li>
		       @endif	
                   @endforeach
                 </ul>
           </div>

           <div class='row ltblue'>
	      Assignee
           </div>
           <div class='row'>
	      {{ $assignees_list[$task->assignee_id] }}
           </div>

           <div class='row ltblue'>
	      Priority
           </div>
           <div class='row'>
	      {{ $task->priority }}
           </div>

           <div class='row ltblue'>
	       Status
           </div>
           <div class='row'>
	       {{ $task->status }}
           </div>

           <div class='row ltblue'>
 	       Description
           </div>
           <div class='row'>
               {{ $task->description }}
	       <br/> 
           </div>

           <div class='row ltblue'>
               Notes
           </div>
           <div class='row'>
               {{ $task->comments }}
	       <br/> 
           </div>

           <div class='row'>
	       <br/><br/>
               <input type='submit' id='edit' value='Edit Task'>
           </div>
         </form>

       </div>

@endsection
