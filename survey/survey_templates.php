<?php 
include('db_connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();

$utype = array('',"Admin","Researcher","Respondent");
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM survey_set {$utype[$_SESSION['login_type']]} where user_id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
} ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
		<a class="btn btn btn-sm btn-primary btn-flat " href="./index.php?page=new_templates"><i class="fa fa-plus"></i> Add New Templates</a>
			<div class="card-tools">
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Title</th>
						<th>Description</th>
						<th>Category</th>
                        <th>Owner</th>
						<th>Start</th>
						<th>End</th>
						<th>Action</th>
						<th>Share</th>
					</tr>
				</thead>
				<tr>
					<?php
$i = 1;
$qry = null;
if (isset($_SESSION['login_id'])) {
    $qry = $conn->query("SELECT survey_set.*, users.*, survey_set.id as ID
    FROM survey_set
    LEFT JOIN users ON survey_set.user_id = users.id 
     order by date(start_date) asc,date(end_date) asc");
    if (!$qry) {
        // query failed, handle the error here
        echo "Error: " . $conn->error;
    } else if ($qry->num_rows > 0) {
        // loop through the result set
        $row = null; // initialize $row to null
        while ($row = $qry->fetch_assoc()) {
			echo "<tr>
        <th class='text-center'>" . $i++ . "</th>
        <td><b>" . $row['title'] . "</b></td>
        <td><b class='truncate'>" . $row['description'] . "</b></td>
        <td><b class='truncate'>" . $row['category'] . "</b></td>
		<td><b class='truncate'>" . $row['fullname'] ."</b></td>
        <td><b>" . date('M d, Y', strtotime($row['start_date'])) . "</b></td>
        <td><b>" . date('M d, Y', strtotime($row['end_date'])) . "</b></td>
        <td class='text-center'>
            <div class='btn-group'>
            <a href='./index.php?page=edit_templates&id=" . $row['ID'] . "' class='btn btn-primary btn-flat' title='Edit Survey'>
            <i class='fas fa-edit'></i>
        </a>
        <a href='./index.php?page=view_templates&id=" . $row['ID'] . "' class='btn btn-info btn-flat' title='View Survey'>
        <i class='fas fa-eye'></i>
    </a>
    
                <button type='button' class='btn btn-danger btn-flat delete_survey' data-id='" . $row['ID'] . "' title='Delete Survey'>
                <i class='fas fa-trash'></i>
            </button>
            </div>
        </td>
        <td class='text-center'>
            <div class='btn-group'>
                <button class='btn btn-primary btn-flat' onclick='copyLink(\"" . $_SERVER['HTTP_HOST'] . "/survey/index.php?page=answer_survey&id=" . $row['id'] . "\")'>
                    <i class='fas fa-share'></i>
                </button>
            </div>
        </td>
    </tr>
	<script>
    function copyLink(link) {
        var tempInput = document.createElement('input');
        tempInput.style = 'position: absolute; left: -1000px; top: -1000px';
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Link copied to clipboard!');
    }
</script>
<script>
    $(document).ready(function() {
        $('#list').dataTable();
        $('.delete_survey').click(function() {
            _conf('Are you sure to delete this survey?', 'delete_survey', [$(this).attr('data-id')]);
        });
    });

    function delete_survey(id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_survey',
            method: 'POST',
            data: { id: id },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast('Data successfully deleted', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_survey').click(function(){
	_conf('Are you sure to delete this survey?','delete_survey',[$(this).attr('data-id')])
	})
	})
	function delete_survey(id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_survey',
			method:'POST',
			data:{id:id},
			success:function(resp){
				if(resp==1){
					alert_toast('Data successfully deleted','success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
";
	            
}
} else {
	// no rows returned by the query
	echo "No data found";

?>



	

				
					
				

		
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
    function copyLink(link) {
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link copied to clipboard!");
    }
</script>
<?php } } ?>