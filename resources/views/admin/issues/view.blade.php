@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Reward Type</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Reward Type</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Reward Type View</a></li>
  
    </ol>
</div>
@endsection
@section('button')
 <a href="{{route('customers.index')}}" class="btn btn-primary">Back</a>  

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
	<?php 
		$row = $customer_row[0];
		echo $country = ($row->country);
	?>

	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
                    <div class="col-8 p-5" >
    	                <h2 class="mb-4">Customer Name : <?php echo $row->name; ?></h2>
                    </div>
	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    



@endsection

