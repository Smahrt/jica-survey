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
 

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-select.min.css') }}">

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/material-icons.css') }}">
</head>
    
    
    <body>
        <div class="wrapper">
            @section('sidebar')
                <div class="sidebar" data-color="orange" data-image="{{ asset('assets/img/sidebar-1.jpg') }}">
                    <div class="logo">
                        <a href="{{ url() }}" class="simple-text">
                            JICA DC
                        </a>
                    </div>

                    <div class="sidebar-wrapper">
                        <ul id="main-nav" class="nav">
                            <li>
                                <a href="{{ url() }}">
                                    <i class="material-icons">dashboard</i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/contacts') }}">
                                    <i class="material-icons">account_box</i>
                                    <p>Contacts</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/surveys') }}">
                                    <i class="material-icons">content_paste</i>
                                    <p>Surveys</p>
                               </a>
                            </li>
                            <li class="active-pro">
                                <a href="#" data-toggle="modal" data-target="#callModal">
                                    <p>START SURVEY</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @show
            
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
                                       <p class="hidden-lg hidden-md">My Name</p>
                                   </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ url() }}">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/surveys') }}">Surveys</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/contacts') }}">Contacts</a>
                                        </li>
                                        <li>
                                            <a href="#">Logout</a>
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
                        
                        <!-- BEGIN CALL MODAL -->
                        <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="simpleModalLabel">Make a Call</h4>
                                        <p class="category">Start a new survey by calling a contact or selecting a contact group</p>
                                    </div>
                                    
                                    <form action="{{url('/call')}}" method="post">
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Select Contact</label>
                                                    
                                                    <select id="contacts" name="phone_number" data-live-search="true" class="form-control">
                                                        
                                                        <option disabled selected>Select Contact</option>
                                                        <option value="+2348182362521">Yoshito Kawakatsu</option>
                                                        <option value="+2349095953951">Smahrt</option>
                                                        <option value="+2348050367060">Mr. Shola</option>
                                                        <option value="+2348137809477">Dawn</option>
                                                        
                                                        @foreach($result as $user)
                                                        <option value="{{$user->phone_number}}">{{$user->officer_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <p>OR</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Select Contact Group</label>
                                                    <select id="contact-group" class="form-control">
                                                        <option selected disabled>Select Contact Group</option>
                                                        
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Select Survey</label>
                                                    <select class="form-control" name="survey">
                                                        <option value="1">PHC Board Report</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="submit" value="submit" class="btn btn-warning pull-right">Start Survey</button>
                                        <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                                    
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- END CALL MODAL MARKUP -->

                    </div>

                </div>
            @section('footer')
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.cedarviewng.com">Cedarview</a>
                    </p>
                </div>
            </footer>
            @show 
            </div>
        </div>
        
        
    </body>
    
    
	<!--   Core JS Files   -->
	<script src="{{ asset('assets/js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/material.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('assets/js/chartist.min.js') }}"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="{{ asset('assets/js/material-dashboard.js') }}"></script>
    
    <!-- My Plugins -->
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/myscript.js') }}"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="{{ asset('assets/js/demo.js') }}"></script>
    
    @yield('scripts')
</html>
