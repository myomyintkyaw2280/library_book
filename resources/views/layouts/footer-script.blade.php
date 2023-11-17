<!-- App's Basic Js  -->
<script src="{{ base_url('assets/js/jquery.min.js') }}"></script>
<script src="{{ base_url('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ base_url('assets/js/metisMenu.min.js') }}"></script>
<script src="{{ base_url('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ base_url('assets/js/waves.min.js') }}"></script>

 @yield('script')

<!-- App js-->
<script src="{{ base_url('assets/js/app.js') }}"></script>

<script type="text/javascript">
	const perPageRow = parseInt("<?php echo getTableRow();?>");
	console.log("Data Table number of row =>", perPageRow);
</script>

<!-- Sweet-Alert  -->
{{-- <script src="{{ base_url('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ base_url('assets/pages/sweet-alert.init.js') }}"></script>   --}}
<script src="{{base_url('js/sweetalert.min.js') }}"></script>
<!-- Responsive-table-->
<script src="{{ base_url('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>      
<!-- Required datatable js -->
<script src="{{ base_url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ base_url('plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ base_url('plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ base_url('plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ base_url('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ base_url('assets/pages/datatables.init.js') }}"></script>   

<!-- include summernote css/js -->
<script src="{{ base_url('plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ base_url('plugins/noti/noti.js') }}"></script>
<script>

/*	$(document).on('click', '.modal', function(){
        $('.pchannelModel').modal({backdrop: 'static', keyboard: false}) ;
    });
*/
	
	// "use strict";
	function baseURL(url='')
	{	
		var host = window.location.host;
		var base = window.location.origin;
		var pathArray = window.location.pathname.split( '/' );
		if (host=='localhost') {
			var baseurl = base+'/'+pathArray[1];
		} else {
			var baseurl = base;
		}
		if (url=='') {
			return baseurl+'/admin/';
		} 
		if (url!='') {
			return baseurl+'/admin/'+url;
		}
	}
    $(document).ready(function() {
        $('#summernote').summernote({
		      height : '300px',
		      placeholder: 'Enter description',
		      toolbar: [
		          ['style', ['bold', 'italic', 'underline']],
		          ['fontname', ['fontname']],
		          ['fontsize', ['fontsize']],
		          ['color', ['color']],
		          ['para', ['ul', 'ol', 'paragraph']],
		      ],
		      disableDragAndDrop: true
		  });
    });

    !function(e){
    	$.noti = function(status, position, respon, title='')
		{
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-"+position,
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
			toastr[status](respon, title);   
		}

    	/*
		* Page Load
		*/
		// $.pageLoad = function(url, id, load=false, other){
		// 	$.ajax({
		// 	    url: url,
		// 	    dataType: "html",
		// 	    beforeSend: function(){
		// 	    	if (load)
		// 	        	$('#'+id).html('<div class="stack-loading-container"><div class="stack-dual-ring"></div></div>');
		// 	    },
		// 	    success: function(results){
		// 	    	$('#'+id).hide().html(results).fadeIn();
		// 	    	// $('.selectpicker').selectpicker();
		// 	    	if ($('#'+id).find('[stack-window-loads]').length) {
		// 	    		$.ajaxReload();
		// 	    	}
		// 	    }
		// 	});
		// }

		// $.fragmentLoad = function(url, id, load=false, callback){
		// 	$.ajax({
		// 	    url: url,
		// 	    dataType: "html",
		// 	    beforeSend: function(){
		//     		if (load)
		//         		$(id).html('<div class="shop-loading-container"><div class="shop-dual-ring"></div></div>');
		// 	    },
		// 	    success: function(results){
		// 	    	$(id).hide().html(results).fadeIn();
		// 	    	if ($(id).find('[stack-window-loads]').length) {
		// 	    		setTimeout(function(){
		// 		    		$.ajaxReload();
		// 		    	}, 10000);
		// 	    	}
		// 	    }
		// 	});
		// }

    	/*
		* Page Load Global
		*/
		// $.ajaxReload = function(){
		// 	$('body').find('[stack-window-loads*="page-"]').each(function(){
		// 		var pUrl = $(this).attr('stack-window-loads');
		// 		if (pUrl === undefined) {
		// 			pUrl = $(this).parent().attr('stack-window-loads');
		// 		}
		// 		var oUrl = pUrl.replace('page-', '');
		// 		var regexp = new RegExp('-', 'g');
		//     	var lUrl = oUrl.replace(regexp, '/');
		//     	var target = $(this).attr('target');
		// 		var rURL = baseURL(lUrl);
		// 		console.log(rURL);
		// 		$.fragmentLoad(rURL, target);
		// 	});
		// }

		// $(window).on('load', function(){
		// 	$.ajaxReload();
		// });

    	$('[stack-note]').summernote({
			height : '300px',
			placeholder: 'Enter description',
			toolbar: [
				['style', ['bold', 'italic', 'underline']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
			],
			disableDragAndDrop: true
		});

    	/*
		* Ajax Send Data
		*/
    	$.ajaxSubmit = function(url, formData){
			$.ajax({
			    url: url,
			    type: "POST",
			    dataType: "json",
			    data:formData,
			    beforeSend: function(){
		    		// if (load)
		        	// 	$(id).html('<div class="shop-loading-container"><div class="shop-dual-ring"></div></div>');
			    },
			    success: function(results){
			    	console.log("Response Data", results);
			    }
			});
		}

		$.changeStatus = function(url, data){
			$.ajax({
			    url: url,
			    type: "POST",
			    dataType: "json",
			    data: data,
			    beforeSend: function(){
		    		// if (load)
		        	// 	$(id).html('<div class="shop-loading-container"><div class="shop-dual-ring"></div></div>');
			    },
			    success: function(res){
			    	// console.log("Response Data", res);
			    	if(res.statusCode === 200){
			    		$.noti('success', 'top-right', res.message, res.title);
			    		setTimeout(function(){
			          		window.location.reload(); 
			          	}, 3000);
			    	}
			    	else{
			    		$.noti('error', 'top-right', res.message, res.title);
			    	}
			    	
			    }
			});
		}
    }(window.JQuery);


  </script>
@yield('script-bottom')

