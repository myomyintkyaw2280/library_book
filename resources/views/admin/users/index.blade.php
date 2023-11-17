@extends('layouts.master')

@section('title', translate('title_admin_users'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('title_admin_users') ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('home') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('admin_users_list') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i><?php echo translate('addnewBtn') ?></a>
        

@endsection

@section('content')
@include('includes.flash')
<!--Show Validation Errors here-->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--End showing Validation Errors here-->


                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1"><?php echo translate('admin_id') ?></th>
                                                        <th data-priority="2"><?php echo translate('admin_name') ?></th>
                                                        <th data-priority="3"><?php echo translate('admin_email') ?></th>
                                                        <th data-priority="4"><?php echo translate('admin_role') ?></th>
                                                        <th data-priority="6"><?php echo translate('created_at') ?></th>
                                                        <th data-priority="7"><?php echo translate('updated_at') ?></th>
                                                        <th data-priority="8"><?php echo translate('action') ?></th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $admin_users as $user)
                                                        
                                                        <tr>
                                                            <td>{{$user->id}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>
                                                                @if(!empty($user->getRoleNames()))

                                                                    @foreach($user->getRoleNames() as $v)

                                                                    <label class="badge badge-success">{{ $v }}</label>

                                                                    @endforeach

                                                                @endif
                                                            </td>
                                                           
                                                            <td>{{custom_date_format($user->created_at)}}</td>
                                                            <td>{{custom_date_format($user->updated_at)}}</td>
                                                            <td>
                        
                                                                <a href="#edit{{$user->id}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> <?php echo translate('editBtn') ?></a>
                                                                <a href="#delete{{$user->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> <?php echo translate('deleteBtn') ?></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->    

@foreach( $admin_users as $user)
@include('admin.users.edit_delete')
@endforeach

@include('admin.users.add_user')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection