@extends('layouts.master')

@section('title', 'Customer List')
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Reward Type</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('members.index')}}"><?php echo translate('members') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('member_view') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="{{route('members.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>  

@endsection

@section('content')
	

	<?php 
		$member = $members;
		// print_r($member);
	?>

	<div class="row">
	    <div class="col-12">
	        <div class="card">
	            <div class="card-body">
	                <table class="table table-striped">
                		<tr>
                			<th>Profile </th>
                			<th><img src="<?php echo isset($member->image)? base_url($member->image):''; ?>" style="width: 100%;"></th>
                		</tr>
                		<tr>
                			<th>Name </th>
                			<th>: <?php echo $member->name; ?></th>
                		</tr>
                		<tr>
                			<th>Name </th>
                			<th>: <?php echo $member->email; ?></th>
                		</tr>
                		<tr>
                			<th>Name </th>
                			<th>: <?php echo $member->phone; ?></th>
                		</tr>
                	</table>
	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    

@endsection

