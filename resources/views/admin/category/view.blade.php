@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Reward Type</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}"><?php echo translate('categories') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('reward_type_view') ?></a></li>

    </ol>
</div>
@endsection
@section('button')
<a href="{{route('category.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>

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
		$category = $categories[0];
		// $pricing = json_decode($category->pricing);
	?>

	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
                    <div class="col-8 p-5">
    	                <h2 class="mb-4"><?php echo translate('category_name');?> : <?php echo $category->name; ?></h2>
                        <img src="{{base_url($category->image)}}" alt="">
                    </div>
	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->

</div>


@endsection


