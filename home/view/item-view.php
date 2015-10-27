<?php $slug='item';


?>

<span id="slug" data-value="<?php echo $slug;?>"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
<script type='text/javascript' src="../js/jquery-ui-autocomplete.js"></script>
<script type='text/javascript' src="../js/jquery.select-to-autocomplete.min.js"></script>

 
<script type="text/javascript">




 
		$(document).ready(function(){




        
        function loading(){
              $('.result-area').slideDown('fast');
              $('#save').attr("disabled", "disabled");
            $('.result-area').html('<div class="loading"><i class="glyphicon glyphicon-refresh"></i> Loading...</div>');
        }   
        function success(){
            $('.result-area').slideDown('fast');
            $('#form-add')[0].reset();
            $('.result-area').html('<div class="success"><i class="glyphicon glyphicon-ok"></i> Process Completed. </div>');
            close_area();

        }
        function duplicate(){
              $('.result-area').slideDown('fast');
            $('.result-area').html('<div class="duplicate-data"><i class="glyphicon glyphicon-warning-sign"></i> Record already exists.</div>');
              $('#save').removeAttr("disabled");

            // show_result();
        }
        function close_area(){
         $('.result-area').delay(10000).slideUp('fast');
        }
	function focus(){
	$(".first-input").focus();
	}
















		/* @FUNCTIONS */
		focus();

		// function show_result(){
		// var slug=$("#slug").data('value'); 
		// $('#loading-result').load('view/view-result/'+ slug +'-list.php?slug=' + slug);
 	
		// }

		    function show_result(){
		     $('#save').attr("disabled", "disabled");
		    jQuery('#loading-result').html('loading');
		    var slug=jQuery("#slug").data('value'); 
		      jQuery.ajax({
		        data: {slug: slug},
		        url: 'view/view-result/'+ slug +'-list.php',
		        success: function(data){
		           jQuery('#loading-result').html(data);
		             $('#save').removeAttr("disabled");
		        }
		        
		      });

		    }

		


		/* /FUNCTIONS */
		
		/* @EVENTS */		
		$("#new").click(function(){
			$(".first-input").focus();
			reset();
			$(this).fadeOut('fast');
		});
		$("#clear").click(function(){
			reset();
		});	
		$("#retry").click(function(){
			retry();
			$(this).fadeOut('fast');
			$('#clear').removeAttr("disabled", "disabled");
		});		
		$("#save").click(function(){
			$("#form-add").trigger('submit');
		});	 
		/* /FUNCTIONS */
			

			$('.list').addClass('hidden');
			show_result();

			$.validator.setDefaults({
			submitHandler: function() {
			 add();
			}
			});

			$("#form-add").validate({ 
			
				rules:{
					f1:{required:true},
					f2:{required:true},
					// f3:{required:true},
					f4:{required:true,email:false},
					f5:{required:false},
					f6:{required:false},
					f7:{required:false},
					f8:{required:false},
					f9:{required:false},
					f10:{required:false},
					f11:{required:false},
					f12:{required:false},
					f13:{required:false},

				}

			});
        function add(){
         	loading();
                $.ajax({
                    type: "POST",
                    url: "../include/function/add_class.php?page=<?php echo $slug;?>",
                    data: $("#form-add").serialize(),
                    success: function(data){
                    	$('.result-area').html(data);
                    	var result=$('.result').data('value');
                    	if(result==1){
                    		show_result();
                    		success();

                    	}else if(result==2){
			duplicate(); 
                    	}


 
					} 

					// dataType: 'json'
                });
				 // return false;
        }//End funtion for login trigger







		});
	 

</script>

<div id="content">

<div class="outer">
<div class="inner">
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5><?php echo $slug;?>'s Dashboard</h5></div>
				</header>
	

				<!-- start results-->
				<div class="col-lg-12">
					<div class="box inverse"  style="min-height:400px;">
						<header>
							<div class="icons">
								<i class="glyphicon glyphicon-shopping-cart"></i>
							</div>
							<h5>Results</h5>
							<!-- .toolbar -->
							<div class="toolbar">
							</div><!-- /.toolbar -->
						</header>
						<div id="div-4" class="accordion-body collapse in body">
							<div id="loading-result" >
							</div>
						</div>
					</div>
				</div>
				<!-- end Results-->

			</div><!-- /.box -->
		</div><!-- /.row -->
	</div><!-- /.col -->


</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->



     <!-- #helpModal -->
    <div id="edit-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit </h4>
          </div>
          <div class="modal-body">
			<div id="div-1" class="accordion-body collapse in body">


			<div id="load-record"></div>


			</div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->


     <!-- #addUnit -->
    <div id="unit-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Unit </h4>
          </div>
          <div class="modal-body">
			<div id="div-1" class="accordion-body collapse in body">


			<div id="load-record-2"></div>


			</div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->

         <!-- #AUTH -->
    <div id="del-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Security </h4>
          </div>
          <div class="modal-body">
          	<div id="div-1" class="accordion-body collapse in body">
          		<div id="auth-load"></div>
          	</div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->



    <script src="assets/lib/datatables/jquery.dataTables.js"></script>
 