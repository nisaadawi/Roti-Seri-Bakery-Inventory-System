<?php 
include 'db_connect.php'; 

// Exception handling for database queries
try {
    $supplier_qry = $conn->query("SELECT code, supplier_name FROM suppliers ORDER BY supplier_name");

    if (!$supplier_qry) {
        throw new Exception("Error fetching suppliers: " . $conn->error);
    }
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
}
?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card shadow-sm">
				<div class="card-header bg-primary text-white text-center">
					<h4 class="mb-0">Ingredient Information</h4>
				</div>
				<div class="card-body">
					<form action="" id="manage_ingredient" method="post">
						<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="category" class="control-label">Category</label>
									<select name="category" class="form-control form-control-sm" required>
										<option value="">Select Category</option>
										<option value="Dry Ingredient" <?php echo isset($category) && $category == 'Dry Ingredient' ? 'selected' : '' ?>>Dry Ingredient</option>
										<option value="Liquid Ingredient" <?php echo isset($category) && $category == 'Liquid Ingredient' ? 'selected' : '' ?>>Liquid Ingredient</option>
										<option value="Fat Ingredient" <?php echo isset($category) && $category == 'Solid Ingredient' ? 'selected' : '' ?>>Solid Ingredient</option>
										<option value="Sweetener" <?php echo isset($category) && $category == 'Sweetener' ? 'selected' : '' ?>>Sweetener</option>
										<option value="Dairy Product" <?php echo isset($category) && $category == 'Dairy Product' ? 'selected' : '' ?>>Dairy Product</option>
										<option value="Packaging Material" <?php echo isset($category) && $category == 'Packaging Material' ? 'selected' : '' ?>>Packaging Material</option>
									</select>
								</div>
								<div class="form-group">
									<label for="ingredient_code" class="control-label">Ingredient Code</label>
									<input type="text" name="ingredient_code" class="form-control form-control-sm" required value="<?php echo isset($ingredient_code) ? $ingredient_code : '' ?>">
								</div>
								<div class="form-group">
									<label for="ingredient_name" class="control-label">Ingredient Name</label>
									<input type="text" name="ingredient_name" class="form-control form-control-sm" required value="<?php echo isset($ingredient_name) ? $ingredient_name : '' ?>">
								</div>
								<div class="form-group">
									<label for="current_quantity" class="control-label">Current Quantity</label>
									<input type="number" name="current_quantity" class="form-control form-control-sm" required min="0" step="0.01" value="<?php echo isset($current_quantity) ? $current_quantity : '' ?>">
								</div>
								<div class="form-group">
									<label for="measurement" class="control-label">Measurement</label>
									<input type="text" name="measurement" class="form-control form-control-sm" required value="<?php echo isset($measurement) ? $measurement : '' ?>">
								</div>
								<div class="form-group">
									<label for="supplier_detail" class="control-label">Supplier Detail</label>
									<select name="supplier_detail" class="form-control form-control-sm" required>
										<option value="">Select Supplier</option>
										<?php while ($row = $supplier_qry->fetch_assoc()): ?>
										<option value="<?php echo $row['supplier_name']; ?>" <?php echo isset($supplier_detail) && $supplier_detail == $row['supplier_name'] ? 'selected' : '' ?>>
											<?php echo $row['code'] . ' - ' . $row['supplier_name']; ?>
										</option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="date_in" class="control-label">Date In</label>
									<input type="date" name="date_in" class="form-control form-control-sm" required value="<?php echo isset($date_in) ? $date_in : '' ?>">
								</div>
								<div class="form-group">
									<label for="expiration_date" class="control-label">Expiration Date</label>
									<input type="date" name="expiration_date" class="form-control form-control-sm" value="<?php echo isset($expiration_date) ? $expiration_date : '' ?>">
								</div>
							</div>
						</div>
						<hr>
						<div class="col-lg-12 text-center justify-content-center d-flex">
							<button type="submit" name="submit" class="btn btn-success mr-2">Save</button>
							<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=ingredients'">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $('#manage_ingredient').submit(function(e){
        e.preventDefault();

        const quantityField = $('input[name="current_quantity"]');
        const quantityValue = quantityField.val();

        if (isNaN(quantityValue) || quantityValue <= 0) {
            alert_toast("Please enter a valid numeric quantity greater than 0.", "danger");
            quantityField.addClass("border-danger");
            return false;
        }

        start_load();

        $.ajax({
            url: 'ajax.php?action=save_ingredient',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved.", "success");
                    setTimeout(function() {
                        location.replace('index.php?page=ingredients');
                    }, 1500);
                } else {
                    alert_toast("Error saving data. Please try again.", "danger");
                }
            },
            error: function(xhr, status, error) {
                alert_toast("An error occurred during the request: " + error, "danger");
            }
        });
    });
</script>
