<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="dropdown">
    <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo strtoupper(substr($_SESSION['login_fullname'], 0, 1)) ?></span>
      <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['login_fullname']) ?></span>


    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item manage_account" href="javascript:void(0)" data-id="<?php echo $_SESSION['login_id'] ?>">Manage Account</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
    </div>
  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- CLERK -->
        <?php if ($_SESSION['login_type'] == 3): ?>
          <li class="nav-item">
            <a href="./index.php?page=ingredients" class="nav-link nav-ingredients">
              <i class="nav-icon fa fa-cart-plus"></i>
              <p>
                Ingredients IN
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="./index.php?page=out_tracking" class="nav-link nav-out_tracking">
              <i class="nav-icon fa fa-cart-arrow-down"></i>
              <p>
                Ingredients OUT
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="./index.php?page=stock" class="nav-link nav-stock">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Stock
              </p>
            </a>
            <li class="nav-item">
            <a href="./index.php?page=suppliers_clerk" class="nav-link nav-suppliers_clerk">
              <i class="nav-icon fa fa-clipboard-list"></i>
              <p>
                Suppliers Management
              </p>
            </a>
          </li> 
          </li> 
              <li class="nav-item">
                <a href="./index.php?page=orders" class="nav-link nav-orders tree-item">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>Ingredient Orders Tracking</p>
                </a>
              </li>
          <li class="nav-item">
            <a href="./index.php?page=sales_data" class="nav-link nav-page-settings">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Sales Data
              </p>
            </a>
          </li>
          <!-- INVENTORY SV -->
        <?php elseif ($_SESSION['login_type'] == 2): ?>
          <li class="nav-item">
            <a href="./index.php?page=ingredients" class="nav-link nav-ingredients">
              <i class="nav-icon fa fa-cart-plus"></i>
              <p>
                Ingredients IN
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="./index.php?page=out_tracking" class="nav-link nav-out_tracking">
              <i class="nav-icon fa fa-cart-arrow-down"></i>
              <p>
                Ingredients OUT
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="./index.php?page=stock" class="nav-link nav-stock">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Stock
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="./index.php?page=suppliers" class="nav-link nav-suppliers">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Suppliers Management
              </p>
            </a>
          </li> 
          <li class="nav-item">
              <a href="./index.php?page=orders" class="nav-link nav-orders tree-item">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>Ingredient Orders Tracking</p>
              </a>
            </li>
          <li class="nav-item">
            <a href="./index.php?page=sales_data" class="nav-link nav-page-settings">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Sales Data
              </p>
            </a>
          </li>
        <!-- ADMIN -->
        <?php elseif ($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=survey_widget" class="nav-link nav-survey_widget nav-answer_survey">
              <i class="nav-icon fas fa-poll-h"></i>
              <p>
                Survey List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=sales_data" class="nav-link nav-sales_data">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Sales Data</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=inbox" class="nav-link nav-inbox">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Inbox</p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function() {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      console.log($('.nav-link.nav-' + page).hasClass('tree-item'))
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }


    }
    $('.manage_account').click(function() {
      uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
  })
</script>