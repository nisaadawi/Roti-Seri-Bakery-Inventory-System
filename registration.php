<?php

error_reporting(E_ALL);
include('includes/dbconnection.php');
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) {
    $fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8');
    $contact = htmlspecialchars($_POST['contact'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $type = intval($_POST['type']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format. Please enter a valid email address.")</script>';
    } 
    elseif (preg_match('/[|&;$%"<>()+]/', $password)) {
        echo '<script>alert("Password contains invalid characters. Please enter a valid password.")</script>';
    } 
    elseif (preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $fullname) || preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $contact) || preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $email)) {
        echo '<script>alert("Input contains script tags. Please enter valid input.")</script>';
    } else {
        $password = md5($password);
        try {
            // Check if the email already exists
            $sqlCheck = "SELECT email FROM users WHERE email = :email";
            $queryCheck = $dbh->prepare($sqlCheck);
            $queryCheck->bindParam(':email', $email, PDO::PARAM_STR);
            $queryCheck->execute();

            if ($queryCheck->rowCount() > 0) {
                // If email already exists
                echo '<script>alert("Email already exists. Please try with a different email.")</script>';
            } else {
                // If email not yet exist, proceed with registration

                $email = $_POST['email'];
                
                    // Add insert query here
                    $sqlInsert = "INSERT INTO users (fullname, contact, email, password, type) VALUES (:fullname, :contact, :email, :password, :type)";
                    $queryInsert = $dbh->prepare($sqlInsert);
                    $queryInsert->bindParam(':fullname', $fullname, PDO::PARAM_STR);
                    $queryInsert->bindParam(':contact', $contact, PDO::PARAM_STR);
                    $queryInsert->bindParam(':email', $email, PDO::PARAM_STR);
                    $queryInsert->bindParam(':password', $password, PDO::PARAM_STR);
                    $queryInsert->bindParam(':type', $type, PDO::PARAM_INT);
                    $queryInsert->execute();
                    // // Generate OTP
                    $otp = rand(100000, 999999);  // Generate a 6-digit OTP

                    // Store the OTP in the session
                    $sqlOtpInsert = "UPDATE users SET otp = :otp WHERE email = :email";
                    $queryOtpInsert = $dbh->prepare($sqlOtpInsert);
                    $queryOtpInsert->bindParam(':otp', $otp, PDO::PARAM_STR);
                    $queryOtpInsert->bindParam(':email', $email, PDO::PARAM_STR);
                    $queryOtpInsert->execute();

                    // Send OTP to the user
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->Username = "eazysurvey123@gmail.com";
                    $mail->Password = "cqlprqrgtttssphq";

                    $mail->setFrom("eazysurvey123@gmail.com", "Roti Sri Bakery | Inventory System");
                    $mail->addAddress($email, $fullname);

                    $mail->Subject = "Your OTP for Roti Sri Bakery Inventory Registration";
                    $mail->Body = "Dear $fullname,

        Please use the following OTP to complete your registration: $otp

        Best regards,
        Roti Sri Bakery Team";

                    if ($mail->send()) {
                        echo '<script>alert("OTP has been sent to your email. Please check your inbox.")</script>';
                        echo "<script>window.location.href = 'otp_verification.php';</script>";
                    } else {
                        echo '<script>alert("Error in sending OTP. Please try again.")</script>';
                    }
                } 
            }catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>

<!doctype html>
<html>

<head>
    <title>Registration | RSB Inventory System </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
    <style>
        #passwordStrength {
            font-size: 11px;
            margin-top: 1px;
        }

        #passwordInfoIcon {
            font-size: 14px;
            /* Adjust icon size */
            vertical-align: middle;
            /* Align with text */
        }

        #passwordInfoIcon:hover {
            color: #0056b3;
            /* Darker blue on hover for better accessibility */
        }

        /* Tooltip styles for the password requirements */
        #passwordRequirements {
            display: none;
            /* Initially hidden */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            width: 200px;
            line-height: 1.5;
        }

        .contact-info {
            margin-bottom: 10px; /* Adjusted margin to move text closer to the form */
        }
        .contact-grids {
            margin-top: 0; /* Remove top margin to move form closer to the text */
        }
    </style>
    <!--script-->
    <script src="js/jquery-1.11.0.min.js"></script>
    <!-- js -->
    <script src="js/bootstrap.js"></script>
   
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!--/fonts-->
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
    <script>
        function validatePassword() {
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirmPassword");
            if (password.value != confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
    </script>
</head>

<body>
    <!--header-->
    <?php include_once('includes/header.php'); ?>
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
                <h3 class="c-text">Register Here</h3>
            </div>

            <div class="contact-grids">
                <form class="forms-sample" method="post" enctype="multipart/form-data" onsubmit="return validateEmail()">

                    <div class="form-group">
                        <label for="exampleInputName1">Full Name</label>
                        <input
                            style="width:50%;"
                            type="text"
                            id="fullname"
                            name="fullname"
                            class="form-control"
                            required
                            pattern="^[A-Za-z\s@]+$"
                            title="Name should only contain letters and spaces (also '@' symbol, if applicable). No other special characters or numbers allowed.">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Contact Number</label>
                        <input
                            style="width:50%;"
                            type="text"
                            name="contact"
                            value=""
                            class="form-control"
                            pattern="^\d{10,15}$"
                            title="Please enter a valid phone number (10-15 digits)."
                            required='true'>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Role</label>
                        <select style="width:50%;" name="type" value="" class="form-control" required='true'>
                            <option value="">Choose your Role</option>
                            <option value="2">Inventory Supervisor</option>
                            <option value="3">Clerk</option>
                        </select>
                    </div>
                    <!-- <h3>Login details</h3> -->
                    <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input style="width:50%;" type="text" name="email" id="email" class="form-control" required='true'>
                    </div>
                    <div class="form-group" style="position: relative; width: 50%; margin-bottom: 10px;">
                        <label for="password" style="min-width: 100px;">
                            Password
                            <i
                                id="passwordInfoIcon"
                                class="fa fa-info-circle"
                                style="color: #007bff; cursor: pointer; margin-left: 5px;"
                                onclick="togglePasswordRequirements()"></i>
                        </label>
                        <input
                            style="width: 100%; padding-right: 40px;"
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            required
                            oninput="validatePassword()">
                        <span id="togglePassword" style="position: absolute; top: 75%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                            <i class="fa fa-eye"></i>
                        </span>
                        <span id="passwordStrength" style="position: absolute; top: 75%; left: calc(100% + 10px); transform: translateY(-50%);"></span>

                        <!-- Password requirements displayed on click -->
                        <div id="passwordRequirements" style="display: none; position: absolute; top: 100%; left: 0; background: #f8f9fa; border: 1px solid #ddd; padding: 10px; border-radius: 5px; font-size: 12px; z-index: 10;">
                            <p style="font-weight: bold; margin: 0 0 10px 0;">Password must contain:-</p>
                            <ul style="list-style-type: disc; padding-left: 20px; margin: 0;">

                                <li>At least 8 characters</li>
                                <li>1 uppercase letter</li>
                                <li>1 lowercase letter</li>
                                <li>1 number</li>
                                <li>1 special character (e.g., @$!%*?_)</li> 
                            </ul>
                        </div>
                    </div>
                    <div class="form-group" style="position: relative; width: 50%; margin-bottom: 10px;">
                        <label for="confirmPassword" style="min-width: 100px;">
                            Re-enter Password
                        </label>
                        <input
                            style="width: 100%; padding-right: 40px;"
                            type="password"
                            name="confirmPassword"
                            id="confirmPassword"
                            class="form-control"
                            required
                            oninput="validatePassword()">
                        <span id="toggleConfirmPassword" style="position: absolute; top: 75%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit" id="submitButton" disabled>Register</button>

                    <div class="clearfix"> </div>
            </div>
        </div>
        <!-- //container -->
    </div>
    <!-- //contact -->
    <?php include_once('includes/footer.php'); ?>
    <script>
        const password = document.querySelector("#password");
        const confirmPassword = document.querySelector("#confirmPassword");
        const togglePassword = document.querySelector("#togglePassword");
        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const passwordStrength = document.querySelector("#passwordStrength");
        const passwordMatch = document.querySelector("#passwordMatch");
        const submitButton = document.querySelector("#submitButton");

        // Toggle password visibility
        togglePassword.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.innerHTML = type === "password" ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>';
        });

        // Toggle confirm password visibility
        toggleConfirmPassword.addEventListener("click", function() {
            const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);
            this.innerHTML = type === "password" ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>';
        });

        // Check password strength
        password.addEventListener("input", function() {
            const value = password.value;
            let strength = "";
                
            if (/[|&;"<>()+{}]/.test(value)) {
                // alert("Password contains invalid characters. Please enter a valid password.");
                strength = "Invalid";
                passwordStrength.style.color = "red";
                submitButton.disabled = true; // Disable submit button
            } else if (value.length < 6) {
                strength = "Weak";
                passwordStrength.style.color = "red";
                submitButton.disabled = true; // Disable submit button
            } else if (value.length >= 6 && /[A-Z]/.test(value) && /[0-9]/.test(value) && /[@$!%*?&_]/.test(value)) {
                strength = "Strong";
                passwordStrength.style.color = "green";
                submitButton.disabled = false; // Enable submit button
            } else {
                strength = "Medium";
                passwordStrength.style.color = "orange";
                submitButton.disabled = true; // Disable submit button
            }

            passwordStrength.textContent = `Password Strength: ${strength}`;
        });

        // Check if passwords match
        confirmPassword.addEventListener("input", function() {
            if (password.value !== confirmPassword.value) {
                passwordMatch.textContent = "Passwords do not match";
                passwordMatch.style.color = "red";
                submitButton.disabled = true; // Disable submit button
            } else {
                passwordMatch.textContent = "Passwords match";
                passwordMatch.style.color = "green";
                submitButton.disabled = false; // Enable submit button if strength is strong
            }
        });

        // Validate email format
        function validateEmail() {
            const email = document.querySelector("#email").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Invalid email format. Please enter a valid email address.");
                return false;
            }
            return true;
        }

        // Add event listener to validate password strength on form submission
        document.querySelector("form").addEventListener("submit", function(event) {
            const password = document.querySelector("#password").value;
            const passwordStrength = document.querySelector("#passwordStrength").textContent;

            if (!(/[A-Z]/.test(password) && /[a-z]/.test(password) && /[0-9]/.test(password) && /[@$!%*?&_]/.test(password) && password.length >= 8)) {
                alert("Password must meet all the requirements listed. Click blue icon to view requirements.");
                event.preventDefault(); // Prevent form submission
            } else if (passwordStrength.includes("Weak") || passwordStrength.includes("Medium")) {
                alert("Password must be 'Strong' to proceed.");
                event.preventDefault(); // Prevent form submission
            }
        });

        // Toggle password requirements visibility
        function togglePasswordRequirements() {
            const requirements = document.getElementById("passwordRequirements");
            if (requirements.style.display === "none" || requirements.style.display === "") {
                requirements.style.display = "block";
            } else {
                requirements.style.display = "none";
            }
        }
    </script>
</body>

</html>