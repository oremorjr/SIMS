


  </div><!-- /#wrap -->


<!--     <div class="footer-print">
<table width="100%">
  <tr>
    <td class="col-lg-6"></td>
    <td class="col-lg-6 right"> </td>
  </tr>
</table>

     <div class="print-footer">Date generated : <?php echo date('F d, Y h:m:s A');?></div>
     <div class="sub">* This report is generated by the system using Sales & Inventory Management System (SIMS). Copyright 2015</div>

    </div>
 -->
   <div id="footer">
 
      <p>2014 &copy;  <?php echo $company->name; ?> Admin | <?php print(Date("l F d, Y"));  ?></p>
    </div>
	<script type="text/javascript">
	getdate();
        function getdate(){
			var hourString;
			var amPm = "AM";
		
			var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
             if(s<10){
                 s = "0"+s;
             }
			if(m<10){
                 m = "0"+m;
             }			 
			if ( today.getHours() > 11 ) {
				amPm = "PM"
				hourString = "0" + (today.getHours() - 12);
				h = "0" + (today.getHours() - 12);
			} else {
				amPm = "AM"
				hourInt = "0" + today.getHours();
			}			 

            $(".Timer").text(h+":"+m+":"+s+" "+amPm);
             setTimeout(function(){getdate()}, 500);
            }

	$(".numeric").numeric();
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#remove").click(
		function(e)
		{
			e.preventDefault();
			$(".numeric,.integer,.positive").removeNumeric();
		}
	);
	</script> 
  <link rel="stylesheet" href="assets/css/prism.css">
<link rel="stylesheet" href="assets/css/chosen.css"> 
<script src="../js/pos/chosen.jquery.js" type="text/javascript"></script> 
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

     <script src="assets/lib/bootstrap/js/bootstrap.js"></script>	
         <script src="assets/lib/bootstrap/js/bootstrap-combobox.js" type="text/javascript"></script>
    <script type="text/javascript">
      //<![CDATA[
        $(document).ready(function(){
          
          $('.combobox').combobox();
        });
      //]]>
    </script>



    <script src="assets/lib/datatables/jquery.dataTables.js"></script>



  </body>
</html>