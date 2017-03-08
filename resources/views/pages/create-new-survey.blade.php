@extends('layouts.master')

@section('title', 'Contacts')

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
                            <div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Create New Survey</h4>
	                                <p class="category">Create a new survey form by adding questions and forms of answers</p>
	                            </div>
	                            <div class="card-content">
                                    <form>
	                                    <div class="row">
	                                        <div class="col-md-12">
												<div class="form-group label-floating">
													<label class="control-label">Survey Title</label>
                                                    <input type="text" class="form-control" name="surveyTitle" >
												</div>
	                                        </div>
	                                    </div>
                                        <div id="thequestion">
                                            <div class="title">
                                                <h4>Survey Questions</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">1. Question</label>
                                                        <textarea class="form-control" name="question" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Response Type</label>
                                                        <select type="text" class="form-control" name="question">
                                                            <option disabled selected>Select Response Type</option>
                                                            <option value="free-response">Free Response</option>
                                                            <option value="yes-no">Yes/No</option>
                                                            <option value="numeric">Numeric</option>
                                                        </select>
                                                    </div>
                                                    <button type="button" class="btn btn-success pull-right add-question">
                                                        Add Question
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning">Create Survey</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
	                            </div>
	                        </div>
	                    </div>
						<div class="col-md-5">
                          
            @endsection
            
            @section('make-call')
        </div>
    </div>


        

@section('footer')