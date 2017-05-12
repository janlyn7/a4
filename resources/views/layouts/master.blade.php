<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>

    <link href='/css/tasktracker.css' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="../images/task_clipboard_icon.png">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css' rel='stylesheet' type='text/css'>

    @stack('head')

</head>

<body>
    @if(Session::has('error'))
       <div class='error'>{{ Session::get('error') }} </div>
       @php (Session::forget('error'))

    @elseif (Session::has('message'))
      <div class='message'>{{ Session::get('message') }}</div>
    @else
      <div class='nbsp'>&nbsp;</div>
    @endif

    <div class='container'>

      <div class='row' id='title_logo'>
        <div class='four columns' id='logo'>
          <img src="/images/task_clipboard_icon.png" alt='tasktracker logo'>
        </div>
        <div class='eight columns' id='title'>
          <h1> Task Tracker</h1>
        </div>
      </div>
    </div>


    <div class="container" id="main">

        <div class="row" id='buffer_row'>
	  &nbsp;
	</div>
        <div class="row">

        <div class="two columns" id="navigation">
	  <nav>
 	    <label>View By:</label>
	    <ul id='views'>
	      <li @isset ($iamhere) @if ($iamhere =='number') id="iamhere" @endif @endisset><a href="/task/number"> Number</a></li>
	      <li @isset ($iamhere) @if ($iamhere =='type') id="iamhere" @endif @endisset><a href="/task/type"> Type</a></li>
	      <li @isset ($iamhere) @if ($iamhere =='assignee') id="iamhere" @endif @endisset><a href="/task/assignee"> Assignee</a></li>
	      <li @isset ($iamhere) @if ($iamhere =='priority') id="iamhere" @endif @endisset><a href="/task/priority"> Priority</a></li>
	      <li @isset ($iamhere) @if ($iamhere =='status') id="iamhere" @endif @endisset><a href="/task/status"> Status</a></li>
	    </ul>
	  </nav>

	  <br/>
 	  <a href="/task/add" id='add_task'>Add A Task</a>

	</div>    

	@yield('content')

	</div>
    </div>
</body>
</html>
