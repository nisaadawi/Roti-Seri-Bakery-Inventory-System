<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>

<head>
  <title>RSB | Welcome to RSB</title>
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!--bootstrap-->
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
  <!--coustom css-->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="images/icon.png" type="image/icon type">
  <link href="css/style.css?v=1.0" rel="stylesheet" type="text/css" />
  <!--script-->
  <script src="js/jquery-1.11.0.min.js"></script>
  <!-- js -->
  <script src="js/bootstrap.js"></script>
  <!-- /js -->
  <!--fonts-->
  <link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
  <!--/fonts-->
  <!--hover-girds-->
  <link rel="stylesheet" type="text/css" href="css/default.css" />
  <link rel="stylesheet" type="text/css" href="css/component.css" />
  <script src="js/modernizr.custom.js"></script>
  <!--/hover-grids-->
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <!--script-->
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 900);
      });
    });
  </script>
  <!--/script-->
  <style>
    .centered-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php include_once('includes/header.php'); ?>
  <div class="banner">
    <div class="container">
      <script src="js/responsiveslides.min.js"></script>
      <script>
        $(function() {
          $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
          });
        });
      </script>
      <div class="slider">
        <div class="callbacks_container">
          <ul class="rslides" id="slider">
            <li class="centered-content" style="margin-top: -150px;">
              <h3 style="font-size: 5.5em; font-weight:bold; text-align: center;">Roti Sri Bakery</h3>
              <p style="font-size: 1.3em; font-weight:bold; text-align: center; display: inline-block; margin-top: 4px;">Register Here To Get Started</p>
              <div class="readmore" style="text-align: center; margin-top: 4px;">
                <a href="registration.php" style="font-weight: bold;">Register Here<i class="glyphicon glyphicon-menu-right"> </i></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="welcome">
    <div class="container">
      <?php
      $sql = "SELECT * from page where PageType='aboutus'";
      $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);

      $cnt = 1;
      if ($query->rowCount() > 0) {
        foreach ($results as $row) {               ?>
          <h2><?php echo htmlentities($row->PageTitle); ?></h2>
          <p><?php echo ($row->PageDescription); ?></p><?php $cnt = $cnt + 1;
                                                      }
                                                    } ?>
    </div>
  </div>
  <!--/welcome-->

  <!--\testmonials-->
  <!--specfication-->

  <!--/specfication-->
  <?php include_once('includes/footer.php'); ?>
  <!--/copy-rights-->
</body>

</html>