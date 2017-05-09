<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>

    <link href='/css/tasktracker.css' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="../images/task_clipboard_icon.png">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans|Audiowide' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css' rel='stylesheet' type='text/css' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css' rel='stylesheet' type='text/css'>

    @stack('head')

</head>

<body>
    @if(Session::has('error'))
      <div class='error'>{{ Session::get('error') }}</div>
    @endif


    @if(Session::has('message'))
      <div class='message'>{{ Session::get('message') }}</div>
    @endif


    <div class='container'>
      <div class='row' id='head'>
	&nbsp;
      </div>


      <div class='row'>
        <div class='four columns' id='logo'>
          <img src='http://spanvisioninfotech.com/img/icons/copy-writing.png'>
        </div>
        <div class='eight columns' id='title'>
          <h1> Task Tracker</h1>
        </div>
      </div>
    </div>


    <div class="container" id="main">
        <div class="row">

        <div class="two columns" id="navigation">
	  <nav>
 	    <label for='views'>View By:</label>
	    <ul id='views'>
	      <li id="navpart1"><a href="">> Number</a></li>
	      <li id="navpart2"><a href="">> Type</a></li>
	      <li id="navpart3"><a href="">> Assignee</a></li>
	      <li id="navpart4"><a href="">> Priority</a></li>
	      <li id="navpart5"><a href="">> Status</a></li>
	    </ul>
	  </nav>

	  </br>
 	  <a href="task/add">Add A Task</a>

	</div>    

	@yield('content')

	</div>
    </div>
</body>
</html>
