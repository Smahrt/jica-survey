@extends('layouts.master')
<?php use App\Http\Controllers\MainController; ?>

@section('title', 'Dashboard')

@section('sidebar')
    @parent
@endsection

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
        <div class="col-md-7">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="purple">
                            <i class="material-icons">content_paste</i>
                        </div>
                        <div class="card-content">
                            <p class="category">All Surveys</p>
                            <h3 class="title">
                                <?php
                                    MainController::showNumRows("surveys");
                                ?>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">local_offer</i>
                                Last Updated: 2mins ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">call</i>
                        </div>
                        <div class="card-content">
                            <p class="category">All Calls</p>
                            <h3 class="title">305</h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">access_time</i>
                                Last call 2 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="red">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="card-content">
                            <p class="category">Contact Groups</p>
                            <h3 class="title">
                                <?php
                                    MainController::showNumRows("contact_type");
                                ?>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="card-content">
                            <p class="category">All Contacts</p>
                            <h3 class="title">
                                <?php
                                    MainController::showNumRows("contacts");
                                ?>
                            </h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            @endsection
            
            @section('make-call')
        </div>
    </div>


        

@section('footer')
@parent
@endsection