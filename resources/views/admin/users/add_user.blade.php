<!-- Add -->
<div class="modal fade pchannelModel" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><?php echo translate('add_new_user') ?></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><?php echo translate('admin_name') ?></label>
                            <input type="text" class="form-control" placeholder="Enter Admin Name" id="name" name="name"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="roles"><?php echo translate('admin_role') ?></label>
                            <input type="text" class="form-control" placeholder="Enter Employee Name" id="roles" name="roles"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4  pl-0 control-label"><?php echo translate('admin_email') ?></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4  pl-0 control-label"><?php echo translate('password') ?></label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="con_pass" class="col-sm-4  pl-0 control-label"><?php echo translate('confirm_password') ?></label>
                            <input type="password" class="form-control" id="con_pass" name="password_confirmation" required>
                        </div>


                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <?php echo translate('saveBtn') ?>
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
                                    <?php echo translate('cancelBtn'); ?>
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
