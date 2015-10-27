<?php
include('../../../include/db_config.php');
$DB= new DB();
 



 if($_REQUEST['d1']!="" ){
  $d1=$_REQUEST['d1']; 
  $d2=$_REQUEST['d2']; 
  $q_s="AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";
}else{
$year=date('Y');
  $q_s="AND YEAR(t_transaction_date) = '$year'   ";
}


// Fetch the data
$query = "
SELECT ROUND(SUM(t_amount_t), 2) as amount,  ROUND(SUM(t_profit),2) as profit, t_transaction_date FROM `osd_transaction` where   t_mode=1  and t_void=0 and t_return=0  and t_amount_t<>0  $q_s group by t_transaction_date
  ORDER BY t_transaction_date ASC";
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
  echo '  "category": "' . $row['t_transaction_date'] . '",' . "\n";
  echo '  "Sales": ' . $row['amount'] . ',' . "\n"; 
  echo '  "Profit": ' . $row['profit'] . ',' . "\n"; 
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

 
?>