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

    */
    ?>
	                <div class="row">
	                    <div class="col-md-8">
                            <div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Contacts</h4>
	                                <p class="category">Available contacts from all PHCs.<br/>
                                        <span class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table</span>
                                    </p>
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table class="table">
	                                    <thead class="text-primary">
	                                       <tr>
                                                <th>
                                                    <input type="checkbox" name="optionsCheckboxes" id="checkAll" class="checkbox-me">
                                                </th>
                                                <th>Officer Name</th>
                                                <th>PHC Name</th>
                                                <th>Phone</th>
                                                <th>Contact Group</th>
                                                <th>Action</th>
	                                       </tr>
                                        </thead>
	                                    <tbody>
                                            @foreach ($result as $user_array)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="optionsCheckboxes" class="checkContact checkbox-me">
                                                </td>
                                                <td>{{ $user_array->officer_name }}</td>
                                                <td>{{ $user_array->phc_name }}</td>
                                                <td>{{ $user_array->phone_number }}</td>
                                                <td>{{ $user_array->type }}</td>
	                                        	<td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit Contact">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove Contact">
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
						<div class="col-md-4">
                          
            @endsection
            
            @section('make-call')
                @parent
            @endsection
        </div>
    </div>

@section('footer')
    @parent
@endsection

@section('scripts')
<script>
/** CHeck box Script **/
    $('#checkAll').change(function(){
               var theRest = $('.table tbody tr td :checkbox');
                
                if($(this).is(':checked')){
                    theRest.attr("checked");
                }else{
                    theRest.attr("checked", false);
                }
            });
</script>
@endsection