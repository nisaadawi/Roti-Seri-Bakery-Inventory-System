<?php
error_reporting(E_ALL);
include('includes/dbconnection.php');
require "vendor/autoload.php";
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
$sql="insert into contact(Name,Email,Message)values(:name,:email,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
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
  $mail->addAddress($_POST["email"], $_POST['name']);
  
  $mail->Subject = "Thank You For Contacting Us";
  $mail->Body = "Dear $name,

Hello, Thanks For Contacting EazySurvey. We Have Received Your Message And Will Get Back To You As Soon As Possible.

Your Sincerely
EazySurvey Team
easysurvey123@gmail.com";
  
  $mail->send();
  echo '<script>alert("Thank you for contacting us ")</script>';
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
<title>EazySurvey | Contact Us</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!--coustom css-->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
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
	<h2>Contact</h2>
	</div>
</div>
<!--header-->
		<!-- contact -->
		<div class="contact">
			<!-- container -->
			<div class="container">
				<div class="contact-info">
					<h3 class="c-text">Feel Free to contact us!!!</h3>
				</div>
				<form id="contact-form" class="form-horizontal" method="post">
       
	   <div class="form-group">
		 <div class="col-sm-12">
		   <input type="text" class="form-control" id="name" placeholder="NAME" name="name" value="" required>
		 </div>
	   </div>
 
	   <div class="form-group">
		 <div class="col-sm-12">
		   <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="" required>
		 </div>
	   </div>
 
	   <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea></br>
	   
	   <button class="btn btn-primary send-button" name="submit" type="submit" value="SEND">
		 <div class="alt-send-button">
		 <span class="send-text">SUBMIT</span>
		 </div>
	   </button>
	 </form>
			</div>
			<!-- //container -->
		</div>
		<!-- //contact -->
<?php include_once('includes/footer.php');?>
<!--/copy-rights-->
	</body>
</html>
