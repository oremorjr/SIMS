      <div id="content">
        <div class="outer">
    <div class="inner">
    <div class="row">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5>Dashboard</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
 
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-1" class="accordion-body body in" style="min-height:470px;height:auto;overflow:hidden;">
 

<div class="col-lg-12">
 <div id="loading-result" >
<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
</tr>
<?php



$check_pu=mysql_query("SELECT * from osd_supply_remarks where sr_no=5 ");
$countcheck=mysql_num_rows($check_pu);
if($countcheck==0){
mysql_query("INSERT INTO osd_supply_remarks (sr_no, sr_name) VALUES (5, 'SALES') ");
mysql_query("UPDATE osd_supply_remarks SET sr_name='RECV-VOID' where sr_no=4 ");
mysql_query("UPDATE osd_supply_remarks SET sr_name='SALES-VOID' where sr_no=3 ");
echo '5 INSERTED'.'<br>';
}


$check_pu2=mysql_query("SELECT * from osd_supply_remarks where sr_no=6 ");
$countcheck2=mysql_num_rows($check_pu2);
if($countcheck2==0){
mysql_query("INSERT INTO osd_supply_remarks (sr_no, sr_name) VALUES (6, 'RETURN') ");
echo '6 INSERTED'.'<br>';
}

$all1=mysql_query("SELECT * from 
	osd_transaction 
	where t_receiptno NOT IN (SELECT p_transno from osd_product_unit where pu_remarks=5) and  t_mode=1 and TID>0");

while($allrow1=mysql_fetch_array($all1)){

$TID1=$allrow1['TID'];
$t_receiptno1=$allrow1['t_receiptno']; 


?>
 
<tr>
	<td><?php echo $TID1;?></td>
	<td><?php echo $t_receiptno1;?></td>
</tr>
<tr>
	<td colspan="10">
<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
</tr>	
		<?php
		$alltd1=mysql_query("SELECT * from osd_transaction_details
		INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
		INNER JOIN osd_product ON (td_pcode=PID)
		INNER JOIN osd_unit_item ON (td_unit_id=UIID)
		INNER JOIN osd_product_unit ON (pu_unit_id=UIID)
		INNER JOIN osd_unit ON (ui_uid=UID)
		INNER JOIN osd_supplier ON (SID=p_supplier_unit_id)
		where TID='$TID1' and td_mode=1 group by pu_unit_id  ");


		while($alltdrow1=mysql_fetch_array($alltd1)){
			$tdid1=$alltdrow1['TDID'];
			$uid1=$alltdrow1['td_unit_id'];
			$qty1=$alltdrow1['td_qty'];
			$mode1=5;
			$pcode1=$alltdrow1['td_pcode'];
			$supid1=$alltdrow1['t_customer_id'];
			$price1=$alltdrow1['td_price']; 
			$trno21=$alltdrow1['td_transaction_id'];
			$dt1=$alltdrow1['td_date_added'];
			$insert1=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 

			VALUES ('$trno21', '$price1','$supid1', '$pcode1','$uid1', '$qty1','$qty1','$dt1','$mode1')")or die(mysql_error());
		?>
		<tr>
		<td><?php echo $tdid1;?></td>
		<td><?php echo $uid1;?></td>
		<td><?php echo $qty1;?></td>
		<td><?php echo $mode1;?></td>
		<td><?php echo $pcode1;?></td>
		<td><?php echo $supid1;?></td>
		<td><?php echo $price1;?></td>
		<td><?php echo $trno21;?></td>
		</tr>
		<?php
		}
		?>
	</table>		
	</td>
</tr>

<?php


}
?>
</table>
 

<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
</tr>
<?php
 


$all=mysql_query("SELECT * from 
	osd_transaction 
	where t_receiptno NOT IN (SELECT p_transno from osd_product_unit where pu_remarks=6) and  t_mode=3 and t_return=1 and TID>0");

while($allrow=mysql_fetch_array($all)){

$TID=$allrow['TID'];
$t_receiptno=$allrow['t_receiptno']; 


?>
<tr>
	<td><?php echo $TID;?></td>
	<td><?php echo $t_receiptno;?></td>
</tr>
<tr>
	<td colspan="10">
<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
</tr>	
		<?php
		$alltd=mysql_query("SELECT * from osd_transaction_details
		INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
		INNER JOIN osd_product ON (td_pcode=PID)
		INNER JOIN osd_unit_item ON (td_unit_id=UIID)
		INNER JOIN osd_product_unit ON (pu_unit_id=UIID)
		INNER JOIN osd_unit ON (ui_uid=UID)
		INNER JOIN osd_supplier ON (SID=p_supplier_unit_id)
		where TID='$TID' and td_mode=3 group by pu_unit_id  ");


		while($alltdrow=mysql_fetch_array($alltd)){
			$tdid=$alltdrow['TDID'];
			$uid=$alltdrow['td_unit_id'];
			$qty=$alltdrow['td_qty'];
			$mode=6;
			$pcode=$alltdrow['td_pcode'];
			$supid=$alltdrow['SID'];
			$price=$alltdrow['td_price']; 
			$trno2=$alltdrow['td_transaction_id'];
			$dt=$alltdrow['td_date_added'];
			$insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 

			VALUES ('$trno2', '$price','$supid', '$pcode','$uid', '$qty','$qty','$dt','$mode')")or die(mysql_error());
		?>
		<tr>
		<td><?php echo $tdid;?></td>
		<td><?php echo $uid;?></td>
		<td><?php echo $qty;?></td>
		<td><?php echo $mode;?></td>
		<td><?php echo $pcode;?></td>
		<td><?php echo $supid;?></td>
		<td><?php echo $price;?></td>
		<td><?php echo $trno2;?></td>
		</tr>
		<?php
		}
		?>
	</table>		
	</td>
</tr>
<?php


}


?>
</table>








UPDATE TRANS_NO

<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
</tr>
<?php
 


$all=mysql_query("SELECT * from 
	osd_transaction 
	where t_receiptno NOT IN (SELECT p_transno from osd_product_unit where pu_remarks=6) and  t_mode=3 and t_return=1 and TID>0");

while($allrow=mysql_fetch_array($all)){

$TID=$allrow['TID'];
$t_receiptno=$allrow['t_receiptno']; 


?>
<tr>
	<td><?php echo $TID;?></td>
	<td><?php echo $t_receiptno;?></td>
</tr>
<tr>
	<td colspan="10">
<table  width="100%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
	<td>ID</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
	<td>RNO</td>
</tr>	
		<?php
		$alltd=mysql_query("SELECT * from osd_transaction_details
		INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
		INNER JOIN osd_product ON (td_pcode=PID)
		INNER JOIN osd_unit_item ON (td_unit_id=UIID)
		INNER JOIN osd_product_unit ON (pu_unit_id=UIID)
		INNER JOIN osd_unit ON (ui_uid=UID)
		INNER JOIN osd_supplier ON (SID=p_supplier_unit_id)
		where TID='$TID' and td_mode=3 group by pu_unit_id  ");


		while($alltdrow=mysql_fetch_array($alltd)){
			$tdid=$alltdrow['TDID'];
			$uid=$alltdrow['td_unit_id'];
			$qty=$alltdrow['td_qty'];
			$mode=6;
			$pcode=$alltdrow['td_pcode'];
			$supid=$alltdrow['SID'];
			$price=$alltdrow['td_price']; 
			$trno2=$alltdrow['td_transaction_id'];
			$dt=$alltdrow['td_date_added'];
			// $insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 

			// VALUES ('$trno2', '$price','$supid', '$pcode','$uid', '$qty','$qty','$dt','$mode')")or die(mysql_error());
		?>
		<tr>
		<td><?php echo $tdid;?></td>
		<td><?php echo $uid;?></td>
		<td><?php echo $qty;?></td>
		<td><?php echo $mode;?></td>
		<td><?php echo $pcode;?></td>
		<td><?php echo $supid;?></td>
		<td><?php echo $price;?></td>
		<td><?php echo $trno2;?></td>
		</tr>
		<?php
		}
		?>
	</table>		
	</td>
</tr>
<?php


}


?>
</table>

















  
</div><!-- end loading result -->
</div><!-- end col-lg-6 -->




                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 
          <!-- end .inner -->
      
      
      
      
      
      
      
      
      
    
      
      
      
      
      
      
      
      
      
      
      
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    </div>
 <script type="text/javascript">
 $(document).ready(function(){
  show_result();
 
    function show_result(){
      jQuery.ajax({
        data: {slug: 'customer'},
        url: 'view/view-result/customer-list-home.php',
        success: function(data){
           jQuery('#loading-result-2').html(data);
        },
        beforeSend:function(){
           jQuery('#loading-result-2').html('loading');
        }

      });

    }


 });
 </script>
 

