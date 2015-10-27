      <div id="content">
        <div class="outer">
			<div id="breadcrumb2">
				<ul class="crumbs">
					<li class="first"><a href="?page=general" style="z-index:9;"><span></span>General</a></li>
				</ul>
			</div>			
          <div class="inner">
		<div class="row">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5>Choose</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
                      <ul class="nav">
                        <li> <a href="#">Link</a> </li>
                        <li class="dropdown">
                          <a data-toggle="dropdown" href="#">
                            <i class="fa fa-th-large"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li> <a href="">q</a> </li>
                            <li> <a href="">a</a> </li>
                            <li> <a href="">b</a> </li>
                          </ul>
                        </li>
                        <li>
                          <a class="minimize-box" data-toggle="collapse" href="#div-1">
                            <i class="fa fa-chevron-up"></i>
                          </a>
                        </li>
                      </ul>
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-1" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal" method="post"  >
 
					<table class="table table-bordered table-striped">
 
                      <tbody>
                        <tr>
						 
                          <td colspan="2">
						  
						  <div class="col-lg-6">
						
                        <strong> Date Range</strong>
						 </div>
                          </td>
                           
                        </tr>					  
                        <tr>
						<td style="width:10px;">
						 <input type="radio" value="c_1" class="range" name="choice" id="c_1">
						</td>
                          <td>
						  
						  <div class="col-lg-6">
						
                         <select data-value="1" id="1" name="date_range_fixed" class="choice form-control"  >
							<option value="1">Today</option>
							<option value="2">Yesterday</option>
							<option value="3">Last 7 Days</option>
							<option value="4">This Month</option>
							<option value="5">This Year</option>
							<option value="6">Last Year</option>
						 </select>
						 </div>
                          </td>
                           
                        </tr>
                         <tr>
						<td style="width:10px;">
						 <input type="radio" value="c_2" class="range" name="choice" id="c_2">
						</td>
                          <td>
						  
						  <div class="col-lg-3">
						
                         <input class="choice form-control" data-value="2" id="d_1" type="date" >  
						 </div>
						<div class="col-lg-3">
						
                         <input class="choice form-control" data-value="2" id="d_2" type="date" > 
						 </div>					 
                          </td>
                           
                        </tr>	
                        <tr>
						 
                          <td colspan="2">
						  
						  <div class="col-lg-6">
						
                        <strong>Sale Type</strong>
						 </div>
                          </td>
                           
                        </tr>	
                        <tr>
						<td style="width:10px;">
						 
						</td>
                        <td>
						  
						  <div class="col-lg-4">
						
                         <select id="type" class="form-control" >
							<option value="2">Sales</option>
							<option value="1">All</option>
							
							<option value="3">Return</option>
						 </select>
						 </div>
						<div class="col-lg-2">
                         <input type="button" value="Search" id="save" disabled style="width: 100%;padding: 7px 15px;"class="btn btn-success btn-sm btn-grad"  > 
						</div>						 
                        </td>
                           
                        </tr>
						
                      </tbody>
                    </table>
                    </form>
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
 
    <script type="text/javascript" src="assets/js/style-switcher.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#save').click(function(){
		var ID=$('.range:checked').attr('id');
		var selected = $('#type').find('option:selected');
		var type = selected.val(); 	

		if(type==2){
			if(ID=='c_1'){
				var choice=$('.choice').val();
				if(choice==1){
					window.location='?page=report&type=customer&dr=today';
				}else if(choice==2){
					window.location='?page=report&type=customer&dr=yesterday';
				}else if(choice==3){
					window.location='?page=report&type=customer&dr=lastweek';
				}else if(choice==4){
					window.location='?page=report&type=customer&dr=monthly';
				}else if(choice==5){
					window.location='?page=report&type=customer&dr=annual';
				}else if(choice==6){
					window.location='?page=report&type=customer&dr=lastyear';
				}
			}else if(ID=='c_2'){	
				var d1=$('#d_1').val();
				var d2=$('#d_2').val();
				window.location='?page=report&type=customer&dr=range&d1='+d1+'&d2='+d2;
			}
		}
		
		 
		});
	 
		$('.choice').click(function(){
			var ID=$(this).data('value');
			$('#c_'+ID).attr('checked', 'checked');
			$("#save").removeAttr('disabled','disabled');
		});
	});
	</script>

 