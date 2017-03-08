@extends('layouts.master')

@section('content')

 
<form action ="{{url('/call')}}" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="phone Number" name="phone_number">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Survey</label>
    <select class="form-control" name="survey">
        <option value="1">PHC Board Report</option>
    </select>
  </div>
  <button type="submit" class="btn btn-default">Make Call</button>
</form>

@stop