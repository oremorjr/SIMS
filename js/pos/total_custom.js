 
		multInputs();
		compute_custom_total();
		var h=$('#item-count').text();
		// console.log(h);
		if(h==0){
			// $("#show-btn").attr("disabled", true);
		}
		$("#payment").blur(function(){
			 
		});
 
       $(".txtMult input").keyup(multInputs);
       $(".txtMult input").keyup(compute_custom_total);
       $("#payment").keyup(multInputs);
	   


 function compute_custom_total(){
var cart1=0;
var cart2=0;
$(".cart_sales").each(function(){

var t=parseFloat($(this).val());
cart1+=t;
});

$(".cart_return").each(function(){

var t=parseFloat($(this).val());
cart2+=t;

});


var total_cart=parseFloat(cart1-cart2);
console.log(total_cart);
$("#total_price").val(total_cart);
var show_gt=commaSeparateNumber(total_cart.toFixed(2));
$(".total_cart").html(show_gt);

}











       function multInputs() {
           var mult = 0;
           var rawTotal=0;
           var lessTotal=0;
           // for each row:
           $("tr.txtMult").each(function () {
               // get the values from this row:
               
			   
			   var $name = $('.pname', this).text();
			   
			   
			   var $val0 = $('.val0', this).text();
			   var $val1 = $('.val1', this).val();
               var $val2 = $('.val2', this).val();
               var $val3 = $('.val3', this).val(); 
               var $val4 = $('.val4', this).val();
               var $val5 = $('.val5', this).val();
 
     

               var sub=0;
               var sub1=0;

               getDiscount1($val3, $val2, $val1);
               getDiscount2($val5, $val2, $val1);



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
	  // console.log('Total Discount - : P '+sub);
	 

	}
	// end function


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
	 	  // console.log('Total Discount + : P '+sub1);
	 }

	}
	// end function



			   
			   if(parseFloat($val0)<=parseFloat($val4)){
					 			
			   }else{
					 		   
			   }
			  
               
			   
	var $total = ($val1 * 1) * ($val2 * 1);
               var $less = $total * $val3;
             
            if($val5==0 && $val3==0){
            	var $total_discount=$total;
            }else{
            	var $total_discount=sub1+sub;
            }


               	var $grandtotal =$total_discount;
             
	


               $('.multTotal',this).text(commaSeparateNumber($grandtotal.toFixed(2)));
               $('.multTotal-2',this).attr('data-value', $grandtotal);
               $('#payment').val($grandtotal);
               $('.item_total',this).val(commaSeparateNumber($grandtotal));
               $('.gtotal_value',this).val($grandtotal);
	lessTotal=$total-$grandtotal ;
	if(lessTotal!=0){
                // $(".less",this).text('₱ '+commaSeparateNumber(lessTotal));
            }
             

 
	

	     mult += parseFloat($grandtotal);
			


           });
		   
		   var t1=intStr1 = $("#payment").val().replace(/[A-Za-z$-]/g, "");
		   var t2=mult;
		   var t3=parseFloat(t2) - parseFloat(t1);
		   if(isNaN(t3)){
			t3=mult;
		   }
		   if(t3<0){
		   t3=0;
		   } 
		   var gtotal=t2.toFixed(2);
			
	 


		   $("#grandTotal").text(commaSeparateNumber(gtotal));
		   $("#total_price").val(gtotal);
		   $(".gTotal-value").text('P '+commaSeparateNumber(gtotal));
		   $(".total-amount").attr('id',gtotal);

  
		   var change=parseFloat(t1)-parseFloat(mult);
		    if(isNaN(change)){
				change=0.00;
			}
		   
		   if(change<0){
			change=0.00;
		   }
		   $("#change").val(commaSeparateNumber(change.toFixed(2)));		
		   
			 
 
			if(parseFloat(t2) <= parseFloat(t1)){
				var t_pay=parseFloat(t1) - parseFloat(t2);
				// $('#payment').removeClass("red");
				 // $('#compose').removeAttr('disabled');
				 // $(".trans-form").slideDown('fast');
			}else{
				//$('#payment').addClass("red"); 
				// $('#compose').attr('disabled', 'disabled');
				// $(".trans-form").slideUp('fast');
			}  
			
			
			 
          
       }
	   
   
	   
	   
 
