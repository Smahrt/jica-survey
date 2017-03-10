<!-- BEGIN CALL MODAL -->
<div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="simpleModalLabel">Make a Call</h4>
                <p class="category">Start a new survey by calling a contact or selecting a contact group</p>
            </div>

            <form action="{{url('/call')}}" method="post">
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Select Contact</label>

                            <select id="contacts" name="phone_number" data-live-search="true" class="form-control">

                                <option disabled selected>Select Contact</option>
                                <option value="+2348182362521">Yoshito Kawakatsu</option>
                                <option value="+2349095953951">Smahrt</option>
                                <option value="+2348050367060">Mr. Shola</option>
                                <option value="+2348137809477">Dawn</option>

                                @foreach($res_contact as $user)
                                <option value="{{ $user->phone_number }}">{{ $user->officer_name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-1">
                        <p>OR</p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Select Contact Group</label>
                            <select id="contact-group" class="form-control">
                                <option selected disabled>Select Contact Group</option>

                                @foreach($res_con_type as $user_g)
                                <option value="{{ $user_g->id }}">{{ $user_g->type }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Select Survey</label>
                            <select class="form-control" name="survey">
                                <option disabled selected>Select Survey</option>

                                @foreach($res_survey as $survey)
                                <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-warning pull-right">Start Survey</button>
                <div class="clearfix"></div>
                </div>
            </form>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END CALL MODAL MARKUP -->