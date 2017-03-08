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
	                                <h4 class="title">Surveys</h4>
	                                <p class="category">Created surveys available for launch.<br/>
                                        <span class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table</span>
                                    </p>
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table class="table">
	                                    <thead class="text-primary">
	                                       <tr>
                                                <th>#</th>
                                                <th>Survey Title</th>
                                                <th>Created On</th>
                                                <th>Last Updated</th>
                                                <th>Action</th>
	                                       </tr>
                                        </thead>
	                                    <tbody>
                                            @foreach ($result as $surf)
	                                        <tr>
                                                <td>{{ $surf->id }}</td>
                                                <td>{{ $surf->title }}</td>
                                                <td class="text-primary">{{ $surf->created_at }}</td>
                                                <td class="text-primary">{{ $surf->updated_at }}</td>
                                                
	                                        	<td class="td-actions text-right">
                                                    <button type="button" id="{{ $surf->id }}" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit Contact">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <button type="button" id="{{ $surf->id }}" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove Contact">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </td>
	                                        </tr>
                                            @endforeach
	                                    </tbody>
	                                </table>

	                            </div>
	                        </div>
	                    </div>
						<div class="col-md-5">
                          
            @endsection
            
            @section('make-call')
                @parent
            @endsection
        </div>
    </div>

@section('footer')
    @parent
@endsection