<?php include 'db_connect.php'; ?>

<?php
// Escaping function to prevent XSS
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>

<div class="col-lg-12">
  <div class="card card-outline card-success">
    <div class="card-body">
      <h3>Choose Category: </h3>
      <!-- Category Buttons -->
      <div class="row mb-4">
        <?php
        $categories = [
          'Dry Ingredient',
          'Liquid Ingredient',
          'Solid Ingredient',
          'Sweetener',
          'Dairy Product',
          'Packaging Material'
        ];
        $selected_category = isset($_POST['category']) ? $_POST['category'] : '';
        $selected_ingredient = isset($_POST['ingredient']) ? $_POST['ingredient'] : '';
        foreach ($categories as $category): ?>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2">
            <form method="POST">
              <input type="hidden" name="category" value="<?php echo escape($category); ?>">
              <button type="submit" class="btn btn-primary btn-block"><?php echo escape($category); ?></button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Ingredient Selection and Table -->
      <?php if ($selected_category): ?>
        <div>
          <h3><?php echo escape($selected_category); ?> Stocks</h3>
          <form method="POST">
            <input type="hidden" name="category" value="<?php echo escape($selected_category); ?>">
            <div class="form-group">
              <label for="ingredient-select">Select Ingredient:</label>
              <select class="form-control" name="ingredient" id="ingredient-select" onchange="this.form.submit()">
                <option value="">-- Select Ingredient --</option>
                <?php
                $ingredient_qry = $conn->query("SELECT DISTINCT ingredient_name FROM ingredients WHERE category = '$selected_category' ORDER BY ingredient_name");
                while ($ingredient = $ingredient_qry->fetch_assoc()):
                  $formatted_name = ucwords(strtolower($ingredient['ingredient_name'])); ?>
                  <option value="<?php echo escape($ingredient['ingredient_name']); ?>" 
                          <?php echo ($selected_ingredient == $ingredient['ingredient_name']) ? 'selected' : ''; ?>>
                    <?php echo escape($formatted_name); ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>
          </form>

          <?php if ($selected_ingredient): ?>
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th>Supplier Detail</th>
                  <th>Date In</th>
                  <th>Expiration Date</th>
                  <th>Current Quantity</th>
                  <th>Action</th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $qry = $conn->query("SELECT id, supplier_detail, date_in, expiration_date, current_quantity 
                                     FROM ingredients 
                                     WHERE category = '$selected_category' AND ingredient_name = '$selected_ingredient' 
                                     ORDER BY expiration_date");
                $i = 1;
                $total_stock = 0;
                $today = new DateTime();
                while ($row = $qry->fetch_assoc()):
                  $total_stock += $row['current_quantity'];
                  $expiration_date = new DateTime($row['expiration_date']);
                  $days_diff = $today->diff($expiration_date)->days;
                  $expired = $expiration_date < $today;
                  ?>
                  <tr>
                    <td class="text-center"><?php echo escape($i++); ?></td>
                    <td><?php echo escape($row['supplier_detail']); ?></td>
                    <td><?php echo escape($row['date_in']); ?></td>
                    <td><?php echo escape($row['expiration_date']); ?></td>
                    <td><?php echo escape($row['current_quantity']); ?></td>
                    <td>
                      <?php if ($expired): ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="trackOut('<?php echo escape($row['id']); ?>')">
                          Transfer Out
                        </button>
                      <?php elseif ($days_diff <= 7): ?>
                        <button type="button" class="btn btn-warning btn-sm" onclick="useNow('<?php echo escape($row['id']); ?>')">
                          Use Now
                        </button>
                      <?php else: ?>
                        <button type="button" class="btn btn-success btn-sm" onclick="useNow('<?php echo escape($row['id']); ?>')">
                          Use Now
                        </button>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($expired): ?>
                        <p class="text-danger mb-1">Expired <?php echo abs($days_diff); ?> days ago</p>
                      <?php elseif ($days_diff <= 7): ?>
                        <p class="text-warning mb-1">Near Expired: <?php echo $days_diff; ?> days left</p>
                      <?php else: ?>
                        <p class="text-success mb-1">Usable for <?php echo $days_diff; ?> days</p>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4" class="text-right">Total Stock:</th>
                  <th class="<?php echo $total_stock < 100 ? 'text-danger' : ''; ?>">
                    <?php echo escape($total_stock); ?>
                    <?php if ($total_stock < 100): ?>
                      <i class="fas fa-exclamation-triangle"></i> Restock now
                    <?php endif; ?>
                  </th>
                </tr>
              </tfoot>
            </table>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
  function trackOut(id) {
    window.location.href = `index.php?page=new_out_tracking&action=track_out&ingredient_id=${encodeURIComponent(id)}`;
  }

  function useNow(id) {
    if (confirm("Are you sure you want to use this ingredient immediately?")) {
      window.location.href = `index.php?page=new_out_tracking&action=use_now&ingredient_id=${encodeURIComponent(id)}`;
    }
  }
</script>
