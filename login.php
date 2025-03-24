<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');

// Function to validate email
function validate_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format. Please enter a valid email address.");
    }
}

// Check for login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $username = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    try {
        //validate input length
        if (strlen($username) > 255 || strlen($password) > 255) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Input is too long.'
            ]));
        }
        //reject inut with non-printable characters
        if (preg_match('/[^\x20-\x7E]', $username) || preg_match('/[^\x20-\x7E]/', $password)) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Invalid input detected,'
            ]));
        }
        // Validate password to ensure no harmful characters
        if (preg_match('/[;&|`]/', $password)) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Invalid characters in password.'
            ]));
        }
        // Validate email format
        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!filter_var($username, FILTER_VALIDATE_EMAIL) || !preg_match($emailRegex, $username)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email format. Please enter a valid email address.'
            ]);
            exit;
        }



        // Fetch user data from the database
        $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Validate password
            if (password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['login_id'] = $user['id'];
                echo json_encode(['status' => 'success', 'message' => 'Login successful']);
                exit;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid email or password.'
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email or password.'
            ]);
            exit;
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
        exit;
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login | RSB Inventory System</title>
    <?php include('./header.php'); ?>
    <?php
    if (isset($_SESSION['login_id']))
        header("location:index.php?page=home");

    ?>
</head>
<style>
    body {
        margin: 0;
        /* Remove any default margin */
        height: 100%;
        width: 100%;
        background-image: url('images/background bakery (3).png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        /* Ensures the image covers the screen */
        background-position: center;
        /* Centers the image */
    }

    main#main {
        width: 100%;
        height: calc(100%);
        display: flex;
    }

    .form-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 75%;
        right: 10px;
        /* Adjust as needed for proper spacing */
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        /* Optional: Change icon color */
    }

    .toggle-password i {
        font-size: 1rem;
        /* Adjust icon size as needed */
    }
</style>

<body class="login-page">
    <main id="main">
        <div class="align-self-center w-100">


            <div class="card col-md-4" style="margin: 0 auto;">
                <div class="logo" style="text-align: center;"><a href="index.php"><img src="images/icon_RSB.png" style="margin-top: 10px;"></a></div>
                <div class="card-body">
                    <form id="login-form" class="login-form">
                        <div class="form-group">
                            <label for="email" class="control-label text-dark">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label text-dark">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-sm"
                                required>
                            <span class="toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                        <center><button type="submit"
                                class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                        <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
    $('#login-form').submit(function(e) {
        e.preventDefault()

        const emailInput = $('#email');
        const emailValue = emailInput.val().trim();
        const passwordInput = $('#password').val().trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Remove existing alerts
        $('.alert-danger').remove();

        if (!emailRegex.test(emailValue)) {
            // Display email error
            emailInput.parent().append('<div class="alert alert-danger email-error">Invalid email format. Please enter a valid email address.</div>');
            return; // Stop further execution
        }

        // Proceed with AJAX if email is valid
        $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response Text:", xhr.responseText);
                $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
            },
            success: function(resp) {

                if (resp == 1) {
                    window.location.href = 'index.php?page=home';
                } else if (resp == 2) {
                    $('#login-form').prepend('<div class="alert alert-danger">Your account is frozen. Try again later.</div>');
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>');
                }
                $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
            }
        });
    });

    const togglePassword = document.querySelector('.toggle-password');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
    // JavaScript validation for email format
    const loginForm = document.querySelector('#login-form');
    const emailInput = document.querySelector('#email');

    loginForm.addEventListener('submit', function(e) {
        const emailValue = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex for valid email

        // Clear previous error messages
        const existingError = document.querySelector('.email-error');
        if (existingError) {
            existingError.remove();
        }

        if (!emailRegex.test(emailValue)) {
            e.preventDefault(); // Prevent form submission
            // Display an error message
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('email-error', 'alert', 'alert-danger');
            errorDiv.style.marginTop = '10px';
            errorDiv.textContent = 'Invalid email format. Please enter a valid email address.';
            emailInput.parentNode.appendChild(errorDiv);
        }
    });
</script>

</html>