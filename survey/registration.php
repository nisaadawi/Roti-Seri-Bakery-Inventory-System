<?php
error_reporting(E_ALL);
include('includes/dbconnection.php');
require "vendor/autoload.php";
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
if(isset($_POST['submit']))
{
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$type=$_POST['type'];
$sql="insert into users(fullname,email,password,type)values(:fullname,:email,:password,:type)";
$query=$dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':type',$type,PDO::PARAM_STR);
$query->execute();
 $LastInsertId=$dbh->lastInsertId();
 if ($LastInsertId>0) {
  $mail = new PHPMailer(true);
  
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;
  
  $mail->Username = "eazysurvey123@gmail.com";
  $mail->Password = "cqlprqrgtttssphq";
  
  $mail->setFrom($email, "EazySurvey | Survey Management System");
  $mail->addAddress($_POST["email"], $_POST['fullname']);
  
  $mail->Subject = "Welcome onboard with us, EazySurvey";
  $mail->Body = "Dear $fullname,

We would like to thank you for choosing us as your choice to manage your survey with us.
Your role(1-Administrator, 2-Researcher): $type.
Your Username: $email, 
Your Password: $password.

Your Sincerely
EazySurvey Team
easysurvey123@gmail.com";
  
  $mail->send();
  echo '<script>alert("Successfully Registered. Thank You for joining us")</script>';
echo "<script>window.location.href ='login.php'</script>";
}
else
  {
       echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}

?>

<!doctype html>
<html>
<head>
<title>EazySurvey | Registration </title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!--coustom css-->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="images/icon.png" type="image/icon type">

<!--script-->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- js -->
<script src="js/bootstrap.js"></script>
<!-- /js -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--/fonts-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<!--/script-->
</head>
	<body>
<!--header-->
		<?php include_once('includes/header.php');?>
<!-- Top Navigation -->
<div class="banner banner5">
	<div class="container">
	<h2>Registration</h2>
	</div>
</div>
<!--header-->
		<!-- contact -->
		<div class="contact">
			<!-- container -->
			<div class="container">
				<div class="contact-info">
				<h3 class="c-text">Participate Here</h3>
				</div>
				
				<div class="contact-grids">
                <form class="forms-sample" method="post" enctype="multipart/form-data">
					
                      <div class="form-group">
                        <label for="exampleInputName1">First Name</label>
                        <input style="width:50%;"type="text" name="fullname" value="" class="form-control" required='true'>
                      </div>
					  <div class="form-group">
                        <label for="exampleInputName1">Role</label>
                        <select style="width:50%;" name="type" value="" class="form-control" required='true'>
                          <option value="">Choose your Role</option>
                          <option value="1">Administrator</option>
                          <option value="2">Researcher</option>
                          <option value="3">Respondent</option>
                        </select>
                      </div>
					  <h3>Login details</h3>
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input style="width:50%;" type="email" name="email" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input  style="width:50%;" type="password" name="password" value="" class="form-control" required='true'>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Register</button>
                      
                      
					
	
					<div class="clearfix"> </div>
				</div>
			</div>
			<!-- //container -->
		</div>
		<!-- //contact -->
<?php include_once('includes/footer.php');?>
<!--/copy-rights-->
	</body>
</html>
