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

// Update status and delivery date
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $conn->real_escape_string($_POST['orderId']);
    $newStatus = $conn->real_escape_string($_POST['newStatus']);
    $deliveryDate = isset($_POST['deliveryDate']) ? $conn->real_escape_string($_POST['deliveryDate']) : null;

    // Validate delivery date format
    if ($newStatus === 'delivered' && $deliveryDate) {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $deliveryDate) || !strtotime($deliveryDate)) {
            echo "Error: Invalid date format. Please use YYYY-MM-DD.";
            exit;
        }

        $sql = "UPDATE supplier_orders SET status='$newStatus', delivered_date='$deliveryDate' WHERE num=$orderId";
    } elseif ($newStatus === 'ongoing') {
        $sql = "UPDATE supplier_orders SET status='$newStatus', delivered_date=NULL WHERE num=$orderId";
    } else {
        echo "Error: Delivery date is required for delivered status.";
        exit;
    }

    if ($conn->query($sql)) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
