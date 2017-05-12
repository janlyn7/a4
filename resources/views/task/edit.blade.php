@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
        <div class="one column">
	&nbsp;
	</div>

       <div class='eight columns'>
         <form method='POST' action='/task/edit' id='edit_form'>
    	       {{ csrf_field() }}

           <div class='row'>
	       <input type='hidden' name='id' value='{{$task->id}}'>
	       <h5>Edit Task #{{ $task->id }}</h5>
           </div>

           <div class='row'>
	       <label>Subject</label>
               <input type='text' autofocus name='subject' id='subject_input' value='{{ $task->subject }}'>
           </div>


           <div class='row'>
               <label>Task Types:</label>
               <ul id='types'>
                   @foreach($types_list as $id => $name)
                       <li>
                         <label for='type_{{ $id }}'>
                           <input
			      type='checkbox' 
                              value='{{ $id }}' 
                              id='type_{{ $id }}' 
                              name='types[]'
			      {{ (in_array($name, $typesForThisTask)) ? 'CHECKED' : '' }}
                           >
                           {{ $name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         </label>
                       </li>
                    @endforeach
                 </ul>
           </div>

           <div class='row'>
	      <label>Assignee</label>
                 <select name='assignee' id='assignee_select'>
		    @foreach($assignees_list as $id => $assigneeName)
                       <option value='{{ $id }}' {{ (($task->assignee_id) == $id) ? 'SELECTED' : '' }} > {{ $assigneeName }}
		    @endforeach
		 </select>
           </div>

           <div class='row'>
	      <label>Priority</label>
                 <select name='priority' id='priority_select'>
		    @foreach($priority_list as $pp)
                       <option value='{{ $pp }}' {{ ($task->priority == $pp) ? 'SELECTED' : '' }} > {{ $pp }}
		    @endforeach
		 </select>
           </div>

           <div class='row'>
	      <label>Status</label>
                 <select name='status' id='status_select'>
		    @foreach($status_list as $stat)
                       <option value='{{ $stat }}' {{ ($task->status == $stat) ? 'SELECTED' : '' }} > {{ $stat }}
		    @endforeach
		 </select>
           </div>

           <div class='row'>
 	       <label for='description'>Description</label>
               <textarea name='description' id='description' form='edit_form'>{{ $task->description }}</textarea>
           </div>

           <div class='row'>
               <label for='notes'>Notes</label>
               <textarea name='notes' id='notes' form='edit_form'>{{ $task->comments }}</textarea> 
           </div>

           <div class='row'>
               <input type='submit' id='edit' value='Edit Task'>
           </div>
         </form>

       </div>

@endsection
