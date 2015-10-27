 
  $(document).ready(function() {
  	$('.list').removeClass('hidden');
		$("#refresh").click(function(){
			var slug=$("#slug").data('value');
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
		});
 	
 		$(".btn_update").click(function(){
			var slug=$("#slug").data('value');
			var ID=$(this).data('value');
			$.ajax({
				data: {slug:slug, ID:ID}, 
				url: "view/view-result/edit-form/edit-"+slug+"-form.php",
				success:function(data){
					$('#load-record').html(data);
				}
			});
			 
			 
		}); 
 		$(".btn_delete").click(function(){
			var slug=$("#slug").data('value');
			var ID=$(this).data('value');
			console.log(ID);

			$.ajax({
				data: {slug:slug, ID:ID}, 
				url: "view/view-result/edit-form/auth.php",
				success:function(data){
					$('#auth-load').html(data);
				}
			});


		}); 		
 		$(".btn_unit").click(function(){
			var slug=$("#slug").data('value');
			var ID=$(this).data('value');
			//alert(ID);

			$.ajax({
				data: {slug:slug, ID:ID}, 
				url: "view/view-result/edit-form/add-unit-form.php",
				success:function(data){
					$('#load-record-2').html(data);
				}
			});




		}); 		
		$(".btn_del").click(function(){		
			var slug=$("#slug").data('value');
			var ID=$(this).data('value');
			console.log(ID);
			if(confirm("Are you sure")){
			$("#del_"+ID).hide();
			
			$.ajax({
				type:"post",
				url:"../include/function/update/delete.php?page="+slug+"&ID="+ID,
				success: function(data){}
				});
				return false;
			
			}
		});
 });