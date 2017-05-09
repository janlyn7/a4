@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
  <form method='POST' action='/task/add'>
    {{ csrf_field() }}

       <div class='ten columns'>
           <div class='row'>
	       <h5>Add A Task</h5>
	   </div>       

           <div class='row'>

	       <label for='subject'>Subject</label>
               <input type='text' autofocus name='subject' id='subject_input' value='{{ old('subject', '') }}'>
	   </div>       

           <div class='row'>
               <label for='types'>Task Types:</label>
	       <ul id='types'>
                   @foreach($types_list as $id => $name)
		       <li>
                         <label for='type_{{ $id }}'>
                           <input type='checkbox' value='{{ $id }}' id='type_{{ $id }}' name='types[]'> 
			   {{ $name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         </label>
                       </li>
                    @endforeach
                 </ul>
           </div>

           <div class='row'>
	      <label for='assignee'>Assignee</label>
                 <select name='assignee' id='assignee'>
		    @foreach($assignees as $id => $assigneeName)
                       <option value={{ $id }}> {{ $assigneeName }}
		    @endforeach
		 </select>
	   </div>        

           <div class='row'>
	      <label for='priority'>Priority</label>
                 <select name='priority' id='priority'>
		    @foreach($priority as $pp)
                       <option value={{ $pp }}> {{ $pp }}
		    @endforeach
		 </select>
	   </div>        

           <div class='row'>
	      <label for='status'>Status</label>
                 <select name='status' id='status'>
		    @foreach($status as $stat)
                       <option value={{ $stat }}> {{ $stat }}
		    @endforeach
		 </select>

	   </div>        

           <div class='row'>
 	       <label for=''>Description</label>
               <input type='text' name='description' id='description' value='{{ old('description', '') }}'>
           </div>

           <div class='row'>
               <label for='notes'>Notes</label>
               <input type='text' name='notes' id='notes' value='{{ old('notes', '') }}'> 
           </div>


           <div class='row'>
               <input type='submit' id='add' value='Add Task'>
   	   </div>
       </div>
 
  </form>
@endsection
