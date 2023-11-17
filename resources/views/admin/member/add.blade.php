@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('members'); ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('members.index')}}"><?php echo translate('members') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('member_add') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="{{route('members.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>  

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
		// echo "<pre>";
		// print_r($member);
		// echo "</pre>";
	?>

	<div class="row">
	    <div class="col-8 mx-auto">
	        <div class="card">
	        	<div class="card-header bg-primary text-white">
	        		<?php echo translate('member_add') ?>
	        	</div>
	            <div class="card-body">
	                <form method="POST" action="{{ route('members.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Member Name" id="name" name="name"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone no</label>
                            <input type="text" class="form-control" placeholder="Enter phone number" id="phone" name="phone"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4  pl-0 control-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email address" name="email">
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-4  pl-0 control-label">Address</label>
                            <textarea id="addres" class="form-control" placeholder="Enter address" name="address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4  pl-0 control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="con_pass" class="col-sm-4  pl-0 control-label">Confirm Password</label>
                            <input type="password" class="form-control" id="con_pass" name="password_confirmation">
                        </div>


                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    

@endsection

