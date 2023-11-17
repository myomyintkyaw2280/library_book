<!-- Edit -->
<div class="modal fade pchannelModel" id="edit{{ $customer->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b><span class="customer_id">Edit Customer</span></b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('customers.update', $customer->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 pl-0 control-label">Customer Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                        value="{{ $customer->name }}" required>
                    </div>                 
                  
                    <div class="form-group">
                        <label for="phone" class="col-sm-4 pl-0 control-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $customer->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-4 pl-0 control-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $customer->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="new_pass" class="col-sm-4 pl-0 control-label">New Password</label>
                        <input type="password" class="form-control" id="new_pass" name="password">
                    </div>

                    <div class="form-group">
                        <label for="con_pass" class="col-sm-4 pl-0 control-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="con_pass" name="password_confirmation">
                    </div>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $customer->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">
               
              <h4 class="modal-title "><span class="customer_id">Delete Customer</span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h4 class="bold del_customer_name">{{$customer->name}}</h4>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
