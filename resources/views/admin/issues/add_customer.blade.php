<!-- Add -->
<div class="modal fade pchannelModel" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Add New Customer</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('customers.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Employee Name" id="name" name="name"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone no</label>
                            <input type="text" class="form-control" placeholder="Enter Employee Name" id="phone" name="phone"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4  pl-0 control-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4  pl-0 control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="con_pass" class="col-sm-4  pl-0 control-label">Confirm Password</label>
                            <input type="password" class="form-control" id="con_pass" name="password_confirmation">
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
