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
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('banner_add') ?></a></li>
  
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
		// print_r($banner);
		// echo "</pre>";
	?>

	<div class="row">
	    <div class="col-8 mx-auto">
	        <div class="card">
	        	<div class="card-header bg-primary text-white">
	        		<?php echo translate('banner_add') ?>
	        	</div>
	            <div class="card-body">
	                <form class="form-horizontal" method="POST" action="{{ route('members.store') }}" enctype='multipart/form-data'>
	                    @csrf
	                    <div class="form-group">
	                        <label for="title" class="col-sm pl-0 control-label"><?php echo translate('banner_title'); ?></label>
	                        <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo translate('banner_title'); ?>" value="" required>
	                    </div>

	                    <div class="form-group">
	                        <label for="url" class="col-sm pl-0 control-label"><?php echo translate('banner_url'); ?></label>
	                        <input type="text" class="form-control" id="url" placeholder="<?php echo translate('banner_url'); ?>" name="url" value="" >
	                    </div> 

	                    <div class="form-group">
	                        <input type="file" name="image" accept="image/png" />
	                    </div>  

	                    <div class="form-group">
	                    	<label for="description" class="col-sm pl-0 control-label"><?php echo translate('banner_description'); ?></label>
	                        <textarea name="description" class="form-control" id="description" stack-note /></textarea>
	                    </div>               
                  
                    	
                        <div class="form-group float-right">
                            <a href="{{route('members.index')}}" class="btn btn-secondary btn-flat"><?php echo translate('cancelBtn') ?></a>
	                		<button type="submit" class="btn btn-primary" name="save"><?php echo translate('saveBtn') ?></button>
                        </div>
                	</form>

	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    

@endsection

