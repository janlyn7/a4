@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
       <div class='ten columns'>
         <form method='GET' action='/task/edit/{{ $task->id }}' id='view_form'>
    	       {{ csrf_field() }}

           <div class='row'>
	       <input type='hidden' name='id' value='{{$task->id}}'>
	       <h5>Task #{{ $task->id }}</h5>
           </div>

           <div class='row'>
	       Subject:
               {{ $task->subject }}
           </div>


           <div class='row'>
               <label for='types'>Task Types:</label>
               <ul id='types'>
                   @foreach($types_list as $id => $name)
                       <li>
                           {{ $name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       </li>
                    @endforeach
                 </ul>
           </div>

           <div class='row'>
	      Assignee: <br/>
	      {{ $assignees[$task->assignee_id] }}
           </div>

           <div class='row'>
	      Priority: <br/>
	      {{ $task->priority }}
           </div>

           <div class='row'>
	       Status: <br/>
	       {{ $task->status }}
           </div>

           <div class='row'>
 	       Description: <br/>
               {{ $task->description }}
           </div>

           <div class='row'>
               Notes: </br>
               {{ $task->comments }} 
           </div>

           <div class='row'>
               <input type='submit' id='edit' value='Edit Task'>
           </div>
         </form>

       </div>

@endsection
