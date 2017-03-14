@extends('layouts.master')

@section('title', 'Surveys')

@section('content')
    <?php 
    /*if(isset($sucess)){
        echo '<div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span>'.$sucess.'</span>
                </div>';
    }else if(isset($error)){
        echo '<div class="alert alert-danger">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span>'.$error.'</span>
                </div>';

    }*/
    ?>
                    
	                <div class="row">
                        <div class="col-md-1"></div>
	                    <div class="col-md-10">
                            
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="{{ url('/create-new-survey') }}" class="btn btn-success">
                                       <i class="material-icons">person</i>
                                       <span>Create New Survey</span>
                                    </a>
                                </li>
                                <li  style="margin-left: 10px;" class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">
                                        <i class="material-icons">notifications</i>
                                        <span>View Survey Responses</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                       <?php
                                            foreach($res_survey as $surfn){
                                                    $string = "/survey/".$surfn->id."/results";
                                                    $url = url($string);
                                                echo "<li><a href=".$url.">".$surfn->title."</a></li>";

                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                            
                            <div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Surveys</h4>
	                                <p class="category">Created surveys available for launch.<br/>
                                        <span class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table</span>
                                    </p>
	                            </div>
	                            <div class="card-content">
                                    <ul class="list divider-full-bleed">
                                        @foreach ($res_survey as $surf)
                                        <li class="tile ink-reaction">
                                            <a class="tile-content ink-reaction">
                                                <div class="tile-text">
                                                    {{ $surf->title }}
                                                    <small>Created: {{ $surf->created_at }} | Updated: {{ $surf->updated_at }}</small>
                                                </div>
                                            </a>
                                            <a class="btn btn-simple ink-reaction btn-info btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-simple ink-reaction btn-danger btn-xs">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a class="btn btn-dark btn-simple ink-reaction">
                                                View Responses
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
	                            </div>
	                        </div>
	                    </div>
                        <div class="col-md-1"></div>
						
    </div>
@stop
