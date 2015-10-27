$(document).ready(function () {
	$(window).keydown(function(event) {
	  if(event.which==121) { 
		  $('#save').trigger("click")
		event.preventDefault(); 
	  }
	});	
	
  });
