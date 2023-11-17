@extends('layouts.master')

@section('title', translate('book_edit'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('book'); ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('books.index')}}"><?php echo translate('book') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('add_new_book') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="{{route('books.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>  

@endsection

@section('content')
<hr>
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
		// print_r($book);
		// echo "</pre>";
	?>


	<div class="row">
	    <div class="col-6 mx-auto">
	        <div class="card">
	        	<div class="card-header bg-primary text-white">
	        		<?php echo translate('add_new_book') ?>
	        	</div>
	            <div class="card-body">
	                <form class="form-horizontal" method="post" action="{{ route('books.update', $book->id) }}" enctype='multipart/form-data'>
	                    @csrf
	                    <input type="hidden" name="id" value="{{$book->id}}">
	                    
	                    <div class="form-group">
	                        <label for="title" class="col-sm-4 pl-0 control-label"><?php echo translate('book_name') ?></label>
	                        <input type="text" class="form-control" id="title" placeholder="<?php echo translate('book_name') ?>" name="title" value="{{$book->title}}"  required>
	                    </div> 

	                    <div class="form-group">
	                    	<label for="category" class="col-sm-4 pl-0 control-label"><?php echo translate('category'); ?></label>
	                    	<select name="category_id" class="form-control" id="category">
	                    		<?php 

	                    		foreach($category as $key => $value){
	                    			$selected = ($book->category_id == $value->id)?"selected":"";
	                    		?>
	                    			<option value="<?php echo $value->id ?>" {{$selected}}><?php echo $value->name; ?></option>
	                    		<?php } ?>
	                    	</select>
	                    </div>


	                    <div class="form-group">
	                        <label for="barcode" class="col-sm-4 pl-0 control-label"><?php echo translate('book_barcode') ?></label>
	                        <input type="text" class="form-control" id="barcode" placeholder="<?php echo translate('book_barcode') ?>" name="barcode" value="{{$book->barcode}}"
	                            required>
	                    </div> 

	                  
	                    <div class="form-group">
	                        <label for="isbn_no" class="col-sm-4 pl-0 control-label"><?php echo translate('isbn_no') ?></label>
	                        <input type="text" class="form-control" id="isbn_no" placeholder="<?php echo translate('isbn_no') ?>" name="isbn_no" value="{{$book->isbn_no}}" >
	                    </div>

	                    <div class="form-group">
	                        <label for="publisher" class="col-sm-4 pl-0 control-label"><?php echo translate('publisher') ?></label>
	                        <input type="text" class="form-control" id="publisher" placeholder="<?php echo translate('publisher') ?>" name="publisher" value="{{$book->publisher}}" >
	                    </div>

	                    <div class="form-group">
	                        <label for="author" class="col-sm-4 pl-0 control-label"><?php echo translate('author') ?></label>
	                        <input type="text" class="form-control" id="author" placeholder="<?php echo translate('author') ?>" name="author" value="{{$book->author}}" >
	                    </div>

	                    <div class="form-group">
	                        <label for="published_date" class="col-sm-4 pl-0 control-label"><?php echo translate('published_date') ?></label>
	                        <input type="date"  class="form-control" id="published_date" placeholder="<?php echo translate('published_date') ?>" name="published_date" value="{{$book->published_date}}" >
	                    </div>
	                    <div class="form-group">
	                        <label for="total_page" class="col-sm-4 pl-0 control-label"><?php echo translate('total_page') ?></label>
	                        <input type="number" min="1" step="1"  class="form-control" id="total_page" placeholder="<?php echo translate('total_page') ?>" name="total_page" value="{{$book->total_page}}" >
	                    </div>
	                    <div class="form-group">
	                        <label for="language" class="col-sm-4 pl-0 control-label"><?php echo translate('language') ?></label>
	                        <input type="text" class="form-control" id="language" placeholder="<?php echo translate('language') ?>" name="language" value="{{$book->language}}" >
	                    </div>

	                    <div class="form-group">
	                        <label for="overview" class="col-sm-4 pl-0 control-label"><?php echo translate('overview') ?></label>
	                        <textarea class="form-control" id="overview"  stack-note placeholder="<?php echo translate('overview') ?>" name="overview"><?php echo $book->overview ?></textarea>
	                    </div>

	                    <div class="form-group">
	                        <input type="file" name="image" accept="image/png, image/jpeg"  />
	                        <input type="hidden" name="old_image" value="{{$book->image}}">
	                    </div>                 
                  
                    	
                        <div class="form-group">
                            <a href="{{route('books.index')}}" class="btn btn-default btn-flat pull-left"><?php echo translate('cancelBtn') ?></a>
	                		<button type="submit" class="btn btn-primary" name="save"><?php echo translate('saveBtn') ?></button>
                        </div>
                	</form>

	            </div>
	        </div>
	    </div> <!-- end col -->
	</div> <!-- end row -->    
                                    

@endsection

