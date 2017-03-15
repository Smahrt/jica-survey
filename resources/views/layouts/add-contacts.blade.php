<!-- BEGIN CALL MODAL -->
<div class="modal fade" id="callCreate" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="simpleModalLabel">Add a New Contact</h4>
            </div>

            <form action="/insert" method="post">
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <div class=" col-sm-6 form-group">
                                <label for="lga">LGA</label>
                                <input type="text" class="form-control" required autocomplete="off" name="lga">
                            </div>
                            <div class=" col-sm-6 form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" required autocomplete="off" name="designation">
                            </div>
                            <div class=" col-sm-6 form-group">
                                <label for="phc_name">PHC Name</label>
                                <input type="text" class="form-control" required autocomplete="off" name="phc_name">
                            </div>
                            <div class=" col-sm-6 form-group">
                                <label for="officer name">Officer Name</label>
                                <input type="text" class="form-control" required autocomplete="off" name="officer_name">
                            </div>
                            <div class=" col-sm-6 form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" required autocomplete="off" name="phone_number">
                            </div>
                            <div class=" col-sm-6 form-group">
                                <label for="contact_group">Select Contact Group</label>
                                    <select class="form-control search-select" name="contact_type_id">
                                    <option disabled selected>Select Contact Group</option>
                                    @foreach ($res_con_type as $conType)
                                    <option  value ="{{$conType->id}}">{{$conType->type}}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-warning pull-right">Add Contact</button>
                <div class="clearfix"></div>
                </div>
            </form>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END CALL MODAL MARKUP -->

<script>
    $(document).ready(function(){
           /** Select boxes search **/
        $('.search-select').select2(); 
    });
</script>