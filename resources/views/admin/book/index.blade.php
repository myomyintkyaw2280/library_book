@extends('layouts.master')

@section('title', translate('book_list'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('book_list') ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('home') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('book_list') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i><?php //echo translate('addnewBtn'); ?></a> -->
<a href="{{route('books.create')}}" class="btn btn-primary btn-sm "><i class='fa fa-plus-circle mr-2'></i> <?php echo translate('addnewBtn'); ?></a>
        

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
                                                        <th data-priority="1">ID</th>
                                                        <th data-priority="2"><?php echo translate('books_image') ?></th>
                                                        <th data-priority="3"><?php echo translate('books_title') ?></th>
                                                        <th data-priority="4"><?php echo translate('books_ISBN_no.') ?></th>
                                                        <th data-priority="5"><?php echo translate('barcode_no') ?></th>
                                                        <th data-priority="6"><?php echo translate('author') ?></th>
                                                        <th data-priority="7"><?php echo translate('publisher') ?></th>
                                                        <th data-priority="8"><?php echo translate('published_date') ?></th>
                                                        <th data-priority="9"><?php echo translate('availble'); ?></th>
                                                        <th data-priority="10"><?php echo translate('created_at'); ?></th>
                                                        <th data-priority="11"><?php echo translate('updated_at') ?></th>
                                                        <th data-priority="12"><?php echo translate('action') ?></th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1; ?>
                                                        @foreach( $books as $row)

                                                        <?php 
                                                            if($row->is_available){
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
                                                            <td class="text-center">
                                                                <?php if(!is_null($row->image) && file_exists($row->image)){ ?>
                                                                    <img src="<?php echo base_url($row->image); ?>" style="width: 35%; height: 5%;">
                                                                <?php } ?>
                                                            </td>
                                                            <td>{{$row->title}}</td>
                                                            <td class="text-center">{{$row->isbn_no}}</td>
                                                            <td class="text-center"><img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data={{$row->barcode}}&code=Code128&translate-esc=on'/></td>
                                                            <td class="text-center">{{$row->author}}</td>
                                                            <td class="text-center">{{$row->publisher}}</td>
                                                            <td><?php echo custom_date_format($row->published_date); ?></td>
                                                           
                                                            <td>
                                                                <button change-status="<?php echo ($row->status)? 0:1; ?>" status-id="<?php echo $row->id; ?>" class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa <?php echo $btnIcon; ?>"></i> <?php echo $btnTxt; ?></button>
                                                            </td>
                                                            <td><?php echo (isset($row->created_at))?custom_date_format($row->created_at):""; ?></td>
                                                            <td><?php echo (isset($row->updated_at))?custom_date_format($row->updated_at):""; ?></td>
                                                            <td>
                                                                <a href="{{route('books.view', $row->id)}}" class="btn btn-primary btn-sm "><i class='fa fa-eye'></i> View</a>
                                                                <a href="{{route('books.edit', $row->id)}}" class="btn btn-success btn-sm " id="edit_reward"><i class='fa fa-edit'></i> <?php echo translate('editBtn') ?></a>
                                                                <a href="#delete{{$row->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> <?php echo translate('deleteBtn') ?></a>
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
                                    

@foreach( $books as $row)
    @include('admin.book.delete')
@endforeach


@endsection


@section('script')
<!-- Responsive-table-->
<script type="text/javascript">

    $(document).on('click', '[change-status]', function(){
        var status = $(this).attr('change-status');
        var id = $(this).attr('status-id');
        const pUrl = "{{route('book_change_status')}}";
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