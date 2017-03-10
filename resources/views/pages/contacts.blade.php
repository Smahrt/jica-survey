@extends('layouts.master')
@section('title', 'Contacts')
<?php use App\Http\Controllers\MainController; ?>


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
                        <div class="col-md-1"></div>
	                    <div class="col-md-10">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="" class="btn btn-success">
                                       <i class="material-icons">person</i>
                                       <span>Create New Contact</span>
                                    </a>
                                </li>
                                <li  style="margin: 0 0 0 10;" >
                                    <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" >
                                        <i class="material-icons">group</i>
                                        <span>Create Contact Group</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($res_con_type as $contactGrp)

                                        <!--Here--><li><a href="{{ url('/surveys//results') }}">{{ $contactGrp->type }}</a></li>

                                        @endforeach
                                    </ul>
                                </li>
                                <li style="margin: 0 0 0 10;">
                                    <a href="" class="btn btn-success">
                                       <i class="material-icons">edit</i>
                                       <span>Edit Contact Group</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="card">
	                            <div class="card-header" data-background-color="orange">
	                                <h4 class="title">Contacts</h4>
	                                <p class="category">Available contacts from all PHCs.<br/>
                                        <span class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table</span>
                                    </p>
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table id="contactTable" class="table">
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
                                            @foreach ($res_contact as $user_array)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="optionsCheckboxes" class="checkContact checkbox-me">
                                                </td>
                                                <td>{{ $user_array->officer_name }}</td>
                                                <td>{{ $user_array->phc_name }}</td>
                                                <td>{{ $user_array->phone_number }}</td>
                                                <td><?php MainController::showContactGroups($user_array->contact_type_id); ?></td>
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
                        <div class="col-md-1"></div> 
            </div>
@endsection

@section('footer')
    @parent
@endsection

<script>
/** Check box Script **/
    $('#checkAll').change(function(){
               var theRest = $('.table tbody tr td :checkbox');
                
                if($(this).is(':checked')){
                    theRest.attr("checked");
                }else{
                    theRest.attr("checked", false);
                }
            });
    
    $('#contactTable').DataTable( {
        "dom": 'lCfrtip',
         "order": [],
        "language": {
            "lengthMenu": '_MENU_ entries per page',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                "next": '<i class="fa fa-angle-right"></i>'
            }
        }
    } );
</script>