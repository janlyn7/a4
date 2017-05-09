@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
    <div class='ten columns'>

    <form method='POST' action='/task/delete'>
        {{ csrf_field() }}

           <div class='row'>
               <input type='hidden' name='id' value='{{$task->id}}'>
	       <h5>Delete Task #{{ $task->id }}</h5>
           </div>

	   <div class='row'>
               <input type='submit' value='Yes, delete this Task.'>
	   </div>
    </form>
    </div>

@endsection
