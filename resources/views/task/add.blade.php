@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
        <div class="one column">
	&nbsp;
	</div>

     <div class='eight columns'>
        <form method='POST' action='/task/add' id='add_form'>
    	{{ csrf_field() }}

           <div class='row'>
	       <h5>Add A Task</h5>
	   </div>       

           <div class='row'>
	       <label>Subject</label>
               <input type='text' autofocus name='subject' id='subject_input' value='{{ $subject or ""}}'>
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
                              @isset($typesForThisTask) {{ (in_array($id, $typesForThisTask)) ? 'CHECKED' : '' }} @endisset
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
                       <option value='{{ $id }}' @isset($assignee_id) {{ ($assignee_id == $id) ? 'SELECTED' : '' }} @endisset> {{ $assigneeName }}
		    @endforeach
		 </select>
	   </div>        

           <div class='row'>
	      <label>Priority</label>
                 <select name='priority' id='priority_select'>
		    @foreach($priority_list as $pp)
                       <option value='{{ $pp }}' @isset($priority) {{ ($priority == $pp) ? 'SELECTED' : '' }} @endisset> {{ $pp }}
		    @endforeach
		 </select>
	   </div>        
           <div class='row'>
	      <label>Status</label>
                 <select name='status' id='status_select'>
		    @foreach($status_list as $stat)
                       <option value='{{ $stat }}' @isset($status) {{ ($status == $stat) ? 'SELECTED' : '' }} @endisset> {{ $stat }}
		    @endforeach
		 </select>

	   </div>        

           <div class='row'>
 	       <label for='description'>Description</label>
               <textarea name='description' id='description' form='add_form'>{{ $description or "" }}</textarea>
           </div>

           <div class='row'>
               <label for='notes'>Notes</label>
               <textarea name='notes' id='notes' form='add_form'>{{ $notes or "" }}</textarea> 
           </div>


           <div class='row'>
               <input type='submit' id='add' value='Add Task'>
   	   </div>
 
       </form>
     </div>

@endsection
