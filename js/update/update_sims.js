	/*
	* Update module for update button and modal window
	* @category     Update JS
	* @author       Pablito Romero Jr. www.pablitoromerojr.ph
	*/

	var slug=$("#slug").data('value');
	var id_=$("#ID_").data('value');
	var id_2=$("#del_ID").val();
	console.log(id_2);

	focus();
	
	$("#refresh").click(function(){
		 
	});	
	
	function focus(){
		$(".first-input").focus();
	}

	function show_result(){
		$("#loading-result").load("view/view-result/"+slug+"-list.php?slug="+slug);
	}
	function update(){
		loading();
		var dataString=$("#form-update").serialize();
		var ID=$('#ID_').data('value')
		var n1=$('.n1_edited').val()
		var n2=$('.n2_edited').val()
		var n3=$('.n3_edited').val()
		var n4=$('.n4_edited').val()
		$.ajax({
		type:"post",
		url:"../include/function/update/update_class.php?page="+slug+"&ID="+id_,
		data: dataString,
			success: function(data){
	                    	$('.edit-area').html(data);
	                    	var result=$('.result').data('value');
	                    	if(result==1){
	                    		success();
	                    		$('.n1-'+ID).html(n1);
	                    		$('.n2-'+ID).html(n2);
	                    		$('.n3-'+ID).html(n3);
	                    		$('.n4-'+ID).html(n4);
	                    		// show_result();
	                    		  $('#update').removeAttr("disabled");
	                    	}else if(result==2){
				duplicate();
	                    	}

			}
			// dataType: 'json'
		});
		return false;
	 
	}  
	function check_user(){
		//page="+slug+"&ID="+id_
		// loading();
		var id_3=$("#del_ID").val();
		var pwd=$('#pwd').val();
		var empid=$('#empid').val();
		// var dataString=$("#form-update").serialize()+"&page="+slug+"&ID="+id_3;
		// console.log(dataString);
		$.ajax({
		data: {pwd:pwd, page: slug, ID:id_3, empid:empid }, 
		url:"../include/function/update/delete_class.php",
		
			success: function(data){
			$('.edit-area').html(data);
	                    	var result=$('.result').data('value');

				if(result==1){
					success();
					$('.auth').slideUp();
					$('#list-'+id_3).fadeOut();
					$('.list-'+id_3).fadeOut();
					
					//show_result();
				}else if(result==404){
					wrong();
				}
				
			}
			// dataType: 'json'
		});
		return false;
	 
	} 	
        
        function loading(){
              $('.result-area').slideDown('fast');
              $('#update').attr("disabled", "disabled");
            $('.edit-area').html('<div class="loading"><i class="glyphicon glyphicon-refresh"></i> Loading...</div>');
        }   
        function success(){
            $('.result-area').slideDown('fast'); 
            $('.edit-area').html('<div class="success"><i class="glyphicon glyphicon-ok"></i> Process Completed. </div>');
            close_area();

        }
        function duplicate(){
              $('.edit-area').slideDown('fast');
            $('.edit-area').html('<div class="duplicate-data"><i class="glyphicon glyphicon-warning-sign"></i> Record already exists.</div>');
        }

        function wrong(){
              $('.edit-area').slideDown('fast');
            $('.edit-area').html('<div class="duplicate-data"><i class="glyphicon glyphicon-warning-sign"></i> Try again</div>');
        }

        function close_area(){
         $('.edit-area').delay(10000).slideUp('fast');
        }

 
	function error(){
		$(".form-status").removeClass("alert alert-success");
		$(".form-status").addClass("alert alert-danger");
		$(".form-status").text("Error");			
	}	
	function hide_status(){
		$(".form-status").slideUp();		
	}  
	$("#update").click(function(){
		update();
	});

	$("#pwd").keyup(function(){
		var c=$(this).val();
		 
		if(c.length>2){
		check_user();	
		}
		
	});


	$("#delete-btn").click(function(){
		
	});	