<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['out_id'])){
	$qry = $conn->query("SELECT * FROM in_out_tracking where out_id = ".$_GET['out_id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<table class="table">
		<tr>
			<th>Ingredient Name:</th>
			<td><b><?php echo ($ingredient_name) ?></b></td>
		</tr>
		<tr>
			<th>Description:</th>
			<td>
			
				<b><?php echo $description ?></b>
			
			</td>
		</tr>
		<!-- <tr>
			<th>Created At:</th>
			<td><b><?php echo $created_at ?></b></td>
		</tr> -->
	</table>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
