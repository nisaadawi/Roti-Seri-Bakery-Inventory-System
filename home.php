<?php include('db_connect.php') ?>
<!-- Info boxes -->
<?php if ($_SESSION['login_type'] == 1): ?>
  <script>
    var welcomeMessage = 'Welcome, Administrator!';
    // Display the welcome message
    alert(welcomeMessage);
  </script>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=categories" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-info text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-folder fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Categories</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM categories ")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=user_list" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-info text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-users fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Respondents</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 3")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=user_list" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-info text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-users fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Researchers</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=survey_templates" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-poll-h fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Survey</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM survey_set")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=inbox" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-envelope fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Messages</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM contact")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <!-- INVENTORY SV AND CLERK -->
<?php elseif ($_SESSION['login_type'] == 2 || $_SESSION['login_type'] == 3 ): ?>
  <script>
    // Set the welcome message based on login type
    var welcomeMessage = "<?php echo ($_SESSION['login_type'] == 2) ? 'Welcome, Inventory Supervisor!' : 'Welcome, Clerk!'; ?>";
    // Display the welcome message
    alert(welcomeMessage);
  </script>
  <div class="col-12">
    <div class="card mb-4 shadow-sm">
      <div class="card-body text-center">
        Welcome <?php echo $_SESSION['login_name'] ?>!
      </div>
    </div>
  </div>
  <div class="col-12">
    <a href="./index.php?page=sales_data" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="icon bg-info text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-chart-line fa-2x"></i>
                </div>
                <h5 class="mt-3 text-info">Sales Data</h5>
                <p class="fs-4 fw-bold text-info">
                    <?php 
                    $result = $conn->query("SELECT SUM(sales) AS total_sales FROM sales");
                    if ($result && $row = $result->fetch_assoc()) {
                        echo number_format($row['total_sales'], 2); // Format as a number with 2 decimal places
                    } else {
                        echo "0.00"; // Fallback if query fails or no sales data
                    }
                    ?>
                </p>
            </div>
        </div>
    </a>
</div>

  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=ingredients" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-info text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fa fa-cart-plus fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Ingredients IN</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=out_tracking" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-danger text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fa fa-cart-arrow-down fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Ingredients OUT</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM in_out_tracking")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-yellow text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fa fa-folder-open fa-2x"></i>
            </div>
            <h5 class="mt-3">Total Categories</h5>
            <p class="fs-4 fw-bold">6</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
    <a href="<?php 
        if ($_SESSION['login_type'] == 2) {
            echo './index.php?page=suppliers'; 
        } elseif ($_SESSION['login_type'] == 3) {
            echo './index.php?page=suppliers_clerk'; 
        } else {
            echo './index.php?page=suppliers'; // Default fallback
        }
    ?>" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <div class="icon bg-pink text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
                    <i class="fas fa-truck fa-2x"></i>
                </div>
                <h5 class="mt-3">Total Suppliers</h5>
                <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM suppliers")->num_rows; ?></p>
            </div>
        </div>
    </a>
</div>
  </div>
  <div class="col-12">
    <div class="card mb-4 shadow-sm">
      <div class="card-body text-center">
        Inventory Stock
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-shopping-bag fa-2x"></i>
            </div>
            <h5 class="mt-3">Dry Ingredient</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Dry Ingredient'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-tint fa-2x"></i>
            </div>
            <h5 class="mt-3">Liquid Ingredient</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Liquid Ingredient'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-cube fa-2x"></i>
            </div>
            <h5 class="mt-3">Solid Ingredient</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Solid Ingredient'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-candy-cane fa-2x"></i>
            </div>
            <h5 class="mt-3">Sweetener</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Sweetener'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-cheese fa-2x"></i>
            </div>
            <h5 class="mt-3">Dairy Product</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Dairy Product'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="./index.php?page=stock" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <div class="icon bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center" style="width: 60px; height: 60px;">
              <i class="fas fa-archive fa-2x"></i>
            </div>
            <h5 class="mt-3">Packaging Material</h5>
            <p class="fs-4 fw-bold"><?php echo $conn->query("SELECT * FROM ingredients WHERE category ='Packaging Material'")->num_rows; ?></p>
          </div>
        </div>
      </a>
    </div>
    
<?php endif; ?>