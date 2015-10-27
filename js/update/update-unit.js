	var slug=$("#slug").data('value');
	//var id_=$("#ID_").data('value');
	$('#update').attr('disabled', 'true');
	focus();
 
	$("#refresh").click(function(){
		alert('dd');
	});	
	function remove(){
		$("input[type='checkbox']:checked").each( 
		function() { 
			var ID=$(this).val();
		 
				
			} 
		);		
	}	
	$('.unitcheck').change(function() {
	  if ($(this).is(':checked')) {
	  var ID=$(this).data('value');
	  $('#p_'+ID).slideDown();
	  $('#s_'+ID).slideDown();
			update();
			remove();
	  } else {
	  var ID=$(this).data('value');
	   $('#p_'+ID).slideUp();
	   $('#s_'+ID).slideUp();
			update();
			remove();
	  }
	  $("#loading-result").load("view/view-result/"+slug+"-list.php?slug="+slug);
	});			
	$('.price').change(function() {
	 	update();
	});		
	
	
 
	function focus(){
		$(".first-input").focus();
	}
	function show_result(){

		 remove();
	}
	function update(){

		var dataString=$("#form-update").serialize();
		console.log(dataString);
		$.ajax({
		type:"post",
		url:"../include/function/update/update.php?page="+slug+"-unit",
		data: dataString,
			success: function(data){
				if(data.res==1){
					// alert('hello');
					show_result();
					success();
					

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
 
	$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
 
