<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><?php echo translate('add_new_country') ?></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('country.store') }}">
                        @csrf
                        <div class="form-group">
                        <label for="country_code" class="col-sm-4 pl-0 control-label"><?php echo translate('country_code') ?></label>
                        <input type="text" class="form-control" id="country_code" name="country_code" required>
                    </div> 

                    <div class="form-group">
                        <label for="name" class="col-sm-4 pl-0 control-label"><?php echo translate('country_name') ?></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>                 
                  
                    <div class="form-group">
                        <label for="phone_code" class="col-sm-4 pl-0 control-label"><?php echo translate('phone_code') ?></label>
                        <input type="text" class="form-control" id="phone_code" name="phone_code" >
                    </div>     

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


        </div>

    </div>
</div>
</div>
