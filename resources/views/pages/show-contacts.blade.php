@extends('layouts.master')
@section('title', 'Contacts')
<?php use App\Http\Controllers\MainController; ?>


@section('sidebar')
    @parent
@endsection

@section('content')


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
                                            @foreach ($contact as $user_array)
                                                <form action="edit/{{ $user_array->id }}" method="post">
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="optionsCheckboxes" class="checkContact checkbox-me">
                                                        </td>
                                                        <td><input type="text" name="officer_name" value="{{ $user_array->officer_name }}"/></td>
                                                        <td><input type="text" name="phc_name" value="{{ $user_array->phc_name }}"/></td>
                                                        <td><input type="text" name="phone_number" value="{{ $user_array->phone_number }}"/></td>
                                                        <td><?php MainController::showContactGroups($user_array->contact_type_id); ?></td>
                                                        <td class="td-actions text-right">
                                                            <a href="edit/{{ $user_array->id }}">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-primary btn-simple btn-xs" data-original-title="Edit Contact">
                                                                    <i class="material-icons">edit</i>
                                                                </button>
                                                            </a>
                                                            <a href="delete/{{ $user_array->id }}">
                                                                <button type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove Contact">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                            </a>    
                                                        </td> 
                                                        <td><input type="submit" value="update"/></td>
                                                    </tr>
                                                </form>
                                            @endforeach
	                                    </tbody>
	                                </table>

	                            </div>
	                       