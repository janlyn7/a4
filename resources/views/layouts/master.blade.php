<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>

    <link href='/css/tasktracker.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans|Audiowide|Roboto' rel='stylesheet' type='text/css'>
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
      <div class='row'>
        <div class='four columns' id='logo'>
          <img src='http://spanvisioninfotech.com/img/icons/copy-writing.png'>
        </div>
        <div class='eight columns' id='title'>
          <h1> Task Tracker</h1>
        </div>
      </div>
    </div>

    @yield('content')


</body>
</html>
