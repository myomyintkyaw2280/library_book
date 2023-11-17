@extends('layouts.master')

@section('title', translate('book_list'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('rent') ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('home') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('rent_book') ?></a></li>
  
    </ol>
</div>
@endsection
@section('button')
        

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

	        @foreach( $books as $row)
	        <div class="col-3">
	            <div class="card">
	                <div class="card-body">                   
                   		<img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data={{$row->barcode}}&code=Code128&translate-esc=on'/>                            
	                </div>
	            </div>
	        </div>
           @endforeach 
           <div class="col-3">
	            <div class="card">
	                <div class="card-body">                   
                   		<img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=MEM-1&code=Code128&translate-esc=on'/>                            
	                </div>
	            </div>
	        </div>    
	    </div>

	    <div class="row">
	    	<div class="col-12">
	    		<div class="card">
	                <div class="card-body"> 

	                	<div class="form-row">
						    <div class="form-group col-md-6">
						      	<label for="member-scanner">Member Info</label>
						      	<input type="text" class="form-control"  id="member-scanner" placeholder="Member">
						    </div>
					    	<div class="form-group col-md-6">
						      	<label for="barcode-scanner"><?php echo translate('search_by_barcode') ?></label>
	                        	<input type="text" class="form-control" id="barcode-scanner" autocomplete="off" placeholder="<?php echo translate('enter_barcode') ?>" name="barcode" value="" >
						    </div>
					  	</div>
			    		<form class="form-horizontal" method="POST" action="{{route('saveRentBook')}}">
			    			@csrf

			    			<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="member">Member Name</label>
							      	<input type="text" class="form-control" readonly id="member_name" value="">
							      	<input type="text" class="form-control mt-2" readonly id="member_address" value="">
							      	<input type="hidden" name="member_id" id="member_id" value="">
							      	<input type="hidden" name="address" id="address" value="">
							    </div>
						    	<div class="form-group col-md-6">
							      	<label for="note"><?php echo translate('notes') ?></label>
							      	<textarea id="note" name="note" rows="3" class="form-control"></textarea>
							    </div>
						  	</div>
						  	<div class="form-row">
						  		<label for="barcode"><?php echo translate('books_list') ?></label>
						  		<table class="table">
									<thead class="thead-dark">
										<tr>
											<th scope="col">#</th>
											<th scope="col">Book Title</th>
											<th scope="col">Author</th>
										</tr>
									</thead>
									<tbody id="book-items">
										
									</tbody>
								</table>

						  	</div>
						  	<button type="submit" class="btn btn-primary">Save</button>
						</form>
	                </div>
	            </div>
	    	</div>
	    </div>
	</div> <!-- end col -->
</div> <!-- end row -->    
                                    

@endsection


@section('script')
<!-- Responsive-table-->
<script type="text/javascript">

	$('#barcode-scanner').on('change', function() {

        var barcode = $(this).val(); //receive barcode from scanner input

        // var bcount = barcodes.length;
        
        // //check barcode already scan?
        // let doBarcode = checkDataExists(barcodes, barcode);

        // if(doBarcode){
        //     barcodes[bcount] = barcode;
        // }
        console.log("New barcodes is ", barcode);
        // if(doBarcode){
            getBarcode(barcode);
        // }else{
            $('#barcode-scanner').val('');
        // }
    });

    $('#member-scanner').on('change', function() {

        var barcode = $(this).val(); //receive barcode from scanner input

        console.log("New barcodes is ", barcode);
        // if(doBarcode){
            getMember(barcode);
        // }else{
            $('#member-scanner').val('');
        // }
    });


	const getMember = (barcode) => {
        var count = 0;

        $.ajax({
            url: "{{route('searchMemberByBarcode')}}",
            type: 'POST',
            data:{"_token": "{{ csrf_token() }}", "barcode": barcode},
            success: function(response) {
                // let data = JSON.parse(response);
                if(response.statusCode == 200){
                	let data = response.result.data;

	                console.log("Book Title Scan =>", data);
	                console.log("Book Title Scan =>", data.id);
	                console.log("Book Author Scan =>", data.name);
	                if (data) {
	                    $('#barcode-scanner').val('');
	                    $('#member_id').val(data.id);
	                    $('#member_name').val(data.name);                  
	                    $('#address').val(data.address);                  
	                    $('#member_address').val(data.address);                  
	                }
                }
            }
        });
    }

    const getBarcode = (barcode) => {
        var count = 0;

        $.ajax({
            url: "{{route('searchBookByBarcode')}}",
            type: 'POST',
            data:{"_token": "{{ csrf_token() }}", "barcode": barcode},
            success: function(response) {
                // let data = JSON.parse(response);
                // console.log("Book Title Scan =>", data);
                // console.log("Book Title Scan =>", data.title);
                // console.log("Book Author Scan =>", data.author);
                // console.log("Barcode Scan =>", data.barcode);
                let row_data = '';
                if(response.statusCode == 200){
                	let data = response.result.data;
                	
                    let barcode_str = data.barcode;
                    $('#barcode-scanner').val('');
                    // no = no + $('[stack-id]');
                    let book_id = data.id;
                    let book_title = data.title;
                    let book_author = data.author;

                    count = $("#book-items > tr").length;

                    row_data += '<tr id="barcodeItem" stack-remove-id="'+ data.id +'">';
                    
                        row_data +=     '<td stack-id="'+ (count+1) +'">' + (count+1) + '</td>';
                        row_data +=     '<td>' + book_title + '<input type="hidden" name="book_id[]" value="' + book_id + '"></td>';
                        row_data +=     '<td>' + book_author + '</td>';
                   		row_data +=     '<td><button class="btn btn-danger" stack-remove="'+ book_id +'" style="width: 30px;height: 30px;padding: 4px;margin: 2px;border-radius:3px;"><i class="fa fa-times" aria-hidden="true"></i></button></td>';
                    row_data += '</tr>';
                    $('#book-items').append(row_data);
                }
            }
        });
    }

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

    $('body').on('click', '[stack-remove]', function() {
        var item_detail_id = $(this).attr('stack-remove');
        var isOkay = confirm("Do you want to continue?");
        console.log('is Okay ', isOkay);
        if(isOkay === true){
            $(this).parents("tr").remove();
        }
    }); 

</script>
@endsection