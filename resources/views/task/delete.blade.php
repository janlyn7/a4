@extends('layouts.master')

@section('title')
    Task Tracker
@endsection


@section('content')
    <h1>Confirm deletion</h1>
    <form method='POST' action='/task/delete'>
        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $task->id }}'?>

        <h5>Are you sure you want to delete Task #{{ $task->id }}?</h5>

        <input type='submit' value='Yes, delete this Task.'>

    </form>


@endsection
