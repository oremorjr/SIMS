<?php
include('../include/class_lib.php');
include('../include/osd_header.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?php echo $company->name; ?></title>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery.numeric.js"></script>
             <script type="text/javascript" src="../js/jquery.validate.js"></script>
	<script type="text/javascript" src="../js/custom.js"></script>
    <script src="../js/selectize.js"></script>   
    
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-TileColor" content="#5bc0de">
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png">

    <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.icon-large.css">
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="../images/favicon.png" type="image/png">

    <link href="assets/lib/bootstrap/css/bootstrap-combobox.css" media="screen" rel="stylesheet" type="text/css">	

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/Font-Awesome/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/selectize.css"> 
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.autocomplete.css" />	 
    <link rel="stylesheet" href="assets/lib/datatables/css/jquery.dataTables.css">   <link rel="stylesheet" href="assets/css/theme.css">


 
  </head>
  <body class="mini-sidebar">
    <div class="header-print">
       <table id="" align="center"  class="" style="text-align:center; margin:auto">
  <tr>
    <td class="center" colspan="10">
    <div class="greeting bold t-center f-20"><?php echo $company->name; ?></div>
    <div class="greeting t-center"><?php echo $company->tagline; ?></div>
    <div class="greeting t-center"><?php echo $company->address; ?></div>
    <div class="greeting t-center"><?php echo $company->contact; ?></div>
    <div class="greeting t-center"><?php echo $company->tin; ?></div>
    </td>
  </tr>
    </table>  
    </div>


	<div id="wrap"> 
<script type="text/javascript">



</script>