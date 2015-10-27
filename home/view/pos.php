<?php
if(!current_user('sales'))
  return false;
?>
<?php 
$empid=$_SESSION['SESS_MEMBER_UID'];	

if(!isset($_REQUEST['ID']))
return false;

$CID=$_REQUEST['ID'];
$mode=1;


$check_active=pabs_query_general("TID", "osd_transaction", "t_empid='$empid' and t_active=1");
$current_tid=pabs_query_general("TID", "osd_transaction", "t_empid='$empid' and t_active=1");




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

 

function val2(){
$(".val2 ").change(function(){
$("#clear").trigger('click');
});

}

function reset_search(){ 
$("#clear").trigger('click');
}

function showItem(){
	// reset();
	$("#loading-cart").html('LOADING...');
	var tid=$("#TID").val();
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid},
		url:'../include/function/pos/cart_3.php',
		success:function(data){
			$("#loading-cart").html(data);
			val2();
		}
	});

}

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

function receipt_details(){
	// reset();
	$("#receipt_details").html('LOADING...');
	var tid=$("#TID").val();
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	var CID="<?php echo $CID;?>";
	//console.log(tid);
	$("#show-btn").removeAttr("disabled", "disabled");
	// $("#loading-cart").load("?tid="+tid + "&mode=<?php  echo $mode; ?>").fadeIn();	
	$.ajax({
		data:{tid:tid, mode:mode, empid:empid, CID:CID},
		url:'../include/function/pos/cart_summary_details.php',
		success:function(data){
			$("#receipt_details").html(data);
			update_additional_details();
		}
	});

}


function refresh_tid(){
 setInterval(function() {
 getTNO_5();
    }, 5000);
}


function getTNO_5(){
	var mode="<?php echo $mode;?>";
	var empid="<?php echo $empid;?>";
	$.ajax({
		data:{mode:mode, empid:empid, new_tno:0},
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
		$('#loading').hide().html('<div class="img-loading"><img  src="../images/loading_animation.gif" width="54"> </div>').fadeIn();
		var d='pcode='+pcode;
		$.ajax({
			type:"post",
			url:"../include/function/search.php",
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
	var CID="<?php echo $CID;?>";
	var unit_price=$("#unit option:selected").data('price');
	console.log(price);
	var dataString=$("#sales-form").serialize();
	$.ajax({
	type:"post",
	url:"../include/function/pos/pos.php?mode=<?php  echo $mode; ?>",
	data: dataString + '&tno=' + tno + "&price="+price+"&CID="+CID+"&unit_price="+unit_price,
	success:function(data){
	$("#preview_error").html('<pre>'+data+'</pre>');
	  showItem();
	hideAdd();
	$('#loading').hide().html(' ').fadeIn();
	var ccid="<?php echo $_GET['ID'];?>";
	// window.location='?page=pos&ID='+ccid;	 

	},
	beforeSend: function(){
	  loading();
	}
	});		
});	
}
$("#show-btn").click(function(){
	item_summary();
	receipt_details();
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
	$("#new_transaction").attr("href", "view/print-preview.php?mode=<?php  echo $mode; ?>&TID=" + tid );
	$("#new_transaction").attr("data-view", "view/print-preview.php?mode=<?php  echo $mode; ?>&TID=" + tid );
	$("#new_transaction").attr("data-link", "view/print-preview-home.php?mode=<?php  echo $mode; ?>&TID=" + tid );
	var ref_no=$("#temp_no").data('tno');
	$(".final-label").html(ref_no+' has been processed. ');
});


function clear_tf(){
	$("#transaction").slideUp();
	$("#loading-sales").show('slow');
}

$("#btn-close").click(function(){
	var ccid="<?php echo $_GET['ID'];?>";
	window.location='?page=pos&ID='+ccid;
});


$("#new_transaction").click(function(){

	$('#finalize').removeAttr("disabled");
	$(".ui-autocomplete-input").focus();	
	 $( "#btn-close" ).trigger( "click" );
	 $("#transaction").slideDown();
	 $("#prompt-new").hide();
	 $("#show-btn").attr("disabled", "disabled");
	 $(".trans-form").slideUp();
	 $("#finalize").val("Complete Transaction");
	 $("#loading-sales").hide();
		var url = $(this).data('link');
		var url2= $(this).data('view');
		var windowName = "RECEIPT"; // <-- using .data()

		// window.open(url, windowName, "height=600,width=1268");
		// return false;	

	a1(url);
	a2(url2); 

	var ccid="<?php echo $_GET['ID'];?>";
	window.location='?page=pos&ID='+ccid;

 
});

function a1(url){ 

// popupWindow1 = window.open(url, 'RECIPT', 'height=600,width=1260,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no');

}

function a2(url){

popupWindow2 = window.open(url, 'RECEIPT','height=600,width=1260,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no');

}
 
function compose(){

	var tno=$("#RNO").val();
	var cp=$("#cp").val();
	var tid=$("#TID").val();
	var cid=$("#customer option:selected" ).val();
	var payment=$("#payment").val().replace(",", "");
	var gTotal=$("#total_price").val().replace(",", "");
	var change=$("#change").val().replace(",", "");
	var agent_ID=$('#agent option:selected').val();
	var mode="<?php  echo $mode; ?>";
	//var dataString='CID='+ cid + '&TID=' + tid + '&payment=' + payment + '&tno=' + tno + '&change=' + change + '&cp='+cp+"&total="+gTotal; 
	//console.log(dataString);
	if(confirm("Sure you want to process this? There is NO undo!")){
		clear_tf();
		$('#transaction')[0].reset();
		$.ajax({
		type:"post",
		url:"../include/function/pos/compose.php",
		data:{CID:cid, TID:tid, payment:payment, tno:tno, change:change, cp:cp, total:gTotal, mode:mode, agent:agent_ID},
		success:function(data){
			$("#preview_error").html('<pre>'+data+'</pre>');
			 
			showItem();
			$("#loading-sales").slideUp();
			$("#prompt-new").slideDown();
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


function update_additional_details(){

$('#driver').change(function(){
var selected_value=$(this).val();
var slug='driver-pos';
var tid=$('#TID').val();

update_transaction_details(slug,tid,selected_value);

});

$('#agent').change(function(){
var selected_value=$(this).val();
var slug='agent-pos';
var tid=$('#TID').val();

update_transaction_details(slug,tid,selected_value);

});

$('#truck').change(function(){
var selected_value=$(this).val();
var slug='truck-pos';
var tid=$('#TID').val();

update_transaction_details(slug,tid,selected_value);

});

$('#checker').change(function(){
var selected_value=$(this).val();
var slug='checker-pos';
var tid=$('#TID').val();

update_transaction_details(slug,tid,selected_value);

});

$('#COD').change(function(){
var selected_value=$(this).val();
var slug='cod';
var tid=$('#TID').val();

update_transaction_details(slug,tid,selected_value);

});	
}


});
</script>

<block id="preview_error" class="hidden"></block>

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
 <ol class="breadcrumb mb-0">
  <li><a href="?page=index">Home</a></li>
  <li><a href="?page=transaction">Transactions</a></li> 
  <li class="active">Sales</li>
</ol>







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


<div class="col-lg-12">

<ul class="list-group" style="margin-bottom:5px;">
  <li class="list-group-item">Customer Name : <strong id="loading-tno"><?php echo customer('c_firstname', $CID); ?></strong> <a href="?page=pos-customer" class="change">[change]</a></li>
  <li class="list-group-item">Address : <strong  ><?php echo customer('c_address1', $CID); ?></strong></li>
 

<select name="customer"    id="customer" class="hidden"  autocorrect="off" autocomplete="off">
 <option value="<?php echo $CID;?>"></option>
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
<div class="box inverse"  style="min-height:400px;">
<div class="">
<header>
<div class="icons">
<i class="glyphicon glyphicon-shopping-cart"></i>
</div> <button class="btn btn-success left-cart"><strong>Sales Mode</strong></button> 
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
<div class="form-group print-receipt-label" id="prompt-new" style="display:none ;" >

 

<div class="panel panel-default">
 
  <div class="panel-body">

 <div class="final-label">Process has been completed. </div>
  <div>
  <input type="button" id="new_transaction" data-link='#' data-view='#'  value="View Receipt" class="btn btn-success right">
	
  </div>
  </div>
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
<div class="clear"></div>

<div id="receipt_details"></div>

</div>
<div class="col-lg-12 grid">

 <table class=" table table-bordered table-condensed table-hover table-striped col-lg-12" style="float:left;width:100%;" >
  
 <tr>
 <td colspan="2">
<div class="col-lg-12 clear no-right">
<div class="col-lg-8"></div>
<div class="col-lg-4 no-right"><input type="button" id="finalize" value="Complete Transaction" class="btn btn-success right"></div>
</div>

 </td>
 </tr>
 </table>


</div>

                        <!-- <input   type="button" id="compose" value="Complete Sale" class="btn btn-success"> -->

                      </div>

</div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->
<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total.js"></script>	  
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
// $('#agent').selectize({});
$('#truck').selectize({});
$('#checker').selectize({});
var $select=$('#code').selectize({});

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

var control = $select[0].selectize; 

</script>


<script type="text/javascript">

function a1(url){ 

popupWindow1 = window.open(url, 'popUpWindow1', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
popupWindow2 = window.open(url, 'popUpWindow2', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')

}

function a2(url){ 

popupWindow2 = window.open( url, 'popUpWindow2', 'height=250,width=234,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')

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