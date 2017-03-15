@extends('layouts.master')

@section('title', 'Contacts')

<?php use App\Http\Controllers\MainController; ?>

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

    <p>
        @if(isset($success_message))
             {!!$success_message !!}
        @endif
    </p>
        
        <?php if( isset($error) ): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
            <?php endif; ?>

    
	               

    <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Contacts</h4>
                        <p>
                            <a href="#" data-toggle="modal" data-target="#callCreate" class="btn btn-empty btn-simple">
                                <i class="material-icons">create</i> Add Contact
                            </a>
                            
                            <span class="div-sp">|</span>
                            <a class="btn btn-empty btn-simple">
                                <i class="material-icons">group_add</i> Add 4 Contacts to Group
                            </a>
                            <span class="div-sp">|</span>
                            <a class="btn btn-empty btn-simple">
                                <i class="material-icons">close</i> Delete 4 Contacts
                            </a>
                        </p>
                        <p class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table
                        </p>
                    </div>
                    <div class="card-content">
                        <div class=" table-responsive">
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
                                    <?php
                                        $del_string = "/delete/".$user_array->cid;
                                        $d_url = url($del_string);
                                        
                                        $sh_string = "/show/".$user_array->cid;
                                        $s_url = url($sh_string);
                                    ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="optionsCheckboxes" class="checkContact checkbox-me">
                                    </td>
                                    <td>{{ $user_array->officer_name }}</td>
                                    <td>{{ $user_array->phc_name }}</td>
                                    <td>{{ $user_array->phone_number }}</td>
                                    <td><?php MainController::showContactGroups($user_array->contact_type_id); ?></td>
                                    <td class="td-actions text-right">
                                                    <a href=href="#" data-toggle="modal" data-target="#callEdit" class="btn btn-empty btn-simple">
                                                        <button value="{{ $user_array->cid }}" type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit Contact">
                                                        <i class="material-icons">edit</i>
                                                        </button>
                                                    </a>
                                                    <a href="{{$d_url}}">
                                                        <button value="{{ $user_array->cid }}" type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove Contact">
                                                        <i class="material-icons">close</i>
                                                        </button>
                                                    </a>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Contact Groups</h4>
                        <p>
                            <a class="btn btn-empty btn-simple">
                                <i class="material-icons">create</i> Add Group
                            </a>
                        </p>
                        <p class="hidden-lg hidden-md hidden-sm"><i class="material-icons">info_outline</i> Swipe left to see full table</p>
                    </div>
                    <div class="card-content">
                        <ul class="list divider-full-bleed">
                            @foreach ($res_con_type as $contactGrp)
                            <li class="tile ink-reaction">
                                <a class="tile-content ink-reaction">
                                    <div class="tile-text">
                                        {{ $contactGrp->type }}
                                    </div>
                                </a>
                                <a type="button" title="" class="btn btn-danger btn-simple btn-xs">
                                    <i class="material-icons">close</i>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div> 
</div>
@endsection

@section('scripts')


<script type="text/javascript">
    $(document).ready(function(){
        
       /** Check box Script **/
   // add multiple select / deselect functionality
	$("#checkAll").click(function () {
		  $('.checkContact').not(this).prop('checked', this.checked);
	});

	// if all checkbox are selected, check the selectall checkbox
	// and viceversa
	$(".checkContact").click(function(){

		if($(".checkContact").length == $(".checkContact:checked").length) {
			$("#checkAll").prop("checked", true);
		} else {
			$("#checkAll").prop("checked", false);
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
     
    });

</script>

@endsection