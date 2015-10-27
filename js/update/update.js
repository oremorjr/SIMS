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
		alert('dd');
	});	
	
	function focus(){
		$(".first-input").focus();
	}
	function show_result(){
		$("#loading-result").load("view/view-result/"+slug+"-list.php?slug="+slug);
	}
	function update(){
		var dataString=$("#form-update").serialize();
		$.ajax({
		type:"post",
		url:"../include/function/update/update_class.php?page="+slug+"&ID="+id_,
		data: dataString,
			success: function(data){
				if(data.res==1){
					success();
					show_result();
				}else if(data.res==2){
					duplicate();
				}else if(data.res==3){
					error();
				}
			},
			beforeSend: function() {
 
			},
			dataType: 'json'
		});
		return false;
	 
	}  
	function check_user(){
		//page="+slug+"&ID="+id_
		var id_3=$("#del_ID").val();
		var dataString=$("#form-update").serialize()+"&page="+slug+"&ID="+id_3;
		// console.log(dataString);
		$.ajax({
		type:"post",
		url:"../include/function/update/delete_class.php",
		data: dataString,
			success: function(data){

	                    	$('.delete-area').html(data);
	                    	var result=$('.result').data('value');
	                    	if(result==1){
	                    		$('.auth').slideUp();
					success();
					show_result();
	                    	}



				 
				
			}
			// dataType: 'json'
		});
		return false;
	 
	} 	
	function success(){
		$(".form-status").removeClass("alert alert-danger");
		$(".form-status").addClass("alert alert-success");
		$(".form-status").text("Success");			
	}
	function duplicate(){
		$(".form-status").removeClass("alert alert-success");
		$(".form-status").addClass("alert alert-danger");
		$(".form-status").text("Duplicate");			
	}
	function wrong(){
		$(".form-status").removeClass("alert alert-success");
		$(".form-status").addClass("alert alert-danger");
		$(".form-status").text("Please Try Again!");			
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

		if(c.length>4){
		$('.delete-area').html('please wait...');
		check_user();	
		}
		
	});


	$("#delete-btn").click(function(){
		
	});	