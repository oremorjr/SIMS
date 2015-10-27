// Custom Script written for javascript functions


 function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }

 var sub=0;
var sub1=0;
function getDiscount2(values, qty, bprice){

var bp=qty*bprice;

var array = values.split(",");
var len=array.length;

for (i=0;i<len;i++){
var h=array[i]/100;
if(h!=""){

if(i==0){ sub=bp-(bp*h); }

if(i>0){ sub=sub-(sub*h); }

}
// end empty

}
// end for loop
 


}

    function getDiscount1(values1, qty1, bprice1){
    var bp1=qty1*bprice1;
 
    var array1 = values1.split(",");
    var len1=array1.length;

    for (j=0;j<len1;j++){
        var h1=array1[j]/100;
        if(h1!=""){
      
            if(j==0){ sub1=bp1+(bp1*h1); }

            if(j>0){ sub1=sub1+(sub1*h1); }

        }
        // end empty
       
    }
    // end for loop
    
     if(sub1!=0){
        sub1=sub1;
     
     }

    }

jQuery(document).ready(function(){
    function loading(){
         jQuery('.status-area').slideDown();
        jQuery('.status-area').html('LOADING...');
    }
 function success(){
         // jQuery('.status-area').slideUp();
    jQuery('.status-area').html('success...');
    }   
    jQuery('.inline-setting').change(function(){
        loading();

        // VAR
        var company_name=jQuery('#company_name').val();
        var address=jQuery('#address').val();
        var tagline=jQuery('#tagline').val();
        var tel=jQuery('#contact').val();
        var cp=jQuery('#CP').val();
        var tin=jQuery('#tin').val();
        var version=jQuery('#version').val();
        var curr=jQuery('#curr').val();
        
        jQuery.ajax({
            data:{page:'setting', cname:company_name, address:address, tagline:tagline, tel:tel, cp:cp, tin:tin, version:version, curr:curr},
            url:'../include/function/update/update_query.php',
            success:function(data){
                success();
            }
        });

    });



jQuery(".clear_log").click(function(){
var d=$(this).data('value');
clear_log(d);
});
 

function clear_log(days){
jQuery("#log-area").html('wait');
jQuery.ajax({
data: {page:'clear-log', days:days}, 
 url:'../include/function/update/update_query.php',
 success:function(data){
jQuery("#log-area").html(data);
 }
});

}



});




function show_account_ledger(CID, TID, MODE){

  $.ajax({
    data: {CID:CID, TID:TID, MODE:MODE},
    url:'../include/function/pos/account/account-ledger.php',
    success:function(data){
   $('#load-area').html(data);
         ar_details();
    }


  });


}


function ar_details(){
 $(".ardetails").click(function(){
var id=$(this).attr('id');
$('#details-'+id).slideToggle();
 }); 
}



 

function paid_invoice(CID){
 
  $("#paid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID},
    url:'../include/function/pos/account/paid-invoice.php',
    success:function(data){
      $("#paid-invoice").html(data);
      show_receipt();
    }
  });

}


function paid_invoice_year(CID, Y, M, MODE){
 
  $("#paid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, Y:Y,  M:M, MODE:MODE},
    url:'../include/function/pos/account/paid-invoice.php',
    success:function(data){
      $("#paid-invoice").html(data);
      show_receipt();
    }
  });

}


function paid_po_year_report(CID, Y, M, MODE){
 
  $("#paid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, Y:Y,  M:M, MODE:MODE},
    url:'../include/function/pos/account/paid-po_report.php',
    success:function(data){
      $("#paid-invoice").html(data);
      show_receipt();
    }
  });

}


function paid_sales_year_report(CID, Y, M, MODE){
 
  $("#paid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, Y:Y,  M:M, MODE:MODE},
    url:'../include/function/pos/account/paid-sales_report.php',
    success:function(data){
      $("#paid-invoice").html(data);
      show_receipt();
    }
  });

}

function unpaid_invoice(CID, MODE){
 
  $("#unpaid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, MODE:MODE},
    url:'../include/function/pos/account/unpaid-invoice.php',
    success:function(data){
      $("#unpaid-invoice").html(data);
      show_receipt();
    }
  });

}


function unpaid_invoice2(CID, MODE){
 
  $("#unpaid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, MODE:MODE},
    url:'../include/function/pos/account/unpaid-invoice_dt.php',
    success:function(data){
      $("#unpaid-invoice").html(data);
      show_receipt();
    }
  });

}


function unpaid_invoice_list(CID, MODE, Y, M){
 
  $("#unpaid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, MODE:MODE, YEAR:Y, MONTH:M},
    url:'../include/function/pos/account/unpaid-invoice_dt_list.php',
    success:function(data){
      $("#unpaid-invoice").html(data);
      show_receipt();
    }
  });

}



function unpaid_po(CID, MODE){
 
  $("#unpaid-invoice").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');


  $.ajax({
    data:{CID:CID, MODE:MODE},
    url:'../include/function/pos/account/unpaid-po-dt.php',
    success:function(data){
      $("#unpaid-invoice").html(data);
      show_receipt();
    }
  });

}




function show_receipt(){
   $('.show_receipt').click(function(){
var TID=$(this).attr('id');
item_summary(TID);
});

 
}

function item_summary(tid){
  // reset();
  $("#transaction_details_ledger").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
  var mode='1';
  var empid="<?php echo get_employeee_id();?>";
  //console.log(tid);
  $("#show-btn").removeAttr("disabled", "disabled");
  // $("#loading-cart").load("?tid="+tid + "&mode=1").fadeIn(); 
  $.ajax({
    data:{tid:tid, mode:mode, empid:empid},
    url:'../include/function/pos/cart_summary_custom.php',
    success:function(data){
      $("#transaction_details_ledger").html(data);
    }
  });

}


function showItem1(tid, mode, empid){
  $("#loading-cart").html('LOADING...');

  $("#show-btn").removeAttr("disabled", "disabled");  
  $.ajax({
    data:{tid:tid, mode:mode, empid:empid},
    url:'../include/function/pos/cart_edit.php',
    success:function(data){
      $("#loading-cart").html(data);
    }
  });

}



function show_pos_receipt(TID){ 

$.ajax({
data:{TID:TID},
url: "view/view-result/pos-receipt.php",
  success:function(data){
$('.receipt_area').html(data);
  }

});

}


function compare_receipt(mode, dr1, dr2){ 
$('.compare_receipt').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
$.ajax({
data:{mode:mode, dr1:dr1, dr2:dr2},
url: "view/view-result/compare-receipt.php",
  success:function(data){
$('.compare_receipt').html(data);
show_receipt();
  }

});

}

function show_recv_receipt(TID){ 

$.ajax({
data:{TID:TID},
url: "view/view-result/recv-receipt.php",
  success:function(data){
$('.receipt_area').html(data);
  }

});

}



function show_log(MODE, sy, m){ 
  $("#log").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
$.ajax({
data:{MODE:MODE, sy:sy, m:m},
url: "view/view-result/log.php",
  success:function(data){
$('#log').html(data);
  }

});

}

function search_payment_posted(string){
   $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/account/search-account-ledger_posted.php',
    success:function(data){
   $('#receipt-list').html(data);
   show_receipt();
    }


  }); 
}


function search_customers_unpaid(string){
   $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/account/search-account-ledger_unpaid.php',
    success:function(data){
   $('#receipt-list').html(data);
   show_receipt();
    }


  }); 
}

function search_suppliers_unpaid(string){
   $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/account/search-account-ledger_unpaid_po.php',
    success:function(data){
   $('#receipt-list').html(data);
   show_receipt();
    }


  }); 
}



function search_payment_post_dated(string, mode){
   $.ajax({
    data: {RNO:string, MODE:mode},
    url:'../include/function/pos/account/search-account-ledger_post-dated.php',
    success:function(data){
   $('#receipt-list').html(data);
      show_receipt();
    }


  }); 
}