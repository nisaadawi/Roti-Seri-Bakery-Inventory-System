<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
		<a class="btn btn btn-sm btn-primary btn-flat" href="./index.php?page=new_category"><i class="fa fa-plus"></i> Add Category</a>
			<div class="card-tools">
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Category</th>
						<th>Description</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM categories");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['category']) ?></b></td>
						<td><b><?php echo $row['description'] ?></b></td>
						<td><b><?php echo $row['created_at'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-success btn-sm btn-flat  wave-effect  dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu">
		                      <a class="dropdown-item view_categories" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_categories&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_categories" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
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
	$('.view_categories').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Category Details","view_categories.php?id="+$(this).attr('data-id'))
	})
	$('.delete_categories').click(function(){
	_conf("Are you sure to delete this category?","delete_categories",[$(this).attr('data-id')])
	})
	})
	function delete_categories($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_categories',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Categories successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>