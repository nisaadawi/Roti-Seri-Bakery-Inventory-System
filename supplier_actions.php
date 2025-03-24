<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
include 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle different actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Function to validate inputs
    function validate_input($field, $value, $type)
    {
        if ($type === 'string') {
            return is_string($value) && !is_numeric($value);
        } elseif ($type === 'number') {
            return is_numeric($value);
        } elseif ($type === 'price') { // New validation for price
            return preg_match('/^\d+(\.\d{1,2})?$/', $value); // Matches numbers with up to 2 decimal places
        }
    return false;
    }

    // Function to display error and redirect
    function show_error($message)
    {
        echo "<script>alert('$message'); window.history.back();</script>";
        exit;
    }

    // Add Supplier
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $code = $conn->real_escape_string($_POST['code']);
        $name = $conn->real_escape_string($_POST['name']);
        $contact = $conn->real_escape_string($_POST['contact']);
        $ingredient = $conn->real_escape_string($_POST['ingredient']);
        $price = $conn->real_escape_string($_POST['price']);
        $performance = $conn->real_escape_string($_POST['performance']);
        $measurement = $conn->real_escape_string($_POST['measurement']); // New measurement field

        // Validate inputs
        if (!validate_input('code', $code, 'string')) show_error('Code must be a string.');
        if (!validate_input('name', $name, 'string')) show_error('Supplier name must be a string.');
        if (!validate_input('contact', $contact, 'number')) show_error('Contact number must be numeric.');
        if (!validate_input('ingredient', $ingredient, 'string')) show_error('Ingredient must be a string.');
        if (!validate_input('price', $price, 'price')) show_error('Price must be a valid number with up to 2 decimal places.');
        if (!validate_input('performance', $performance, 'number')) show_error('Performance must be numeric (1-3).');
        if (!validate_input('measurement', $measurement, 'string')) show_error('Measurement must be a string.');

        // Check for duplicate code
        $duplicateCheck = $conn->query("SELECT * FROM suppliers WHERE code = '$code'");
        if ($duplicateCheck->num_rows > 0) {
            echo "<script>
                    alert('Error: Supplier with code \"$code\" already exists. Please use a unique code.');
                    window.history.back();
                 </script>";
            exit;
        }

        // Calculate the next num value
        $result = $conn->query("SELECT IFNULL(MAX(num), 0) + 1 AS next_num FROM suppliers");
        $row = $result->fetch_assoc();
        $next_num = $row['next_num'];

        // Insert into database
        $sql = "INSERT INTO suppliers (num, code, supplier_name, contact_number, supplier_ingredient, current_price, measurement, supplier_performance)
                VALUES ('$next_num', '$code', '$name', '$contact', '$ingredient', '$price', '$measurement', '$performance')";
        $conn->query($sql);

        // Redirect after successful addition
        header("Location: index.php?page=suppliers");
        exit;
    } catch (mysqli_sql_exception $e) {
        echo "<script>
                alert('An unexpected error occurred: " . addslashes($e->getMessage()) . "');
                window.history.back();
             </script>";
        error_log("MySQL Error: " . $e->getMessage());
        exit;
    }
}

    // Edit Supplier
    if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $id = $conn->real_escape_string($_POST['id']);
            $code = $conn->real_escape_string($_POST['code']);
            $name = $conn->real_escape_string($_POST['name']);
            $contact = $conn->real_escape_string($_POST['contact']);
            $ingredient = $conn->real_escape_string($_POST['ingredient']);
            $price = $conn->real_escape_string($_POST['price']);
            $performance = $conn->real_escape_string($_POST['performance']);
            $measurement = $conn->real_escape_string($_POST['measurement']); // New measurement field

            // Validate inputs
            if (!validate_input('code', $code, 'string')) show_error('Code must be a string.');
            if (!validate_input('name', $name, 'string')) show_error('Supplier name must be a string.');
            if (!validate_input('contact', $contact, 'number')) show_error('Contact number must be numeric.');
            if (!validate_input('ingredient', $ingredient, 'string')) show_error('Ingredient must be a string.');
            if (!validate_input('price', $price, 'price')) show_error('Price must be a valid number with up to 2 decimal places.');
            if (!validate_input('performance', $performance, 'number')) show_error('Performance must be numeric (1-3).');
            if (!validate_input('measurement', $measurement, 'string')) show_error('Measurement must be a string.');
            
            // Check for duplicate code, excluding the current supplier
        $duplicateCheck = $conn->query("SELECT * FROM suppliers WHERE code = '$code' AND num != $id");
        if ($duplicateCheck->num_rows > 0) {
            echo "<script>
                    alert('Error: Supplier with code \"$code\" already exists. Please use a unique code.');
                    window.history.back();
                 </script>";
            exit;
        }

            // Update supplier details
            $sql = "UPDATE suppliers SET 
                code='$code', 
                supplier_name='$name', 
                contact_number='$contact', 
                supplier_ingredient='$ingredient', 
                current_price='$price', 
                measurement='$measurement', 
                supplier_performance='$performance' 
                WHERE num=$id";
            if ($conn->query($sql)) {
                header("Location: index.php?page=suppliers");
                exit;
            } else {
            throw new Exception("Failed to update supplier details.");
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // Duplicate entry error
                echo "<script>
                        alert('Error: Supplier with code \"$code\" already exists. Please use a unique code.');
                        window.history.back();
                    </script>";
            } else {
                echo "<script>
                        alert('An unexpected error occurred: " . addslashes($e->getMessage()) . "');
                        window.history.back();
                    </script>";
            }
        } catch (Exception $e) {
        echo "<script>
                alert('Error: " . addslashes($e->getMessage()) . "');
                window.history.back();
             </script>";
        }
    }

    // Delete Supplier
    if ($action === 'delete') {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = "DELETE FROM suppliers WHERE num=$id";
        $conn->query($sql);
        header("Location: index.php?page=suppliers");
        exit;
    }

    // Fetch supplier data for editing
    if ($action === 'fetch') {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = "SELECT * FROM suppliers WHERE num=$id";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        echo json_encode($data);
        exit;
    }
}
$conn->close();
?>
