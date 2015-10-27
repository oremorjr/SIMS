<?php
include('../../../include/db_config.php');
$DB= new DB();
 



 if($_REQUEST['d1']!="" ){
  $d1=$_REQUEST['d1']; 
  $d2=$_REQUEST['d2']; 
  $q_s="AND td_trans_date >= '$d1' AND td_trans_date <= '$d2' ";
}else{
 $q_s="";
}


// Fetch the data
$query = "
SELECT p_name as category, ROUND(SUM(t_amount_t), 2) as sales , ROUND(SUM(t_profit) , 2)as profit  FROM `osd_transaction` 
INNER JOIN osd_transaction_details ON (t_receiptno=td_transaction_id)
INNER JOIN osd_product ON (td_pcode=PID)
INNER JOIN osd_category ON (p_category_id=CID)
where td_mode=1 and t_mode=1 $q_s
group by p_name";
$result = mysql_query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysql_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Print out rows
$prefix = '';
echo "[\n";
while ( $row = mysql_fetch_assoc( $result ) ) {
  echo $prefix . " {\n";
  echo '  "category": "' . $row['category'] . '",' . "\n";
  echo '  "Sales": ' . $row['sales'] . ',' . "\n"; 
  echo '  "Profit": ' . $row['profit'] . ',' . "\n"; 
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

 
?>