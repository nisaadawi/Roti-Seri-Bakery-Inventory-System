<?php
error_reporting(E_ALL);
if(!isset($conn)){
	include 'includes/dbconnection.php' ;
    if(isset($_POST['submit']))
    {
  $pagetitle=$_POST['pagetitle'];
  $pagedes=$_POST['pagedes'];
  $sql="update page set PageTitle=:pagetitle,PageDescription=:pagedes where PageType='aboutus'";
  $query=$dbh->prepare($sql);
  $query->bindParam(':pagetitle',$pagetitle,PDO::PARAM_STR);
  $query->bindParam(':pagedes',$pagedes,PDO::PARAM_STR);
  
  $query->execute();
  echo '<script>alert("About us has been updated")</script>';
  
  
    }
    ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
     
      <title>EazySurvey | Update About Us</title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
      <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
      <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <link rel="stylesheet" href="vendors/select2/select2.min.css">
      <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <!-- endinject -->
      <!-- Layout styles -->

      <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

    </head>
    <body>
      <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_sidebar.html -->
          <!-- partial -->
      
              <div class="row">
            
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title" style="text-align: center;">Update About Us</h4>
                      <br>

                      <form class="forms-sample" method="post">
                      <?php

$sql="SELECT * from page where PageType='aboutus'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>      
                      <div class="form-group">
                        <label for="exampleInputName1">Page Title:</label>
                        <input type="text" name="pagetitle" value="<?php  echo $row->PageTitle;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Page Description:</label>
                        <textarea type="text" name="pagedes" class="form-control" required='true'><?php  echo $row->PageDescription;?></textarea>
                      </div>
                      <?php $cnt=$cnt+1;}} ?>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                     
                    </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
                     

<?php { ?>
    <?php } ?>
        <?php } ?>

