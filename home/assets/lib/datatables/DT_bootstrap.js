 
$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
           "order": [[ 0, "desc" ]],
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": 10
});
 
});
 

  