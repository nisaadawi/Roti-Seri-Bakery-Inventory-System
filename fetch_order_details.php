<?php
include 'db_connect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['orderId'])) {
    $orderId = $conn->real_escape_string($_GET['orderId']);
    $query = "SELECT * FROM supplier_orders WHERE num = $orderId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>Order ID: " . $row['order_id'] . "</p>";
        echo "<p>Supplier Code: " . $row['supplier_code'] . "</p>";
        echo "<p>Supplier Name: " . $row['supplier_name'] . "</p>";
        echo "<p>Ingredient: " . $row['ingredient'] . "</p>";
        echo "<p>Price: " . $row['price'] . "</p>";
        echo "<p>Quantity: " . $row['quantity'] . "</p>";
        echo "<p>Order Date: " . $row['order_date'] . "</p>";
        echo "<p>Delivered Date: " . ($row['delivered_date'] ?: 'N/A') . "</p>";
    } else {
        echo "<p>No order details found.</p>";
    }
}

$conn->close();
?>
