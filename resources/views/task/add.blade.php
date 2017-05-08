@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
  <form method='POST' action='/task/add'>
    {{ csrf_field() }}

    <div class='container'>

       <div class='row'>
           <div class='twelve columns' id='view_title'>
	       <h5>Add A Task</h5>
	   </div>       
       </div>

       <div class='row'>
           <div class='twelve columns'>
	       <label for='subject'>Subject</label>
               <input type='text' autofocus name='subject' id='subject_input' value='{{ old('subject', '') }}'>
	   </div>       

       </div>

       <div class='row'>
           <div class='twelve columns'>
               <label for='types'>Task Types:</label>
	       <ul id='types'>
                   @foreach($types_list as $id => $name)
                       <li><input
                             type='checkbox'
                             value='{{ $id }}'
                             id='type_{{ $id }}'
                             name='types[]'
                           >
                           &nbsp;
                           <label for='type_{{ $id }}'>{{ $name }}</label>
                       </li>
                    @endforeach
                 </ul>
           </div>
       </div>


       <div class='row'>
           <div class='twelve columns'>
	      <label for='assignee'>Assignee</label>
                 <select name='assignee' id='assignee'>
		    @foreach($assignees as $id => $assigneeName)
                       <option value={{ $id }}> {{ $assigneeName }}
		    @endforeach
		 </select>
	   </div>        
       </div>

       <div class='row'>
           <div class='twelve columns'>
	      <label for='priority'>Priority</label>
                 <select name='priority' id='priority'>
		    @foreach($priority as $pp)
                       <option value={{ $pp }}> {{ $pp }}
		    @endforeach
		 </select>
	   </div>        
       </div>

       <div class='row'>
            <div class='twelve columns'>
	      <label for='status'>Status</label>
                 <select name='status' id='status'>
		    @foreach($status as $stat)
                       <option value={{ $stat }}> {{ $stat }}
		    @endforeach
		 </select>

	   </div>        
       </div>

       <div class='row'>
            <div class='twelve columns'>
 	       <label for=''>Description</label>
               <input type='text' name='description' id='description' value='{{ old('description', '') }}'>
	    </div>
       </div>

       <div class='row'>
            <div class='twelve columns'>
               <label for='notes'>Notes</label>
               <input type='text' name='notes' id='notes' value='{{ old('notes', '') }}'> 
	    </div>
       </div>

       <div class='row'>
            <div class='twelve columns'>
               <input type='submit' id='add' value='Add Task'>
   	    </div>
       </div>
 

    </div>

  </form>
@endsection
