<!-- app/views/login.blade.php -->
@section('title', 'Login')


<!doctype html>
<html>
<head>
<title>JICA Data Collection App - @yield('title')</title>
</head>
<body>


<h1>Login</h1>
{!! Form::open(array('url' => 'login')) !!}

<!-- if there are login errors, show them here -->
<div id ="error" class="">
<p>
    {!!$errors->first('email') !!}
    {!!$errors->first('password') !!}
    
    @if(isset($error_message))
         {!!$error_message !!}
    @endif
   
</p>
</div>
<p>
    {!! Form::label('email', 'Email Address') !!}
    {!! Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) !!}
</p>

<p>
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password') !!}
</p>

<p>{!! Form::submit('Submit!') !!}</p>
{!! Form::close() !!}

</body>
</html>