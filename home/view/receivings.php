<?php

if(!isset($_GET['ID']))
return false;

if(!current_user('pos-receivings'))
  return false;
?>
<?php 
$empid=$_SESSION['SESS_MEMBER_UID'];	
$SID=$_GET['ID'];
 
		$mode=2;
		?>
<script type='text/javascript' src="../js/jquery-ui-autocomplete.js"></script>
<script type='text/javascript' src="../js/jquery.select-to-autocomplete.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {  
     //this one line will disable the right mouse click menu  
     //$(document)[0].oncontextmenu = function() {return false;}  
}); 
	function show_form(){
		var ic=parseFloat($("#item-count").text());
		if(isNaN(ic)){
			$("#show-btn").attr("disabled", "disabled");
		}else{
			$("#show-btn").removeAttr("disabled", "disabled"); 
		}
		console.log(ic);
	}
 function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }
</script>
<?php
		//$tid=mysql_insert_id();
		//$_SESSION['T_RNO']=$tid;
		$class=new supplier();
		$query="SELECT * from osd_supplier";
		?>
<script type="text/javascript">
$(document).ready(function() {
$('#code').focus();
//ITEM LOCATOR FORM
// refresh_tno();
// refresh_tid();
// getTNO();
// showItem();




getTNO();

function new_tno(){
$("#newTNO").click(function(){
get_new_tno();
 showItem();
 getTNO();
 cancel_tno();
});	
}

function cancel_tno(){
$("#cancel_tno").click(function(){
cancel_new_tno();
 showItem();
 getTNO();
 new_tno();

});	
}








function showItem(){
	// reset();
	var tid=$("#TID").val();
	var mode="<?php  echo $mode; ?>";
	var empid="<?php echo $empid;?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid},
		url:'../include/function/pos/cart_2.php',
		success:function(data){
			$("#loading-cart").html(data);
		}
	});

}	
function refresh_tid(){
 setInterval(function() {
 getTNO_5();
    }, 5000);
}


function getTNO_5(){
	var mode="<?php  echo $mode; ?>";
	var empid="<?php echo $empid;?>";
	$.ajax({
		data:{mode:mode, empid:empid},
		url:'../include/function/pos/refresh_1.php',
		success:function(data){
			$("#loading-tno").html(data);
		}
	});	
}

function get_new_tno(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	$.ajax({
		data:{mode:mode, empid:empid, new_tno:1},
		url:'../include/function/pos/refresh_1.php',
		success:function(data){
			$("#loading-tno").html(data);
		}

	});	
	return false;
}

function cancel_new_tno(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	$.ajax({
		data:{mode:mode, empid:empid, new_tno:2},
		url:'../include/function/pos/refresh_1.php',
		success:function(data){
			$("#loading-tno").html(data);
		}
		
	});
	return false;	
}



function getTNO(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	$.ajax({
		data:{mode:mode, empid:empid,new_tno:0},
		url:'../include/function/pos/refresh_1.php',
		success:function(data){
			$("#loading-tno").html(data);
			new_tno();
			cancel_tno();
			
			
		}
	});	
	showItem();
}

function refresh_tno(){
	// $('#loading-tno').hide().html('<img align="center" src="../images/load-2.gif" width="20" style="margin-top:10px;margin-left:10px;"  >').fadeIn('fast');
	// $.ajax({
	// url:"../include/function/pos/refresh_1.php?mode=<?php  echo $mode; ?>",
	// success:function(data){
	// $('#loading-tno').hide().html(data).fadeIn();
	// showItem();
	// }
	// });
getTNO();

}

show_pos_items();

function show_pos_items(){
	$('#search_pos_items').html('<div class="img-loading"><img  src="../images/loading_animation.gif" width="54"> </div>');
	$.ajax({
		url:'../include/function/pos/search_pos_receiving.php',
		success:function(data){
			$('#search_pos_items').html(data);
			CodeBtn();
		}
	});
}


function CodeBtn(){
	$("#code").change(function(){
	var c=$( "#code option:selected" ).val();
		if(c.length>0){
		search();
		showAdd();
		}else{
		hideAdd();
		$('#loading').hide().html(' ').fadeIn();
		}
	});
}
	function search(){
		var pcode=$( "#code option:selected" ).val();
		$('#loading').hide().html('<div class="img-loading"><img  src="../images/loading_animation.gif" width="54"> </div>').fadeIn();
		var d='pcode='+pcode;
		$.ajax({
			type:"post",
			url:"../include/function/search_item.php",
			data:d,
			success:function(data){
			$('#unit').removeAttr("disabled");
			$('#loading').hide().html(data).fadeIn();
			},
			beforeSend: function(){
			}
		});	

	}
function reset(){
	$("#loading").fadeOut();
	$("#save").attr("disabled", "disabled");
	$('#sales-form')[0].reset();
	$('#save').val('Add to cart [F10]');
	$('#unit').val("Select Unit");		
	$('#unit').attr("disabled", "disabled");
	$(".ui-autocomplete-input").focus();
	$('#transaction')[0].reset();
	control.clear();
}
function loading(){
	$('#save').val('Saving...');
	$('#save').attr("disabled", "disabled");				
}		
$("#clear").click(function(){
	reset();
});	
function saveBtn(){
$("#save").click(function(){
	var tno=$("#RNO").val();
	var price=$("#price").val();
	var CID="<?php echo $SID;?>";
	console.log(price);
	var dataString=$("#sales-form").serialize();
	var unit_price=$("#unit option:selected").data('price');
	$.ajax({
	type:"post",
	url:"../include/function/pos/pos.php?mode=<?php  echo $mode; ?>",
	data: dataString + '&tno=' + tno + "&price="+price+"&CID="+CID+"&unit_price="+unit_price,
	success:function(data){
	  showItem();
	hideAdd();
	$('#loading').hide().html(' ').fadeIn();
	 

	},
	beforeSend: function(){
	  loading();
	}
	});		
});	
}
$("#show-btn").click(function(){

	item_summary();
	// $("#payment").focus();
	var tid=$("#TID").val();
	var money=$("#money").val();
	var cid=$("#c_cid").val();
	console.log(cid); 
	$("#payment").val(money);
	var m=$("#total_price").val();
	$('#payment').val(m);

	$('.amount-area').hide();

	var p=$("#total_price").val();
	if(parseFloat(money)>=parseFloat(p)){
	 $(".trans-form").slideDown('fast');
	  // $('#compose').removeAttr('disabled');
	}
	$("#cl").attr("href", "view/print-preview-suppliers.php?mode=<?php  echo $mode; ?>&TID=" + tid );
});
function clear_tf(){
	$("#transaction").slideUp();
	$("#loading-sales").show('slow');
}
$("#cl").click(function(){

	var ccid="<?php echo $_GET['ID'];?>";
	window.location='?page=receivings&ID='+ccid;
	
	$(".ui-autocomplete-input").focus();	
	 $( "#btn-close" ).trigger( "click" );
	 $("#transaction").slideDown();
	 $("#prompt-new").hide();
	 $("#show-btn").attr("disabled", "disabled");
	 $(".trans-form").slideUp();
	 $("#compose").val("Complete Sale");
	 $("#loading-sales").hide();
		var url = $(this).attr('href');
		var windowName = "RECEIPT"; // <-- using .data()
		window.open(url, windowName, "height=600,width=1268");
		return false;	



});


function item_summary(){
	// reset();
	$("#transaction_details").html('LOADING...');
	var tid=$("#TID").val();
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid},
		url:'../include/function/pos/cart_summary.php',
		success:function(data){
			$("#transaction_details").html(data);
		}
	});

}
 
 
function compose(){
	var tno=$("#RNO").val();
	var cp=$("#cp").val();
	var tid=$("#TID").val();
	var cid=$("#customer option:selected" ).val();
	var payment=$("#payment").val().replace(",", "");
	var gTotal=$("#total_price").val().replace(",", "");
	var change=$("#change").val().replace(",", "");
	var mode="<?php  echo $mode; ?>";
	var c_receipt_no=$('#receipt_no_custom').val();
	var c_receipt_no_date=$('#receipt_no_date').val();
	//var dataString='CID='+ cid + '&TID=' + tid + '&payment=' + payment + '&tno=' + tno + '&change=' + change + '&cp='+cp+"&total="+gTotal; 
	//console.log(dataString);
	if(confirm("Sure you want to process this? There is NO undo!")){
	clear_tf();
	$('#transaction')[0].reset();
	$.ajax({
	type:"post",
	url:"../include/function/pos/compose.php",
	data:{CID:cid, TID:tid, payment:payment, tno:tno, change:change, cp:cp, total:gTotal, mode:mode, c_receipt_no: c_receipt_no, c_receipt_date: c_receipt_no_date},
	success:function(data){
		 
		showItem();
		$("#loading-sales").slideUp();
		$("#prompt-new").slideDown();
	},
	beforeSend: function(){
		$('#compose').val("Processing");		
		$('#compose').attr("disabled", "disabled");		
	}
	});		
}
return false;	
}


$("#show-form").click(function(){
	// $("#payment").focus();
});
$("#payment").blur(function(){
	var c=parseFloat($(this).val());
	if(isNaN(c)){
	 c_new=""; 
	}else{
		c_new=c; 
	}
	$(this).val(c_new.toFixed(2));
	var tid=$("#TID").val();
	var amount=$(this).val(); 
	var t_cid = $('#customer').find('option:selected');
	var cid = t_cid.val(); 	
	var dataString="TID="+tid+"&amount="+amount+"&cid="+cid;
	$.ajax({
	type:"post",
	url:"../include/function/pos/inputamount.php",
	data:dataString,
	success:function(data){
	}
	});		
});
$("#customer").change(function(){
	var tid=$("#TID").val();
	var amount=$("#payment").val(); 
	var t_cid = $('#customer').find('option:selected');
	var cid = t_cid.val(); 	
	var dataString="TID="+tid+"&amount="+amount+"&cid="+cid;
	console.log(dataString);
	$.ajax({
	type:"post",
	url:"../include/function/pos/inputamount.php",
	data:dataString,
	success:function(data){
	}
	});		


});


$('.combobox ').focus();

showComplete();

function showComplete(){
var save='<a id="compose"   data-original-title="Help" data-placement="bottom"   id="show-form"   class="btn btn-sm btn-default minimize-box"><i class="glyphicon glyphicon-ok"></i> COMPLETE</a>	';
$('.complete').html(save);
composeFunction();
}


function composeFunction(){
$('#compose').click(function(){
compose();
});
}
 
function showAdd(){
var add=' <a id="save" href="#" data-toggle="collapse" class="btn btn-sm btn-default minimize-box btn-save"><i class="glyphicon glyphicon-plus-sign"></i> ADD </a>';	
$('.show_add').html(add);
saveBtn();
}

 function hideAdd(){
 
$('.show_add').html(' ');
}


});
</script>
<input type="hidden" name="cp" id="cp" value="<?php  echo $company->cp; ?>">
<div id="content">
<div class="outer">
<div class="gTotal">
<h1 class="gTotal-value">10000000</h1></div>
<div class="inner">
<div class="col-lg-12" style="min-height:470px;">
<div class="row">
<div class="box">
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
<div id="loading-tno"></div>
</header>
<div class="col-lg-4 no-right no-left">
<div class="box dark">
<header>
<div class="icons">
<i class="fa fa-edit"></i>
</div>
<h5>ITEM</h5>
                    <div class="toolbar">
                      <div class="btn-group">
                      <span class="show_add pull-left"></span>
					
                        <a id="show-btn" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#helpModal" id="show-form"   class="btn btn-sm btn-default minimize-box show_receipt">
                        <i class="glyphicon glyphicon-ok"></i> COMPLETE
                        </a>						
                        <a  id="clear"  class="btn btn-danger btn-sm">
                          <i class="fa fa-times"></i> 
                        </a>
                      </div>
                    </div>
<div class="toolbar">
<ul class="nav pull-right">
<!--<li> <a href="?page=cancel&cancel=true&TID=<?php  echo $tno; ?>"> <input type="button"   value="Cancel"   class="btn btn-success"></a> </li>-->
</ul>
</div><!-- /.toolbar -->
<!-- .toolbar -->
<div class="toolbar">
<ul class="nav">
</ul>
</div><!-- /.toolbar -->
</header>
<div id="div-1"  class="search-form accordion-body collapse in body">
<form class="form-horizontal" id="sales-form" autocomplete="off">
<div class="form-group" style="margin-bottom:0;">


<?php
$SID=$_GET['ID'];
?>
<div class="col-lg-12">

<ul class="list-group" style="margin-bottom:5px;">
  <li class="list-group-item">Supplier : <strong id="loading-tno"><?php echo supplier('sup_name', $SID); ?></strong> <a href="?page=pos-supplier" class="small">CHANGE</a></li>
  <li class="list-group-item">Address : <strong  ><?php echo supplier('sup_address1', $SID); ?></strong></li>
 

<select name="customer"    id="customer" class="hidden"  autocorrect="off" autocomplete="off">
 <option value="<?php echo $SID;?>"></option>
</select>


</ul>

 
 


</div>



 



 



<div class="col-lg-12">
<div id="search_pos_items"></div>
<!--<input type="text"  name="pcode" id="code" placeholder="Code" class="form-control text-uppercase"      >-->

</div>



</div>



<div id="loading">
</div>
</form>
</div>
<div id="div-2"  style="overflow:hidden;" class="accordion-body collapse in body">
</div>				  
</div>
</div>
<div class="col-lg-8 no-right  ">
<div class="box inverse"  style="min-height:400px;">
<div class="">
<header>
<div class="icons">
<i class="glyphicon glyphicon-shopping-cart"></i>
</div>
<h5>CART ITEMS</h5>
<!-- .toolbar -->
<div class="toolbar">
</div><!-- /.toolbar -->
</header>
<div id="div-4" class="accordion-body collapse in body">
<div id="loading-cart" >
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- /.row -->
<!--BEGIN MASKED INPUTS-->
<div class="row">
<div class="col-lg-12">
</div>
</div>
<!--END MASKED INPUTS-->			
</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->
     <!-- #helpModal -->
      <div id="helpModal" class="modal fade">

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Transaction Summary </h4>
          </div>
          <div class="modal-body col-lg-12">
<div id="div-1" class="accordion-body collapse in body grid">
<div class="form-group" id="loading-sales"  style="display:none;"  >
<div class="col-lg-12 text-center">
 Please wait...
</div>
<div class="col-lg-12 text-center">
<img align="center" src="../images/loading-long.gif"  >
</div>
</div>	
<div class="form-group" id="prompt-new" style="display:none;" >
<div class="col-lg-12 text-center">
 <label>Process was completed.</label>
</div>
<hr style="clear:none;margin:0;margin-bottom:10px;"></hr>
<div class="col-lg-12 text-center">
 <a  id="cl" href="#" ><input type="button" id="new_transaction" value="Continue" class="btn btn-success"></a>
</div>
</div>


<form class="form-horizontal" id="transaction">

<div id="transaction_details">
</div>
	
<table id="price_view" class="table table-bordered table-condensed table-hover table-striped">
 
<tr>
<td>
 <label>RECEIPT NO.</label>	
</td>
</tr>
<tr>
<td>
 
<input type="text" class="form-control all-caps" id="receipt_no_custom" name="receipt_no_custom" >
 
</td>
</tr>

 
<tr>
<td>
 <label>Date (YYYY-MM-DD) <?php echo date('Y-m-d');?></label>	
</td>
</tr>
<tr>
<td>
 
<input type="text" class="form-control all-caps" id="receipt_no_date" name="receipt_no_date" >
 
</td>
</tr>

 <tr>
 <td colspan="2">
<div class="col-lg-12 clear no-right">
<div class="col-lg-8"></div>
<div class="col-lg-4 no-right">        <input   type="button" id="compose" value="Complete Transaction" class="btn btn-success right"></div>
</div>

 </td>
 </tr>


</table>

<div class="amount-area">

<div class="form-group">
<label class="control-label col-lg-4">Amount Tendered:</label>
<div class="col-lg-5">
<div class="input-group">
<span class="input-group-addon">₱</span>
<input type="text" name="amount-tendered" id="payment" value="" autocomplete="off" suggestions="off" class="positive-integer form-control">
<input type="hidden" id="total_price">
</div>
</div>
</div>	
<hr style="clear:none"></hr>

 

<div class="form-group trans-form"  style="display:none;">
<label class="control-label col-lg-4">Change</label>
<div class="col-lg-5">
<div class="input-group">
<span class="input-group-addon">₱</span>
<input type="text" name="amount-tendered"  class="form-control" id="change" disabled>
</div>
</div>
</div>

</div>

 
</form>
</div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total.js"></script>	  
<!-- EDIT QTY -->
<script type="text/javascript" src="../js/pos/editqty.js"></script>
<!-- DELETE --> 
<link rel="stylesheet" href="assets/css/prism.css">
<link rel="stylesheet" href="assets/css/chosen.css">
<script type="text/javascript" src="../js/pos/del.js"></script>	  
<script src="../js/pos/chosen.jquery.js" type="text/javascript"></script> 
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

<script>
var $select=$('#code').selectize({});

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

var control = $select[0].selectize; 

</script>

<?php
	// } else {
	// 	include("404.php");
	// }

	?>