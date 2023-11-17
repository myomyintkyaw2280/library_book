<!-- Add -->
    <div class="modal fade pchannelModel" id="dynamic_field_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reward Type : <b><?php echo $reward->name; ?></b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>

                </div>

                <div class="modal-body">

                    <div class="card-body text-left">

                        <form method="POST" action="{{ route('store_price') }}">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="reward_id" value="<?php echo $reward->id; ?>" />
                                <label for="price" class="pl-0 control-label">Set Pricing</label><br>
                                <small>Name is currency code such as US, MMK, SGD, THB</small>
                                <!-- <div class="col-12 pl-0 pr-0 mb-3"> -->
                                    <div class="table-responsive bordered-none">
                                       <table class="table" id="dynamic_field">

                                       </table>
                                    </div>
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