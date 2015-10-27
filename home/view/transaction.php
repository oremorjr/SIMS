<?php
$class=new supplier();
$query="SELECT * from osd_supplier";

?>
      <div id="content">
        <div class="outer">
          <div class="inner">
		   <div class="col-lg-12">
            <div class="row">
			 
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Register Mode</h5>
                  </header>

 <ol class="breadcrumb mb-0">
  <li><a href="?page=index">Home</a></li> 
  <li class="active">Transactions</li>
</ol>


             <div class="text-center register-area">

        
          <?php
          if(current_user('sales')):
          ?>
              <a class="quick-btn sales" href="?page=pos-customer">
                <i class="glyphicon glyphicon-shopping-cart fa-3x"></i>
             <strong>    <span>Sales</span></strong>
               
              </a>
            <?php endif;?>

               <?php    if(current_user('pos-receivings')):?>
              <a class="quick-btn receivings" href="?page=pos-supplier">
                <i class="glyphicon glyphicon-arrow-up fa-3x"></i>
              <strong>   <span>Purchase Order</span></strong>
               
              </a>	
              <?php endif;?>

 

                 <?php    if(current_user('void-sales')):?>
               <a class="quick-btn void" href="?page=transaction-log&m=1">
                <i class="glyphicon glyphicon-remove-circle fa-3x"></i>
               <strong>  <span>Void Sales</span></strong>
             
              </a>
                <?php endif;?>
   
                 <?php    if(current_user('void-p-o')):?>
               <a class="quick-btn void" href="?page=transaction-log&m=2">
                <i class="glyphicon glyphicon-remove-circle fa-3x"></i>
               <strong>  <span>Void P.O</span></strong>
             
              </a>
                <?php endif;?>





              <?php
              if(current_user('edit-receipt')):
              ?>
                       <a class="quick-btn edit-sales" href="?page=edit-receipt">
                <i class="glyphicon glyphicon-refresh fa-3x"></i>
              <strong>  <span>Edit Sales Receipt</span></strong>
             
              </a>    
            <?php
            endif;
            ?>
              <?php
              if(current_user('edit-receivings')):
              ?>
                       <a class="quick-btn edit-po" href="?page=edit-receipt-po">
                <i class="glyphicon glyphicon-refresh fa-3x"></i>
              <strong>  <span>Edit P.O Receipt</span></strong>
             
              </a>    
            <?php
            endif;
            ?>



 
              <?php
              if(current_user('customer-account-ledger')):
              ?>
                       <a class="quick-btn customer" href="?page=search-customer">
                <i class="glyphicon glyphicon-user fa-3x"></i>
                <strong><span>Customer Ledger</span></strong>
             
              </a>    
            <?php
            endif;
            ?>

              <?php
              if(current_user('supplier-account-ledger')):
              ?>
                       <a class="quick-btn supplier" href="?page=search-supplier">
                <i class="glyphicon glyphicon-user fa-3x"></i>
                <strong><span>Supplier Ledger</span></strong>
             
              </a>    
            <?php
            endif;
            ?>

 
            </div>
                </div>
              </div>
            </div><!-- /.row -->
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    <script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>

 