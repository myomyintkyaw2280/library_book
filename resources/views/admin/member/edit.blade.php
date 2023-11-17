@extends('layouts.master')

@section('title', translate('banner_edit'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('banners'); ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('banners.index')}}"><?php echo translate('banners') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('banner_edit') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="{{route('banners.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>  

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
	        		<?php echo translate('banner_edit') ?>
	        	</div>
	            <div class="card-body">
	                <form class="form-horizontal" method="POST" action="{{ route('banners.update', $banner->id) }}" enctype='multipart/form-data'>
	                    @csrf
	                    <input type="hidden" name="_method" value="PUT">
	                    <input type="hidden" name="old_image" value="{{$banner->image}}">
	                    <div class="form-group">
	                        <label for="title" class="col-sm-4 pl-0 control-label"><?php echo translate('banner_title'); ?></label>
	                        <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}" required>
	                    </div>

	                    <div class="form-group">
	                        <label for="url" class="col-sm-4 pl-0 control-label"><?php echo translate('banner_url'); ?></label>
	                        <input type="text" class="form-control" id="url" name="url" value="{{ $banner->url }}" >
	                    </div> 

	                    <div class="form-group">
	                        <input type="file" name="image" accept="image/png" />
	                    </div>

	                    <div class="form-group">
	                    	<label for="description" class="col-sm-4 pl-0 control-label"><?php echo translate('banner_description'); ?></label>
	                        <textarea name="description" class="form-control" id="description" stack-note /><?php echo $banner->description; ?></textarea>
	                    </div>             
                  
                    	
                        <div class="form-group float-right">
                            <a href="{{route('banners.index')}}" class="btn btn-secondary btn-flat"><?php echo translate('cancelBtn') ?></a>
	                		<button type="submit" class="btn btn-primary" name="save"><?php echo translate('updateBtn') ?></button>
                        </div>
                	</form>

	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    

@endsection

