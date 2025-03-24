<?php
error_reporting(E_ALL);
include('includes/dbconnection.php');
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $newpassword = $_POST['newpassword'];
  $confirmpassword = $_POST['confirmpassword'];

  if ($newpassword !== $confirmpassword) {
    echo "<script>alert('Passwords do not match');</script>";
    echo "<script>window.location.href = 'reset_password.php';</script>"; // Redirect back to the reset password page
    exit;
  }

  $hashedPassword = md5($newpassword);

  try {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM users WHERE email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_ASSOC);

    if ($results) {
      error_log("User exists for email: $email"); // Debugging log to confirm the user exists.

      $con = "UPDATE users SET password=:newpassword WHERE email=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $hashedPassword, PDO::PARAM_STR);

      if ($chngpwd1->execute()) {
        echo "<script>alert('Password updated successfully');</script>";

        // Send email notification
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "eazysurvey123@gmail.com";
        $mail->Password = "cqlprqrgtttssphq";
        $mail->setFrom("eazysurvey123@gmail.com", "Roti Sri Bakery | Inventory System");
        $mail->addAddress($email);
        $mail->Subject = "Your password has been changed successfully";
        $mail->Body = "Dear $email,

Your password has been changed successfully. If you did not change your password, please contact us immediately.

Your Sincerely,
Roti Sri Bakery Team";
        if ($mail->send()) {
          // Redirect to login page after successful update and email notification
          echo "<script>alert('Password updated successfully. Redirecting to login page...');</script>";
          echo "<script>window.location.href = 'login.php';</script>";
          exit; // Ensure the script stops execution after the redirect

        } else {
          echo "<script>alert('Failed to update password');</script>";
          error_log("Update failed: " . json_encode($chngpwd1->errorInfo())); // Debugging log for query failure.
        }
      } else {
        error_log("No user found for email: $email"); // Debugging log for email not found.
        echo "<script>alert('Email does not exist in the database');</script>";
      }
    }
  } catch (PDOException $e) {
    error_log("PDOException: " . $e->getMessage()); // Debugging log for PDO exceptions.
    echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
  }
}
?>

<!doctype html>
<html>

<head>
  <title>RSB | Reset Password</title>
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!--eye icon!-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!--bootstrap-->
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
  <!--coustom css-->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
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

  <style>
    .form-group {
      display: flex;
      align-items: center;
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      cursor: pointer;
      color: #6c757d;
    }

    .toggle-password i {
      font-size: 1.2rem;
    }

    .ml-2 {
      margin-left: 10px;
    }
  </style>
</head>

<body>
  <!--header-->
  <?php include_once('includes/header.php'); ?>
  <!-- Top Navigation -->
  <div class="banner banner5">
    <div class="container">
      <h2>Reset Password</h2>
    </div>
  </div>
  <!--header-->
  <!-- contact -->
  <div class="contact">
    <!-- container -->
    <div class="container">
      <div class="contact-info">
        <h3 class="c-text">Please reset your password here!!</h3>
      </div>
      <h4>RECOVER PASSWORD</h4>
      <h6 class="font-weight-light">Enter your email address to reset password!</h6>
      <form class="pt-3" id="login" method="post" name="login">
        <div class="form-group">
          <input type="email" class="form-control form-control-lg" placeholder="Email Address" required="true" name="email">
        </div>
        <div class="form-group">
          <input class="form-control form-control-lg" type="password" name="newpassword" id="newpassword" placeholder="New Password" required="true" />
          <span id="newPasswordStrength"></span> <!-- Display strength for new password -->
          <span class="toggle-password"><i class="fas fa-eye"></i></span> <!-- Eye icon for toggle -->
        </div>
        <div class="form-group">
          <input class="form-control form-control-lg" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required="true" />
          <span id="confirmPasswordStrength"></span> <!-- Display strength for confirm password -->
          <span class="toggle-password"><i class="fas fa-eye"></i></span> <!-- Eye icon for toggle -->
        </div>
        <div class="form-group">
          <div class="mt-3">
            <button class="btn btn-success btn-block loginbtn" name="submit" type="submit">Change Password</button>
          </div>
          <div class="my-2 d-flex justify-content-between align-items-center"></div>
          <div class="mb-2">
            <a href="homepage.php" class="btn btn-block btn-facebook auth-form-btn">
              <i class="icon-social-home mr-2"></i>Back Home
            </a>
          </div>
        </div>
      </form>
    </div>
    <!-- //container -->
  </div>
  <!-- //contact -->
  <?php include_once('includes/footer.php'); ?>
  <!--/copy-rights-->

  <!-- JavaScript for Password Strength -->
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      const togglePasswordIcons = document.querySelectorAll('.toggle-password'); // Select all eye icons

      togglePasswordIcons.forEach(icon => {
        icon.addEventListener('click', function() {
          const passwordField = this.parentElement.querySelector('input'); // Select the associated password field
          const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordField.setAttribute('type', type); // Toggle type between 'text' and 'password'

          // Toggle the eye icon class
          this.querySelector('i').classList.toggle('fa-eye');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      const resetForm = document.querySelector("#reset-form");
      const emailInput = document.querySelector("#email");
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex for valid email
      const newPassword = document.querySelector("#newpassword");
      const confirmPassword = document.querySelector("#confirmpassword");
      const newPasswordStrength = document.querySelector("#newPasswordStrength");
      const confirmPasswordStrength = document.querySelector("#confirmPasswordStrength");
      const submitButton = document.querySelector("[name='submit']");

      // Function to check password strength
      function checkPasswordStrength(password, strengthDisplay) {
        const value = password.value;
        let strength = "";

        if (value.length < 6) {
          strength = "Weak";
          strengthDisplay.style.color = "red";
          submitButton.disabled = true;
        } else if (value.length >= 8 && /[A-Z]/.test(value) && /[0-9]/.test(value) && /[@$!%*?&_]/.test(value)) {
          strength = "Strong";
          strengthDisplay.style.color = "green";
          submitButton.disabled = false;
        } else {
          strength = "Medium";
          strengthDisplay.style.color = "orange";
          submitButton.disabled = true;
        }

        strengthDisplay.textContent = `Strength: ${strength}`;
      }

      // Check password strength for new password
      newPassword.addEventListener("input", function() {
        checkPasswordStrength(newPassword, newPasswordStrength);
      });

      // Check password strength for confirm password
      confirmPassword.addEventListener("input", function() {
        checkPasswordStrength(confirmPassword, confirmPasswordStrength);
      });

      // Validate that new password and confirm password match before submitting
      resetForm.addEventListener("submit", function(event) {
        const emailValue = emailInput.value.trim();

        // Email validation
        if (!emailRegex.test(emailValue)) {
          event.preventDefault(); // Prevent form submission
          alert("Invalid email format. Please enter a valid email address.");
        }

        // Password validation
        if (newPassword.value !== confirmPassword.value) {
          event.preventDefault(); // Prevent form submission
          alert("New Password and Confirm Password do not match.");
        } else if (newPasswordStrength.textContent.includes("Weak") || confirmPasswordStrength.textContent.includes("Weak")) {
          event.preventDefault(); // Prevent form submission
          alert("Password must be strong to proceed.");
        }
      });
    });
  </script>
</body>

</html>