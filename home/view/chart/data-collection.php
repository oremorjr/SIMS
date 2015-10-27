<?php
include('../../../include/db_config.php');
$DB= new DB();
 
?>
<?php
if(!current_user('sales-chart-collection'))
  return false;
?>
<?php

 if($_REQUEST['d1']!="" ){
  $d1=$_REQUEST['d1']; 
  $d2=$_REQUEST['d2']; 
  $q_s="AND al_transact_date >= '$d1' AND al_transact_date <= '$d2' ";
}else{
$year=date('Y');
  $q_s="AND YEAR(al_transact_date) = '$year'   ";
}


// Fetch the data
$query = "SELECT ROUND(SUM(al_amount), 2) as amount,  ROUND(SUM(al_amount),2) as profit, al_transact_date FROM `osd_account_ledger` where   al_status=1  and al_amount<>0  $q_s group by al_transact_date
  ORDER BY al_transact_date ASC";
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
  echo '  "category": "' . $row['al_transact_date'] . '",' . "\n";
  echo '  "Sales": ' . $row['amount'] . ',' . "\n"; 
  echo '  "Profit": ' . $row['profit'] . ',' . "\n"; 
  echo " }";
  $prefix = ",\n";
}
echo "\n]";

 
?>
