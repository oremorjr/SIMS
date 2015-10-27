<?php
 
$class1=new user_transaction();
$query="SELECT * from osd_transaction where t_empid='$empid'";
$class1->select($query);

$tno=$class1->current_tno;

$count_td=mysql_query("SELECT * from osd_transaction");
while($c1=mysql_fetch_array($count_td)){
	$trno=$c1['t_receiptno'];
	$count_td=mysql_query("SELECT * from osd_transaction_details where td_transaction_id='$trno' ");
	$count_td_row=mysql_num_rows($count_td);
	if($count_td_row==0){
		//mysql_query("DELETE from osd_transaction where t_receiptno='$tno' ");
	}
	
	
}

	if(isset($_GET['cancel']) && (isset($_GET['TID']))){
		if($_GET['cancel']=='true'){
		$tid=$_GET['TID'];
		 $query3=mysql_query("UPDATE osd_transaction SET t_active=0 where t_empid='$empid' ");		
		//mysql_query("DELETE from osd_transaction where t_receiptno='$tid' ");				
		//mysql_query("DELETE from osd_transaction_details where td_transaction_id='$tid' ");				
		}
	}
	
	
?> 
      <div id="content">
        <div class="outer">
          <div class="inner">
		   <div class="col-lg-12">
				<div class="row">
				<a href="welcome?page=pos">BACK TO POS</a>
				</div>
            </div><!-- /.row -->
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    <script src="assets/lib/jquery.min.js"></script>
    <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/style-switcher.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

 