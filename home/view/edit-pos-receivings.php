<?php
 
$empid=$_SESSION['SESS_MEMBER_UID'];	

 if(!isset($_REQUEST['TID']))
 	return false;
 

$CID=$_REQUEST['ID'];
$TID=$_REQUEST['TID'];
$current_tid=$TID;
  $TRID=$_REQUEST['TID'];
$lock=transaction_lock_status($TID);
 $mode=2;

		?>
<script type='text/javascript' src="../js/jquery-ui-autocomplete.js"></script>
<script type='text/javascript' src="../js/jquery.select-to-autocomplete.min.js"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {  
var TID="<?php echo $TID?>";
 

     //this one line will disable the right mouse click menu  
     //$(document)[0].oncontextmenu = function() {return false;}  
}); 
	function show_form(){
		var ic=parseFloat($("#item-count").text());
		if(isNaN(ic)){
			// $("#show-btn").attr("disabled", "disabled");
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
refresh_tno();
refresh_tid();
getTNO();

function showItem(){
	// reset();
	$("#loading-cart").html('LOADING...');
	var tid="<?php echo $TRID;?>";
	console.log(tid);
	var mode="<?php echo $mode;?>";
	var empid="<?php get_employeee_id();?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid},
		url:'../include/function/pos/cart_edit.php',
		success:function(data){
			$("#loading-cart").html(data);
		}
	});

}




 


function item_summary(){
	// reset();
	$("#transaction_details").html('LOADING...');
	var tid="<?php echo $TRID;?>";
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid},
		url:'../include/function/pos/cart_summary_edit.php',
		success:function(data){
			$("#transaction_details").html(data);
		}
	});

}


function refresh_tid(){
 setInterval(function() {
 getTNO_5();
    }, 2000);
}


function getTNO_5(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	var TRID="<?php echo $TRID;?>";
	$.ajax({
		data:{mode:mode, empid:empid, TRID:TRID},
		url:'../include/function/pos/refresh_edit.php',
		success:function(data){
			$("#loading-tno").html(data);
		}
	});	
}
function getTNO(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	var TRID="<?php echo $TRID;?>";
	$.ajax({
		data:{mode:mode, empid:empid, TRID:TRID},
		url:'../include/function/pos/refresh_edit.php',
		success:function(data){
			$("#loading-tno").html(data);
			
			
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
		url:'../include/function/pos/search_pos.php',
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
		var mode="<?php echo $mode;?>";
		$('#loading').hide().html('<div class="img-loading"><img  src="../images/loading_animation.gif" width="54"> </div>').fadeIn();
		var d='pcode='+pcode+'&mode='+mode;
		$.ajax({
			type:"post",
			url:"../include/function/search_edit.php",
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
	var unit_price=$("#unit option:selected").data('price');
	console.log(price);
	var dataString=$("#sales-form").serialize();
	$.ajax({
	type:"post",
	url:"../include/function/pos/pos.php?mode=<?php  echo $mode; ?>",
	data: dataString + '&tno=' + tno + "&price="+price+"&EDIT=1&unit_price="+unit_price,
	success:function(data){
	$("#preview-error").html('<pre>'+data+'</pre>');
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
	var tid="<?php echo $TRID;?>";
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
	$("#new_transaction").attr("href", "view/print-preview-suppliers.php?mode=<?php  echo $mode; ?>&TID=" + tid );
	$("#new_transaction").attr("data-view", "view/print-preview-suppliers.php?mode=<?php  echo $mode; ?>&TID=" + tid );
	$("#new_transaction").attr("data-link", "view/print-preview-home.php?mode=<?php  echo $mode; ?>&TID=" + tid );
});
function clear_tf(){
	$("#transaction").slideUp();
	$("#loading-sales").show('slow');
}
$("#new_transaction").click(function(){
	$('#finalize').removeAttr("disabled");
	$(".ui-autocomplete-input").focus();	
	 $( "#btn-close" ).trigger( "click" );
	 $("#transaction").slideDown();
	 $("#prompt-new").hide();
	 // $("#show-btn").attr("disabled", "disabled");
	 $(".trans-form").slideUp();
	 $("#finalize").val("Complete Transaction");
	 $("#loading-sales").hide();
		var url = $(this).data('link');
		var url2= $(this).data('view');
		var windowName = "RECEIPT"; // <-- using .data()
		// window.open(url, windowName, "height=600,width=1268");
		// return false;	
	// a1(url, windowName);
	a2(url2, windowName);
	var ccid="<?php echo $_GET['ID'];?>";
	var TID="<?php echo $_GET['TID'];?>";
	var t_cid = $('#customer').val();

	window.location='?page=edit-pos-receivings&ID='+t_cid+'&TID='+TID;

 
});

 function a1(url, windowName) { 
popupWindow1 = window.open(url, windowName, 'height=600,width=1260,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no');
}

function a2(url, windowName){
 popupWindow2 = window.open(url,  windowName, 'height=600,width=1260,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no');

}
 
function compose(){



	var tno=$("#RNO").val();
	var cp=$("#cp").val();
	var tid="<?php echo $TRID;?>";
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
	url:"../include/function/pos/compose_edit.php",
	data:{CID:cid, TID:tid, payment:payment, tno:tno, change:change, cp:cp, total:gTotal, mode:mode,  c_receipt_no: c_receipt_no, c_receipt_date: c_receipt_no_date},
	success:function(data){
		refresh_tno();
		showItem();
		$("#loading-sales").slideUp();
		$("#prompt-new").slideDown();
		$("#preview-error").html('<pre>'+data+'</pre>');
	},
	beforeSend: function(){
	$('#finalize').val("Processing");		
	$('#finalize').attr("disabled", "disabled");				
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
	var tid="<?php echo $TRID;?>";
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
	var tid="<?php echo $TRID;?>";
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
// var save='<a id="compose"   data-original-title="Help" data-placement="bottom"   id="show-form"   class="btn btn-sm btn-default minimize-box"><i class="glyphicon glyphicon-ok"></i> COMPLETE</a>	';
// $('.complete').html(save);
composeFunction();
}


function composeFunction(){
$('#finalize').click(function(){
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


function update_transaction_details(page, transactionID, ID){
$('.pos-details').html('loading');
$.ajax({
data:{page:page, TID: transactionID, ID:ID  },
url:"../include/function/update/update_class.php",
success:function(data){
$('.pos-details').html(data);
}
});
}

$('#driver').change(function(){
var selected_value=$(this).val();
var slug='driver-pos';
var tid="<?php echo $TRID;?>";

update_transaction_details(slug,tid,selected_value);

});

$('#agent').change(function(){
var selected_value=$(this).val();
var slug='agent-pos';
var tid="<?php echo $TRID;?>";

update_transaction_details(slug,tid,selected_value);

});

$('#truck').change(function(){
var selected_value=$(this).val();
var slug='truck-pos';
var tid="<?php echo $TRID;?>";

update_transaction_details(slug,tid,selected_value);

});

$('#checker').change(function(){
var selected_value=$(this).val();
var slug='checker-pos';
var tid="<?php echo $TRID;?>";

update_transaction_details(slug,tid,selected_value);

});




var slug="lock-receipt";
var slug_unlock="unlock-receipt";
var CID="<?php echo $CID;?>";
var TID="<?php echo $TID;?>";

$("#finalize_receipt").click(function(){

  $.ajax({
    data:{page:slug, CID:CID, TID:TID},
    url:'../home/view/view-result/edit-form/auth_payment.php',
    success:function(data){
      $("#auth").html(data);
      auth_event_lock();
    }

  });


});


$("#unlock_receipt").click(function(){

  $.ajax({
    data:{page:slug_unlock, CID:CID, TID:TID},
    url:'../home/view/view-result/edit-form/auth_payment.php',
    success:function(data){
      $("#auth").html(data);
      auth_event_unlock();
    }

  });


});

function auth_event_lock(){
$("#pwd").keyup(function(){

var empid="<?php echo get_employeee_id();?>"; 
var pwd=$(this).val();

auth(slug,empid, pwd, TID );

});


}

function auth_event_unlock(){
$("#pwd").keyup(function(){

var empid="<?php echo get_employeee_id();?>"; 
var pwd=$(this).val();

auth(slug_unlock,empid, pwd, TID );

});


}

function auth(slug,empid, pwd, ID){
 
  $.ajax({
    data: {TID:TID, page: slug, empid:empid, pwd:pwd},
    url:'../include/function/add_class.php',
    success:function(data){
  $(".edit-area").html(data); 
    var ar=$(".result-ar").attr('id');
  if(ar==1){
  window.location="?page=edit-pos-receivings&ID="+CID+"&TID="+TID;
  }

    }


  });

}







 



 

});
</script>

<block id="preview-error" class="hidden"></block>

<input type="hidden" name="cp" id="cp" value="<?php  echo $company->cp; ?>">
<div id="content">
<div class="outer">
<?php  if($lock==0):?>
<div class="gTotal">
<h1 class="total_cart">0.00</h1>
</div>
<?php endif;?>


<div class="inner">
<?php  if($lock==0):?>
<div class="col-lg-12" style="min-height:470px;">
<div class="row">
<div class="box">
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
<div id="loading-tno"></div>
</header>



<div class="col-lg-4 no-right  ">






<div class="box dark">
<header>
<div class="icons">
<i class="fa fa-edit"></i>
</div>
<h5>ITEM</h5>
                    <div class="toolbar">
                      <div class="btn-group">
                      <span class="show_add pull-left"></span>
					
                        <a id="show-btn" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#helpModal" id="show-form"   class="btn btn-sm btn-default minimize-box">
                        <i class="glyphicon glyphicon-edit"></i> UPDATE
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


<div class="col-lg-12">

<ul class="list-group" style="margin-bottom:5px;">
  <li class="list-group-item">Customer Name : <strong id="loading-tno"><?php echo supplier('sup_name', $CID); ?></strong></li>
  <li class="list-group-item">Address : <strong  ><?php echo supplier('sup_address1', $CID); ?></strong></li>
 

<select name="customer"    id="customer" class=""  autocorrect="off" autocomplete="off">
 <option value="<?php echo $CID;?>"><?php echo supplier('sup_name', $CID);?></option>
<?php
$customers=osd_query("osd_supplier", $where="", $group="");
foreach($customers as $customer){
echo '<option value='.$customer['SID'].'>'.$customer['sup_name'].'</option>';
}
?>


</select>


</ul>

 
 


</div>




 

<div class="col-lg-12">

<div id="search_pos_items">
</div>

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

<!-- end 4 -->


<div class="col-lg-8 no-right  ">
<div class="box inverse"  >
<div class="">
<header>
<div class="icons">
<i class="glyphicon glyphicon-shopping-cart"></i>
</div>  
<?php
if(current_user('control-receipt')):
?>
<button class="btn btn-success left-cart" id="finalize_receipt"  data-toggle="modal" data-target="#AUTH"   >Lock Receipt</button> 
<?php endif;?>
 <button class="btn btn-danger left-cart">Edit Mode</button> 
<h5>CART ITEMS</h5>
<!-- .toolbar -->
<div class="toolbar">
</div><!-- /.toolbar -->
</header>
<div id="div-4" class="accordion-body collapse in body">

<div id="loading-cart" >
</div>
<!-- loading cart -->

 


</div>
</div>
</div>
<!-- box inverse -->

 


</div>
<!-- end 8 -->








 







</div>
</div>
</div><!-- /.row -->
<!--BEGIN MASKED INPUTS-->
<div class="row">
<div class="col-lg-12">
</div>
</div>
<!--END MASKED INPUTS-->		


<?php 

else:

?>
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5> Sales [Edit Receipt]</h5></div>
				</header>
 
						<div id="div-4" class="accordion-body collapse in body">
						<?php 
						if(current_user('control-receipt')):
						?>
						<div class="alert alert-info mb-0" role="alert">
						<div>[*Admin View]</div>
						<div class="grid"><i class="glyphicon glyphicon-lock"></i> Receipt is currently locked. </div>
						<div class="grid"> <button id="unlock_receipt" class="btn btn-primary"  data-toggle="modal" data-target="#AUTH">Unlock Receipt</button></div>
						</div>
						<?php
						else:
						?>
						<div class="alert alert-warning mb-0" role="alert">Receipt is no longer available to update. Kindly ask for you Administrator permission</div>

						<?php
						endif;
						?>
						</div> 
				 
				<!-- end Results-->

			</div><!-- /.box -->
		</div><!-- /.row -->
	</div><!-- /.col -->

<?php

endif;?>



 


</div>
<!-- end .inner -->










</div>
<!-- end .outer -->
</div>
<!-- end #content -->
     <!-- #helpModal -->
      <div id="helpModal" class="modal fade">

      <div class="modal-dialog" style="width:750px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Transaction Summary </h4>
          </div>
          <div class="modal-body">
<div id="div-1" class="accordion-body collapse in body">
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
 
 	<input type="button" id="new_transaction" data-link='#' data-view='#'  value="Print Preview Receipt" class="btn btn-success">

</div>
</div>


<form class="form-horizontal" id="transaction">
 
<div class="amount-area">

<div class="form-group hidden">
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

                      <div class="form-actions grid  ">
					 

<div class="col-lg-12 grid"><div id="transaction_details"></div></div>
<div class="col-lg-12 grid">
<div class="pos-details"></div>



<table id="price_view" class="table table-bordered table-condensed table-hover table-striped">
 
<tr>
<td>
 <label>RECEIPT NO.</label>	
</td>
</tr>
<tr>
<td>
 
<input type="text" class="form-control all-caps" id="receipt_no_custom" name="receipt_no_custom" value="<?php echo transaction('t_rno', $TID);?>" >
 
</td>
</tr>

 
<tr>
<td>
 <label>Date (MM/DD/YYYY) <?php echo date('m/d/Y');?></label>	
</td>
</tr>
<tr>
<td>
 
<input type="text" class="form-control all-caps" id="receipt_no_date" name="receipt_no_date" value="<?php echo transaction('t_rno_date', $TID);?>" >
 
</td>
</tr>

 <tr>
 <td colspan="2">
<div class="col-lg-12 clear no-right">
<div class="col-lg-8"></div>
<div class="col-lg-4 no-right"><input type="button" id="finalize" value="Update Receipt" class="btn btn-success right" ></div>
</div>

 </td>
 </tr>


</table>















 <table class=" table table-bordered table-condensed table-hover table-striped hidden">
 <thead>
 <th colspan="2"><h4>Delivery Details</h4></th>
 </thead>
 <tr>
 	<td width="20%"><label class="c1">Driver</label></td>
 	<td>
 	<select id="driver">
 	<?php
 	$dID=pabs_query('t_driver', 'osd_transaction','TID',$current_tid);
 	$d_fname=pabs_query('d_firstname', 'osd_driver','d_driverID',$dID);
 	$d_lname=pabs_query('d_lastname', 'osd_driver','d_driverID',$dID);
 	echo '<option value="'.$dID.'">'.$d_fname.' '.$d_lname.'</option>'; 


 	$drivers=osd_query('osd_driver',$where="", $group="");
 	foreach($drivers as $driver){
 	$d_id=$driver['d_driverID'];
 	$dname=$driver['d_firstname'].' '.$driver['d_lastname'];
 	echo '<option value='.$d_id.'>'.$dname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
  <tr>
 	<td><label class="c1">Agent  </label></td>
 	<td>
 	<select   id="agent">
 	<?php
 	$c_agent=pabs_query('t_agent', 'osd_transaction','TID',$current_tid);
 	$agent_fname=pabs_query('a_firstname', 'osd_agent','a_agentID',$c_agent);
 	$agent_lname=pabs_query('a_lastname', 'osd_agent','a_agentID',$c_agent);
 	echo '<option value="'.$c_agent.'">'.$agent_fname.' '.$agent_lname.'</option>'; 

 	$agents=osd_query('osd_agent',$where="", $group="");
 	foreach($agents as $agent){
 	$a_id=$agent['a_agentID'];
 	$aname=$agent['a_firstname'].' '.$agent['a_lastname'];
 	echo '<option value='.$a_id.'>'.$aname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
   <tr>
 	<td><label class="c1">Truck</label></td>
 	<td>
 	<select  id="truck">
 	<?php


 	$t_ID=pabs_query('t_truck', 'osd_transaction','TID',$current_tid);
 	$t_name=pabs_query('t_truckNo', 'osd_truck','t_truckID',$t_ID); 
 	echo '<option value="'.$t_ID.'">'.$t_name.'</option>';  


 	$trucks=osd_query('osd_truck',$where="", $group="");
 	foreach($trucks as $truck){
 	$t_id=$truck['t_truckID'];
 	$tname=$truck['t_truckNo'];
 	echo '<option value='.$t_id.'>'.$tname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
    <tr>
 	<td><label class="c1">Checker</label></td>
 	<td>
 	<select   id="checker">
 	<?php


 	$c_ID=pabs_query('t_checker', 'osd_transaction','TID',$current_tid);
 	$c_fname=pabs_query('c_firstname', 'osd_checker','c_checkerID',$c_ID);
 	$c_lname=pabs_query('c_lastname', 'osd_checker','c_checkerID',$c_ID);
 	echo '<option value="'.$c_ID.'">'.$c_fname.' '.$c_lname.'</option>'; 


 	$checkers=osd_query('osd_checker',$where="", $group="");
 	foreach($checkers as $checker){
 	$c_id=$checker['c_checkerID'];
 	$cname=$checker['c_firstname'].' '.$checker['c_lastname'];
 	echo '<option value='.$c_id.'>'.$cname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
 <tr>
 <td colspan="2">
<div class="col-lg-12 clear no-right">
<div class="col-lg-8"></div>
<div class="col-lg-4 no-right"><input type="button" id="finalize" value="Update Receipt" class="btn btn-success right" ></div>
</div>

 </td>
 </tr>
 </table>



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
  
<!-- EDIT QTY --> 
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
$('#driver').selectize({});
$('#agent').selectize({});
$('#truck').selectize({});
$('#checker').selectize({});
$('#customer').selectize({});
var $select=$('#code').selectize({});

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

var control = $select[0].selectize; 

</script>


<script type="text/javascript">

function a1(url) { 
popupWindow1 = window.open(url, 'popUpWindow1', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
 popupWindow2 = window.open(url, 'popUpWindow2', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
}

            function a2(url) { 
popupWindow2 = window.open(
                    url, 'popUpWindow2', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
          

            }

            function a3(url) { 
	popupWindow3 = window.open(
                    url, 'popUpWindow3', 'height=308,width=299,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
            }
</script>

<!-- <a href="JavaScript:a1('http://www.google.com');">focus 1</a>
<a href="JavaScript:a2('http://www.yahoo.com');">focus 2</a>
<a href="JavaScript:a3('http://www.bing.com');">focus 3</a> -->

<?php
	// } else {
	// 	include("404.php");
	// }

	?>




    <!-- Modal -->
<div class="modal fade" id="AUTH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Authentication</h4>
      </div>
      <div class="modal-body" id="auth">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>