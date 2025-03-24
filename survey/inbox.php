<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		<a class="btn  btn-sm btn-primary btn-flat " href="./index.php?page=new_message"><i class="fa fa-plus"></i> New Message</a>
			<div class="card-tools">
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Message</th>
                        <th>Receive Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM contact");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['Name'] ?></b></td>
						<td><b><?php echo $row['Email'] ?></b></td>
						<td><b><?php echo $row['Message']?></b></td>
                        <td><b><?php echo $row['created_at']?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-success btn-sm btn-flat border-info wave-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu">
		                      <a class="dropdown-item view_message" href="javascript:void(0)" data-id="<?php echo $row['ID'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=reply_message&id=<?php echo $row['ID'] ?>">Reply</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_message" href="javascript:void(0)" data-id="<?php echo $row['ID'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_message').click(function(){
		uni_modal("<i class='fa fa-envelope'></i> Message","view_message.php?id="+$(this).attr('data-id'))
	})
	$('.delete_message').click(function(){
	_conf("Are you sure to delete this message?","delete_message",[$(this).attr('data-id')])
	})
	})
	function delete_message($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_message',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Message successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>