@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Customers</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Book Issues</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Book Issues List</a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
        

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
                                <th data-priority="1">ID</th>
                                <th data-priority="2">Member Name</th>
                                <th data-priority="3">Total Book</th>
                                <th data-priority="4">Approved by</th>
                                <th data-priority="5">Return Approved by</th>
                                <th data-priority="6">Date</th>
                                <th data-priority="7">Actions</th>
                             
                            </tr>
                            </thead>
                            <tbody>

                                @foreach( $customers as $customer)
                                <?php 
                                    $phonecode = $customer->country;
                                    $phone_code = (!is_null($phonecode))?$phonecode->phone_code:"";
                                    $country_name = (!is_null($phonecode))?$phonecode->name:"";
                                ?>
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td><?php echo $phone_code. $customer->phone; ?></td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$country_name}}</td>
                                   
                                    <td>{{custom_date_format($customer->created_at)}}</td>
                                    <td>
                                        <a href="{{route('customers.show', $customer->id)}}" class="btn btn-primary btn-sm "><i class='fa fa-eye'></i> View</a>
                                        <a href="#edit{{$customer->id}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                        <a href="#delete{{$customer->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
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
                                    

@foreach( $customers as $customer)
@include('admin.customer.edit_delete')
@endforeach

@include('admin.customer.add_customer')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection