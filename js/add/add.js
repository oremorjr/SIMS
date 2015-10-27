		/* @FUNCTIONS */
		focus();

		// function show_result(){
		// var slug=$("#slug").data('value'); 
		// $('#loading-result').load('view/view-result/'+ slug +'-list.php?slug=' + slug);
 	
		// }

		    function show_result(){
		    var slug=jQuery("#slug").data('value'); 
		      jQuery.ajax({
		        data: {slug: slug},
		        url: 'view/view-result/'+ slug +'-list.php',
		        success: function(data){
		           jQuery('#loading-result').html(data);
		        },
		        beforeSend:function(){
		           jQuery('#loading-result').html('loading');
		        }

		      });

		    }

		
		
		function loading(){
			$('#save').attr("disabled", "disabled");
			$("#form-area").addClass("while-saving");
			$(".new-loading").fadeIn();
		}	
		function duplicate(){
			show_status();
			$("#retry").fadeIn();
			$(".form-status").removeClass("alert alert-success");
			$(".form-status").addClass("alert alert-danger");
			$(".form-status").text("Record Duplicated");
			$(".new-loading").hide();		
			$('#save').val('Failed');
			$('#clear').attr('disabled', 'disabled');
			lock_form();
		}		
		function success(){
			show_status();
			$(".form-status").removeClass("alert alert-danger");
			$(".form-status").addClass("alert alert-success");
			$(".form-status").text("Success");					
			$('#form-add')[0].reset();
			$(".new-loading").hide();	
			$('#save').val('Saved');
			$('#save').attr("disabled", "disabled");
			$("#new").fadeIn();
			lock_form();
			show_result();
			
		}
		function show_status(){
			$("#status-area").slideDown();
		}
		function reset(){
			$("#status-area").slideUp();
			$('#form-add')[0].reset();
			$('#save').val('Save');
			$('#save').removeAttr("disabled", "disabled");
			$("#form-area").removeClass("while-saving");
			$(".new-loading").hide();	
			$('.chosen-single span').text('Choose an item...');
			$('.active-result').removeClass('result-selected');		

			unlock_form();
		}
		function retry(){
			unlock_form();
			$("#form-area").slideDown();
			$("#status-area").slideUp();
			$('#save').val('Save');
			$('#save').removeAttr("disabled", "disabled");
			$("#form-area").removeClass("while-saving");
			$(".new-loading").hide();	
		}		

			function lock_form(){
				$("input").prop('disabled', true);
			}
			function unlock_form(){
				$("input").prop('disabled', false);
				focus();
			}	
			function focus(){
			$(".first-input").focus();
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
		