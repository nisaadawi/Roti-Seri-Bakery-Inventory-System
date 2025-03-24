<?php
include('includes/dbconnection.php');
session_start();



// OTP Verification
if (isset($_POST['verify_otp'])) {
  
    $userOtp = $_POST['otp'];

    try {
        // Fetch OTP from database
        $sqlSelect = "SELECT email, is_verified FROM users WHERE otp = :otp";
        $querySelect = $dbh->prepare($sqlSelect);
        $querySelect->bindParam(':otp', $userOtp, PDO::PARAM_STR);
        $querySelect->execute();

        if ($querySelect->rowCount() > 0) {
            $row = $querySelect->fetch(PDO::FETCH_ASSOC);
            $email = $row[':email'];
            $isVerified = $row[':is_verified'];
            
            
                // OTP matched, now update the 'is_verified' column to true (1)
                $sqlUpdate = "UPDATE users SET is_verified = 1 WHERE otp = :otp";
                $queryUpdate = $dbh->prepare($sqlUpdate);
                $queryUpdate->bindParam(':otp', $userOtp, PDO::PARAM_STR); // Correctly bind the parameter
                if ($queryUpdate->execute()) {
                    // Redirect to login page
                    echo "<script>alert('OTP verified successfully! Redirecting to login.');</script>";
                    echo "<script>window.location.href='login.php';</script>";
                } else {
                    echo "<script>alert('Error updating verification status. Please try again later.');</script>";
                }
            } else {
                echo "<script>alert('Invalid OTP. Please try again.');</script>";
            }
            } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Cancel Registration
if (isset($_POST['cancel'])) {
    try {
        // Check if there are any unverified users
        $sqlCheck = "SELECT id FROM users WHERE is_verified = 0 ORDER BY id DESC LIMIT 1";
        $queryCheck = $dbh->prepare($sqlCheck);
        $queryCheck->execute();
        
        if ($queryCheck->rowCount() > 0) {
            // Fetch the ID of the last inserted unverified user
            $lastRow = $queryCheck->fetch(PDO::FETCH_ASSOC);
            $lastId = $lastRow['id'];

            // Delete the last inserted unverified user record
            $sqlDelete = "DELETE FROM users WHERE id = :id";
            $queryDelete = $dbh->prepare($sqlDelete);
            $queryDelete->bindParam(':id', $lastId, PDO::PARAM_INT);
            $queryDelete->execute();

            echo "<script>alert('Registration cancelled. The last unverified record has been deleted. Redirecting to registration page.');</script>";
            echo "<script>window.location.href='registration.php';</script>";
        } else {
            echo "<script>alert('No unverified record found to delete.');</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>

<!doctype html>
<html>

<head>
    <title>EazySurvey | OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/background otp.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            flex-direction: column;
        }
        .icon {
            margin-bottom: 20px;
        }
        .container {
            background: rgba(255, 255, 255, 1); /* Not transparent */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h3 {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 50%; /* Adjusted width to make the input field smaller */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
        }
        button[name="cancel"] {
            background-color: #dc3545;
        }
        button:hover {
            opacity: 0.9;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="images/icon_RSB.png" alt="Icon" class="icon">
        <h3>Enter OTP sent to your email</h3>
        <form method="post">
            <input type="text" name="otp" placeholder="Enter OTP">
            <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
            <div class="button-group">
                <button type="submit" name="verify_otp">Verify OTP</button>
                <button type="submit" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>