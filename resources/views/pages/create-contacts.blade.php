<!-- app/views/login.blade.php -->
@section('title', 'Create Contact')


<!doctype html>
<html>
<head>
<title>JICA Data Collection App - @yield('title')</title>
</head>
<body>


<!-- if there are login errors, show them here -->
<div id ="error" class="">
<p>
    @if(isset($success_message))
         {!!$success_message !!}
    @endif

</p>
</div>
<form action="/insert" method="post">
    <input type="text" placeholder="lga" name="lga"/>
    <input type="text" placeholder="designation" name="designation"/>
    <input type="text" placeholder="phc_name" name="phc_name"/>
    <input type="text" placeholder="officer_name" name="officer_name"/>
    <input type="text" placeholder="phone_number" name="phone_number"/>
    <select name="contact_type_id">
        <option disabled selected>Select Contact Group</option>
        @foreach ($res_con_type as $conType)
        <option  value ="{{$conType->id}}">{{$conType->type}}</option>
        @endforeach
    </select>
    <input type="submit" value="Add Contact"/>
</form>



