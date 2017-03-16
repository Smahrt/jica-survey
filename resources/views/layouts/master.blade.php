<?php 
    use App\Http\Controllers\MainController;
?>

<html>
    <head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>JICA Data Collection App - @yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    @include('layouts.style')
        <!--   Core JS Files   -->
	{!! HTML::script('assets/js/jquery-3.1.0.min.js') !!}
	{!! HTML::script('assets/js/bootstrap.min.js') !!}
	{!! HTML::script('assets/js/material.min.js') !!}
</head>
    
    
    <body>
        <div class="wrapper">
            
            @include('layouts.sidebar')
            
            <div class="main-panel">
                
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand">@yield('title')</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                       <i class="material-icons">person</i>

                                       <p class=""></p>

                                       <p class="hidden-lg hidden-md">My Name</p>

                                   </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/surveys') }}">Surveys</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/contacts') }}">Contacts</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                        
                        @yield('content')
                        
                        @include('layouts.start-survey')
                        
                        
                    </div>

                </div>
                
            @include('layouts.footer')
                
            </div>
        </div>
        
        @include('layouts.script')
        
    </body>
    
</html>
