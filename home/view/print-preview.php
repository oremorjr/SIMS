<?php
include('../../include/class_lib.php');
$empid=$_SESSION['SESS_MEMBER_UID'];
$user=new User();
$user->not_login_();
$tid=$_GET['TID'];
$TID=$_GET['TID'];
$TRID=$_GET['TID'];
$MODE=get_mode($TRID);

?>
<head>
<title>SALES - #<?php echo get_receipt_no($TID);?>  </title>
<script type="text/javascript"> 
// window.print();
//window.onfocus=function(){ window.close();}


</script> 
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<script type="text/javascript"> 
 //window.close();
</script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
  <link rel="stylesheet" href="../assets/css/print.css">


 <script type="text/javascript">
$(document).ready(function(){

var TID="<?php echo $TID;?>";
show_receipt(TID);

function show_receipt(TID){ 

$.ajax({
data:{TID:TID},
url: "view-result/pos-receipt.php",
  success:function(data){
$('.receipt_area').html(data);
  }

});

}

});
 </script>

</head>
<body>


<div class="receipt_area col-lg-12">                
</div>


