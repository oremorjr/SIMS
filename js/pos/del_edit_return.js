 
$(function() {


$(".delbutton").click(function(){
//total records
var ic=$("#item-count").text();


//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");
var PUID = element.data("log");
var d=$("#price_"+del_id).text().replace(",", "");
 

function del_item(){

var gt=$("#grandTotal").text().replace(",", "");
 
var ti=$("#total_input_"+del_id).val().replace(",", "");

 
var new_t= parseFloat(gt) - parseFloat(ti);
	if(isNaN(new_t)){
		new_t = 0;		
	}
	 $("#grandTotal").text(commaSeparateNumber(new_t.toFixed(2)));
	$(".gTotal-value").text(commaSeparateNumber(new_t.toFixed(2)));
	 $("#price_"+del_id).text(0)
ic_new=ic-1;
$("#item-count").text(ic_new);	 
$("#current-count").text(ic_new);
if(ic_new==1){
	$("#label-qty").text('Total item');
}

if(ic_new==0){
	$("#compose").attr("disabled", "disabled");
	$("#empty-cart").slideDown();
	$("#show-btn").attr("disabled", "disabled");
	$(".ui-autocomplete-input").focus();
}else{
	$("#show-btn").removeAttr("disabled", "disabled");
	$(".ui-autocomplete-input").focus();
}

}
console.log(ic);

 
	 
	 

//Built a url to send
// var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "../include/function/pos/del.php",
   data: {id:del_id, PUID:PUID, del:1},
   success: function(){
	$("#clear").trigger('click');
   }
 });
	del_item();
   $(this).closest('tr')
        .children('td')
        .animate({ padding: 0 })
        .wrapInner('<div />')
        .children()
        .slideUp(function() { $(this).closest('tr').remove(); });
		
    return false;
		
		

		
		 
		
	

 }

return false;

});

});