$(document).ready(function(){
		//start event funtion for save button
		$("#save").click(function(){
			$("#login_form").trigger('submit');		
		});//end the event function for login button
		
		
		//start set the validation for your form
		$("#login_form").validate({
			onkeyup: true,
			submitHandler: login_submit,
			
				rules:{
					uname:{
						required:true,
						minlength:6,
						maxlength:15
					},
					pwd:{
						required:true
					}
				},
				
				messages:{
					uname:{
						required:"<div class='err'>Username please</div>",
						minlength: jQuery.format("<div class='err'>username must be at least {0} characters in length.</div>"),
						maxlength: jQuery.format("<div class='err'>username must be at least {0} characters in length.</div>"),
					},
					pwd:{
						required:"<div class='err'>Password please</div>"
					}
				}
		
		
		}); // End set the validation for your form
		
		//start function for login trigger
        function login_submit(){
                $.ajax({
                    type: "POST",
                    url: "include/function/checklogin.php",
                    data: $("#login_form").serialize(),
                    success: function(data){
						if (data.res == 1){
							//$('#login_form').fadeOut('slow', function() { 
							//});
							$('#add').html('<div class="rems"><div>Welcome '+ data.fname +'</div>');
							window.location="home/welcome?page=index";
						}else if(data.res == 2){
							$('#add').html('<div class="rems"><div>NO USER FOUND</div>');
							$('#save').val('Login');
						}else if(data.res == 3){	
							$('#add').html('<div class="rems"><div>MULTIPLE LOGIN '+ data.err +'</div>');
							$('#save').val('Try again');
							//window.location = "welcome";
						}else if(data.res == 6){	
							$('#add').html('<div class="rems">User Deactivated</div>');
							$('#save').val('Try again');
							//window.location = "welcome";
						}else{
                            alert("Message not sent, please try again. Error data: ");
						}
					},
					beforeSend: function() {
						
						$('#add').html('<div class="rems"><div><img src="images/Loading.gif" width="35"></div><div>Please wait</div></div>');
						$('#save').val('Sending...');
						//$('#save').attr("disabled", "disabled");
					},
			
					dataType: 'json'
                });
        }//End funtion for login trigger
});