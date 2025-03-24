<?php
if(!isset($conn)){
	include 'includes/dbconnection.php' ;
	include 'db_connect.php' ;
}
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_survey">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<input type="hidden" name="user_id" value="<?php echo isset($_SESSION['login_id']) ? $_SESSION['login_id'] : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Title</label>
							<input type="text" name="title" class="form-control form-control-sm" required value="<?php echo isset($stitle) ? $stitle : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Start</label>
							<input type="date" name="start_date" class="form-control form-control-sm" required value="<?php echo isset($start_date) ? $start_date : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">End</label>
							<input type="date" name="end_date" class="form-control form-control-sm" required value="<?php echo isset($end_date) ? $end_date : '' ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea name="description" id="" cols="30" rows="4" class="form-control" required><?php echo isset($description) ? $description : '' ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
                        <label for="">Category</label>
                        <select  name="category" class="form-control form-control-sm" required='true'>
                          <option value=""><?php echo isset($category) ? $category : '' ?></option>
                         <?php 
$sql2 = "SELECT * from categories";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->category);?> "><?php echo htmlentities($row1->category);?> </option>
 <?php } ?> 
                        </select>
                      </div>
					  <div class="col-md-6">
  <label for="">Respondent</label>
  <?php
    $sql2 = "SELECT * from users where type =3";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
    foreach($result2 as $row1) {
  ?>
  <div>
    <input type="checkbox" name="respondent[]" value="<?php echo htmlentities($row1->id); ?>">
    <label> <i><small><?php echo htmlentities($row1-> fullname); ?> - <?php echo htmlentities($row1->email); ?></small></i> </label>
  </div>
  <?php } ?>
</div>

				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-success mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=templates_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_survey').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_survey',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=survey_template')
					},1500)
				}
			}
		})
	})
</script>