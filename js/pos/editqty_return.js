$(document).ready(function()
{




$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
 
// $("#disc_"+ID).hide();
// $("#disc_l_"+ID).hide();
$("#last_"+ID).hide();
// $("#price_"+ID).hide();
$("#last_input_"+ID).show();
// $("#disc_input_"+ID).show();
// $("#disc_input_l_"+ID).show();
// $("#price_input_"+ID).show();

}).change(function()
{



var ID=$(this).attr('id');
var first=$("#first_"+ID).data('label');
var last_temp=$("#last_input_"+ID).val();
var disc=$("#disc_input_"+ID).val();
var disc_l=$("#disc_input_l_"+ID).val();
var td_total=$("#td_total_"+ID).val();
var reason=$("#reason_id_"+ID).val();
 
 if(disc_l==""){
disc_l='0.00';
$("#disc_input_l_"+ID).val('0.00');
 }

 if(disc==""){
disc='0.00';
$("#disc_input_"+ID).val('0.00');
 }

var price=$("#price_input_"+ID).val();

var stock=$("#stock_"+ID).text();
var tno=$("#temp_no").data('tno');
var sub_total=$("#grandTotal2").val();
var mode_cart=$("#mode_cart").val();
 

 
 

 
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
 

// var dataString = 'id='+ ID + '&lastname='+last + '&tno='+tno + '&sub_total='+sub_total + '&disc=' + disc + '&price=' + price+'&disc_l='+disc_l+'&td_total='+td_total;
$("#first_"+ID).html('<img src="../images/load.gif" />');


if(last.length>0)
{
$.ajax({
type: "POST",
url: "../include/function/pos/edit_qty.php",
data: {id:ID, lastname:last, tno:tno, sub_total:sub_total, disc:disc, price:price, disc_l:disc_l, td_total:td_total, mode_cart:mode_cart, reason:reason},
cache: false,
success: function(html)
{ 


$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
$("#disc_"+ID).html(disc);
$("#disc_l_"+ID).html(disc_l);
$("#price_"+ID).html(price);

$(".editbox").hide();
$(".text").show();
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