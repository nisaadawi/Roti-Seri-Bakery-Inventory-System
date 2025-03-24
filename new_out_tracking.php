<?php
include 'db_connect.php';

// Get ingredient details based on ID passed via query
$ingredient_code = '';
$ingredient_name = '';
$quantity = '';
$description = '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
if (isset($_GET['ingredient_id'])) {
	$ingredient_id = $_GET['ingredient_id'];
	$query = $conn->query("SELECT * FROM ingredients WHERE id ='$ingredient_id'");
	if ($query->num_rows > 0) {
		$ingredient = $query->fetch_assoc();
		$id = $ingredient['id'];
		$ingredient_code = $ingredient['ingredient_code'];
		$ingredient_name = $ingredient['ingredient_name'];
		$supplier_detail = $ingredient['supplier_detail'];
		$quantity = $ingredient['current_quantity'];
		// Set default description based on action
		if ($action == 'track_out') {
			$description = "Marked ingredient as OUT.";
		} elseif ($action == 'use_now') {
			$description = "Ingredient used immediately.";
		}
	}
}
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card shadow-sm">
				<div class="card-header bg-primary text-white text-center">
					<h4 class="mb-0"> OUT Ingredient Tracking</h4>
				</div>
				<div class="card-body">
					<form action="" id="manage_in_out_tracking" method="post">
						<input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
						<div class="row justify-content-center">
							<div class="col-md-8">
								<b class="text-muted">Tracking Information</b>
								<div class="form-group">
									<label for="track_status">Status</label>
									<input type="text" name="track_status" class="form-control form-control-sm" required value="OUT" readonly>
								</div>
								<div class="form-group">
									<label for="track_status">Ingredients ID </label>
									<input type="text" name="id" class="form-control form-control-sm" required value="<?php echo isset($id) ? $id : ''; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="product" class="control-label">Product</label>
									<select name="ingredient_code" class="form-control form-control-sm" required>
										<option value="<?php echo $ingredient_code; ?>" selected>
											<?php echo isset($ingredient_name) ? "$ingredient_code - $ingredient_name" : '-- Select Product --'; ?>
										</option>
									</select>
								</div>
								<div class="form-group">
									<label for="" class="control-label">Supplier Detail</label>
									<input type="text" name="supplier_detail" class="form-control form-control-sm" required value="<?php echo isset($supplier_detail) ? $supplier_detail : ''; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="" class="control-label">Quantity OUT</label>
									<input type="number" name="quantity_out" class="form-control form-control-sm" required value="<?php echo isset($quantity) ? $quantity : ''; ?>" <?php echo $action == 'track_out' ? 'readonly' : ''; ?> min="1">
								</div>
								<div class="form-group">
									<label for="" class="control-label">Date OUT</label>
									<input type="date" name="date_out" class="form-control form-control-sm" required value="<?php echo isset($date_out) ? $date_out : ''; ?>">
								</div>
								<div class="form-group">
									<label for="" class="control-label">Description</label>
									<textarea name="description" class="form-control form-control-sm" required rows="5" cols="50"><?php echo $description; ?></textarea>
								</div>
							</div>
						</div>
						<hr>
						<div class="col-lg-12 text-center justify-content-center d-flex">
							<button type="submit" name="submit" class="btn btn-success mr-2">Save</button>
							<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=stock'">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#manage_in_out_tracking').submit(function (e) {
    e.preventDefault();
    $('input').removeClass("border-danger");
    start_load();
    $('#msg').html('');
    $.ajax({
        url: 'ajax.php?action=save_tracking',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            console.log(resp); // Add this line to debug the response
            resp = JSON.parse(resp);
            if (resp.status == 1) {
                alert_toast('Data successfully saved.', "success");
                setTimeout(function () {
                    location.replace('index.php?page=stock');
                }, 1500);
            } else {
                alert_toast(resp.message, "danger");
                end_load();
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText); // Add this line to debug any errors
            alert_toast('An error occurred. Please try again.', "danger");
            end_load();
        }
    });
});
</script>