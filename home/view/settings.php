<?php

 

$rows=osd_query('osd_setting',$where='',$group='');

foreach($rows as $row){
$cname=$row['company_name'];
$address=$row['s_address'];
$tagline=$row['s_tagline'];
$contact_tel=$row['s_contact_no'];
$contact_cell=$row['st_cp_no'];
$tin=$row['s_TIN'];
$ver=$row['s_ver'];
$curr=$row['s_currency'];
}


?>
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
                    <h5>Settings</h5>

               
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                      <div class="status-area"></div> 
                    <form class="form-horizontal">
 
          <table class="table table-bordered table-striped" style="">
                 
                      <tbody>
     
                        <tr>
                          <td width="30%">
                           <label> Company Name</label>
                          </td>
                          <td>
                            <input type="text" class="form-control inline-setting" id="company_name" value="<?php echo $cname;?>">
                          </td>
                        
                        </tr>
                        <tr>
                          <td>
                           <label>Address</label>
                          </td>
                          <td>
                            <input type="text" class="form-control inline-setting" id="address" value="<?php echo $address;?>">
                          </td>
                        
                        </tr>                        
                          <tr>
                          <td>
                           <label> Tagline</label>
                          </td>
                          <td>
                            <input type="text" class="form-control inline-setting" id="tagline" value="<?php echo $tagline;?>">
                          </td>
                        </tr>
                         <tr>
                          <td>
                           <label>Contact No. (Tel)</label>
                          </td>
                          <td>
                            <input type="text" class="form-control inline-setting" id="contact" value="<?php echo $contact_tel;?>">
                          </td>
                        
                        </tr>   
                        <tr>
                          <td>
                           <label> Contact No. (Cell)</label>
                          </td>
                          <td>
                            <input type="text" class="inline-setting form-control" id="CP" value="<?php echo $contact_cell;?>">
                          </td>
                        
                        </tr>
                        <tr>
                          <td>
                           <label>TIN</label>
                          </td>
                          <td>
                            <input type="text" class="inline-setting form-control" id="tin" value="<?php echo $tin;?>">
                          </td>
                        
                        </tr>



                        <tr>
                          <td>
                           <label>Currency</label>
                          </td>
                          <td>
                            <input type="text" class="inline-setting form-control" id="curr" value="<?php echo $curr;?>">
                          </td>
                        
                        </tr>




                      <?php
                      if(get_current_position()==1):
                      ?>
                        <tr>
                          <td>
                           <label>Version</label>
                          </td>
                          <td>
                            <input type="text" class="inline-setting form-control" id="version" value="<?php echo $ver;?>">
                          </td>
                        
                        </tr>
                      <?php endif;?>

    


                      </tbody>
                    </table>
                    </form>

                  <div id="log-area"></div>
          <table class="table table-bordered table-striped" style="">
          <tr>
            <td width="30%">
             <label>Clear Log</label>
            </td>
            <td>  
           <input type="button" class="btn btn-danger clear_log" value="10 Days"   data-value="10">
           <input type="button" class="btn btn-danger clear_log" value="20 Days"  data-value="20">
           <input type="button" class="btn btn-danger clear_log" value="30 Days" data-value="30">
           <input type="button" class="btn btn-danger clear_log" value="All"   data-value="0">
            </td>
               <td>
      
            </td>       
          </tr>


          </table>





                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div>      
      	  
		  
		  
		  
		









		  
		  
		  
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
	  </div>
 
    <script type="text/javascript" src="assets/js/style-switcher.js"></script>
 

 