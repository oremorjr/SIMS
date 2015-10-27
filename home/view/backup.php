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

<?php
backup_tables('localhost','root','admin#123','snk_test');


/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($name,$link);
  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  //cycle through
  foreach($tables as $table)
  {
    $result = mysql_query('SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  
  //save file
  $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  fwrite($handle,$return);
  fclose($handle);
}
?>

  
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
 