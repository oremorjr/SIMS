	var slug='item-unit';
	 $('.add_unit').change(function(){
	 var s_unit=$(this).val();
	 var PID=$('#ID_').data('value');
	 // alert(s_unit);
	$.ajax({
		data:{UID: s_unit, PID: PID}, 
		url:"../include/function/update/update_class.php?page="+slug,
		success:function(data){
		$('.result-area-unit').html(data);
		}
	});
	 });