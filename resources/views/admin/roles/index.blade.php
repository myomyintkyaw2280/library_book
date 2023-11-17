@extends('layouts.master')

@section('title', translate("roles"))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate("roles") ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('home') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('roles_list') ?></a></li>
  
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
                            <th data-priority="1"><?php echo translate('id') ?></th>
                            <th data-priority="2"><?php echo translate('name') ?></th>
                            <th data-priority="5"><?php echo translate('created_at') ?></th>
                            <th data-priority="5"><?php echo translate('updated_at') ?></th>
                            <th data-priority="6"><?php echo translate('action') ?></th>
                         
                        </tr>
                        </thead>
                        <tbody>
                            @foreach( $roles as $row)

                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>                                                           
                                <td>{{custom_date_format($row->created_at)}}</td>
                                <td>{{custom_date_format($row->updated_at)}}</td>
                                <td>

                                    <a href="#edit{{$row->id}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                    <a href="#delete{{$row->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->    
                                    

@foreach( $roles as $row)
@include('admin.roles.edit_delete')
@endforeach

@include('admin.roles.add_role')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection