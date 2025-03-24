<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		
		<div class="card-body">
    <div class="table-responsive">
        <table class="table tabe-hover table-bordered" id="list">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Ingredient Code</th>
                    <th>Ingredient Name</th>
                    <th>Quantity OUT</th>
                    <th>Date OUT</th>
					<th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT * FROM in_out_tracking ORDER BY out_id DESC" );
                while($row= $qry->fetch_assoc()):
                ?>
                <tr>
                <th class="text-center"><?php echo $i++ ?></th>
                <td><b><?php echo $row['ingredient_code'] ?></b></td>
                <td><b><?php echo ucwords($row['ingredient_name']) ?></b></td>

                    <?php 
                    // Check if quantity_out is not 0 or null
                    $quantity_out = ($row['quantity_out'] >= 0 && $row['quantity_out'] != null) ? $row['quantity_out'] : '';

                    // Check if date_out is not null or empty
                    $date_out = ($row['date_out'] != null && $row['date_out'] != '') ? $row['date_out'] : '';
                    ?>

                
                <td><b style="color: red;"><?php echo $quantity_out ?></b></td>
                <td><b style="color: red;"><?php echo $date_out ?></b></td>

                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-sm btn-flat wave-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item view_track_details" href="javascript:void(0)" data-id="<?php echo $row['out_id'] ?>">View</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item delete_tracking" href="javascript:void(0)" data-id="<?php echo $row['out_id'] ?>">Delete</a>
                        </div>
                    </td>
                </tr>	
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
	</div>
    
</div>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_track_details').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Tracking Details","view_track_details.php?out_id="+$(this).attr('data-id'))
	})
	$('.delete_tracking').click(function(){
	_conf("Are you sure to delete this tracking record?","delete_tracking",[$(this).attr('data-id')])
	})
	})
	function delete_tracking($out_id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_tracking',
			method:'POST',
			data:{out_id:$out_id},
			success:function(resp){
				resp = JSON.parse(resp);
				if(resp.status == 1){
					alert_toast("Tracking data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				} else {
					alert_toast(resp.message, 'danger');
					end_load();
				}
			},
			error: function(xhr, status, error) {
				console.log(xhr.responseText); // Add this line to debug any errors
				alert_toast('An error occurred. Please try again.', "danger");
				end_load();
			}
		})
	}
</script>