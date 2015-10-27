<span id="slug" data-value="<?php echo $slug;?>"></span>
<?php $type=$_GET['type'].'.php';?>
<div id="content">
	<div class="outer">
		<div class="inner">			
			<div id="loading-result">
				<?php require_once("report/$type"); ?>
			</div>
		</div><!-- end .inner -->
	</div><!-- end .outer -->
</div><!-- end #content --><script src="assets/lib/datatables/jquery.dataTables.js" type="text/javascript">
</script><script src="assets/lib/datatables/dataTables.columnFilter.js" type="text/javascript">
</script><script src="assets/lib/datatables/DT_bootstrap.js" type="text/javascript">
</script><script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js" type="text/javascript">
</script><script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js" type="text/javascript">
</script>