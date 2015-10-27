	/*
	* Update module for update button and modal window
	* @category     Update JS
	* @author       Pablito Romero Jr. www.pablitoromerojr.ph
	*/

	var slug=$("#slug").data('value');
	var id_=$("#ID_").data('value');
	var id_2=$("#delete_id").data('value');

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
		url:"../include/function/update/update.php?page="+slug+"&ID="+id_,
		data: dataString,
			success: function(data){
				if(data.res==1){
					success();
					show_result();

				}else if(data.res==2){
					duplicate();
					$(".form-status").text(data.dup);
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
		var dataString=$("#form-update").serialize()+"&page="+slug+"&ID="+id_2;
		console.log(dataString);
		$.ajax({
		type:"post",
		url:"../include/function/update/delete.php",
		data: dataString,
			success: function(data){

				if(data.res==1){
					$('.auth').slideUp();
					success();
					show_result();
				}else if(data.res==404){
					wrong();
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
	function success(){
		$(".form-status").removeClass("alert alert-danger");
		$(".form-status").addClass("alert alert-success");
		$(".form-status").text("Success");			
	}
	function duplicate(){
		$(".form-status").removeClass("alert alert-success");
		$(".form-status").addClass("alert alert-danger");
		//$(".form-status").text("Duplicate");			
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
		if(c.length>6){
		check_user();	
		}
		
	});


	$("#delete-btn").click(function(){
		
	});	