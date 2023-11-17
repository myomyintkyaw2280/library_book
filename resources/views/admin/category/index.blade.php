@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Category</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Category</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Category List</a></li>

    </ol>
</div>
@endsection
@section('button')
<a href="{{route('category.create')}}" class="btn btn-primary btn-sm "><i class='fa fa-plus-circle mr-2'></i> <?php echo translate('addnewBtn'); ?></a>

@endsection

@section('content')
@include('includes.flash')
@include('includes.messages')
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
                                                        <th class="text-center" data-priority="1">ID</th>
                                                        <th class="text-center" data-priority="2">Name</th>
                                                        <th class="text-center" data-priority="5">Status</th>
                                                        <th class="text-center" data-priority="5">Created Date</th>
                                                        <th class="text-center" data-priority="5">Updated Date</th>
                                                        <th class="text-center" data-priority="7">Actions</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $no = 1; 
                                                        ?>
                                                        @foreach( $categories as $row)
                                                            <?php

                                                                $badge = "danger";
                                                                $txt = "No";
                                                                if($row->status){
                                                                    $btn = "success";
                                                                    $btnTxt = "Active";
                                                                    $btnIcon = "fa-check-circle";
                                                                }else{
                                                                    $btn = "danger";
                                                                    $btnTxt = "Inactive";
                                                                    $btnIcon = "fa-times-circle";
                                                                }
                                                            ?>
                                                        <tr>
                                                            <td class="text-right">{{$no}}</td>
                                                            <td>{{$row->name}}</td>
                                                            

                                                            <td class="text-center">
                                                                <button change-status="<?php echo ($row->status)? 0:1; ?>" status-id="<?php echo $row->id; ?>" class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa <?php echo $btnIcon; ?>"></i> <?php echo $btnTxt; ?></button>
                                                            </td>
                                                            <td class="text-center">{{custom_date_format($row->created_at)}}</td>
                                                            <td class="text-center">{{custom_date_format($row->updated_at)}}</td>
                                                            <td class="text-center">

                                                                <a href="{{route('category_edit', $row->id)}}" class="btn btn-success btn-sm " id="edit_reward"><i class='fa fa-edit'></i> Edit</a>
                                                                <a href="#delete{{$row->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->


@foreach( $categories as $row)

@include('admin.category.delete')
@endforeach


@endsection


@section('script')

<script type="text/javascript">

    $(document).on('click', '[change-status]', function(){
        var status = $(this).attr('change-status');
        var id = $(this).attr('status-id');
        const pUrl = "{{route('category_change_status')}}";
        console.log(pUrl);
        console.log("Pricing change-status", pUrl);
        var c = confirm("Are you sure want to change?");
        if (c) {
            let data = {"_token": "{{ csrf_token() }}",'status':status, 'id':id};
            $.changeStatus(pUrl, data);
        }
    });

</script>

@endsection
