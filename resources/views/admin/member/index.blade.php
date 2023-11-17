@extends('layouts.master')

@section('name', translate('members_list'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('members_list') ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('home') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('members_list') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus-circle mr-2"></i><?php //echo translate('addnewBtn'); ?></a> -->
    <a href="{{route('members.create')}}" class="btn btn-primary btn-sm "><i class='fa fa-plus-circle mr-2'></i> <?php echo translate('addnewBtn'); ?></a>

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

                                <th data-priority="1"> <?php echo translate('member_id') ?></th>
                                <th data-priority="1"> <?php echo translate('member_image') ?></th>
                                <th data-priority="2"> <?php echo translate('member_name') ?></th>
                                <th data-priority="3"> <?php echo translate('email_address') ?></th>
                                <th data-priority="4"> <?php echo translate('phone_number') ?></th>
                                <th data-priority="6"> <?php echo translate('since_member') ?></th>
                                <th data-priority="5"> <?php echo translate('status') ?></th>
                                <th data-priority="7"> <?php echo translate('action') ?></th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach( $members as $row)

                            <?php 
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
                                <td class="text-left" width="20%">
                                    <?php if(!is_null($row->image)){ ?>
                                        <img src="<?php echo base_url($row->image); ?>" style="width: 35%;">
                                    <?php } ?>
                                </td>
                                <td class="text-left">{{$row->name}}</td>
                                <td class="text-center">{{$row->email}}</td>
                                <td class="text-center">{{$row->phone}}</td>
                               
                                <td class="text-center"><?php echo (!is_null($row->created_at))?custom_date_format($row->created_at):""; ?></td>
                                <td class="text-center">
                                        <button change-status="<?php echo ($row->status)? 0:1; ?>" status-id="<?php echo $row->id; ?>" class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa <?php echo $btnIcon; ?>"></i> <?php echo $btnTxt; ?></button>
                                </td>
                                <!-- <td class="text-center"><?php //echo (!is_null($row->updated_at))?custom_date_format($row->updated_at):""; ?></td> -->
                                <td class="text-center">
                                    <a href="{{route('members_view', $row->id)}}" class="btn btn-primary btn-sm "><i class='fa fa-eye'></i> View</a>
                                    <a href="{{route('members_edit', $row->id)}}" class="btn btn-success btn-sm " id="edit_reward"><i class='fa fa-edit'></i> <?php echo translate('editBtn') ?></a>
                                    <a href="#delete{{$row->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> <?php echo translate('deleteBtn') ?></a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->    
                                        

    @foreach( $members as $row)
        @include('admin.member.delete')
    @endforeach

@endsection


@section('script')
<!-- Responsive-table-->
<script type="text/javascript">

    $(document).on('click', '[change-status]', function(){
        var status = $(this).attr('change-status');
        var id = $(this).attr('status-id');
        const pUrl = "{{route('members_change_status')}}";
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