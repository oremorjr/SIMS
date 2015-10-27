$(document).ready(function()
{


$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
 
$("#disc_"+ID).hide();
$("#last_"+ID).hide();
$("#last_input_"+ID).show();
 
$("#disc_input_"+ID).show();
 
 alert("hello");
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_"+ID).data('label');
var last_temp=$("#last_input_"+ID).val();
var disc=$("#disc_input_"+ID).val();
var stock=$("#stock_"+ID).text();
var tno=$("#temp_no").data('tno');
var sub_total=$("#grandTotal2").val();
var raw=$("#price_"+ID).val();
var sell_price=$("#multTotal_"+ID).data('value');
var total_p=$(".total-amount").attr('id');
console.log('HELLO'+total_p);
 


 
if(parseFloat(stock)<parseFloat(last_temp)){
	
	$("#stock").show(500, function(){
	$(this).slideDown();
 
	});
	$("#last_input_"+ID).val(stock);
	var last=$("#last_input_"+ID).val();
}else{
	$("#stock").hide(500, function(){
	$(this).slideUp();
 
	});
	$("#last_input_"+ID).val(last_temp);
	var last=$("#last_input_"+ID).val();
}
 

var dataString = 'id='+ ID + '&lastname='+last + '&tno='+tno + '&sub_total='+sub_total + '&disc=' + disc + "&price="+total_p+"&raw="+raw;
$("#first_"+ID).html('<img src="../images/load.gif" />');


if(last.length>0)
{
$.ajax({
type: "POST",
url: "../include/function/pos/edit_qty.php",
data: dataString,
cache: false,
success: function(html)
{ 
$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
$("#disc_"+ID).html(disc);
$(".editbox").hide();
$(".text").show();
$("#preview_error").html('<pre>'+data+'</pre>');

}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});