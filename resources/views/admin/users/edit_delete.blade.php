<!-- Edit -->
<div class="modal fade pchannelModel" id="edit{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><span class="customer_id"><?php echo translate('edit_admin_user'); ?></span></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name"><?php echo translate('admin_name') ?></label>
                        <input type="text" class="form-control" placeholder="Enter Admin Name" id="name" name="name"
                            value="{{$user->name}}" required />
                    </div>
                    <!-- <div class="form-group">
                        <label for="roles"><?php //echo translate('admin_role') ?></label>
                        <input type="text" class="form-control" placeholder="Enter Admin Role" id="roles" name="roles"
                            required />
                    </div>
 -->
                    <div class="form-group">
                        <label for="email" class="col-sm-4  pl-0 control-label"><?php echo translate('admin_email') ?></label>
                        <input type="email" class="form-control" placeholder="Enter Admin email Address" id="email" name="email" 
                            value="{{$user->email}}" required>
                    </div>
                    <div class="form-group">
                        <label for="roles" class="col-sm-3 control-label"><?php echo translate('admin_role') ?></label>
                        <select class="form-control" id="roles" name="roles" required>
                            <option value="" selected>- Select -</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" <?php //echo ($role->id == $userRole)? "selected":""; ?>>{{ $role->name }}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4  pl-0 control-label"><?php echo translate('password') ?></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="con_pass" class="col-sm-4  pl-0 control-label"><?php echo translate('confirm_password') ?></label>
                        <input type="password" class="form-control" id="con_pass" name="password_confirmation" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> <?php echo translate('closeBtn') ?></button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i><?php echo translate('updateBtn') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">
               
              <h4 class="modal-title "><span class="customer_id">Delete Admin User</span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('users.destroy', $user->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6><?php echo translate('are_you_sure_delete') ?></h6>
                        <h4 class="bold del_customer_name">{{$user->name}}</h4>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> <?php echo translate('deleteBtn') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
