<?php
include 'db_connect.php';

try {
    // Validate and sanitize 'id' to prevent SQL injection
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception("Invalid or missing ingredient ID.");
    }

    $id = (int) $_GET['id'];

    // Execute query
    $qry = $conn->query("SELECT * FROM ingredients WHERE id = $id");
    
    if (!$qry) {
        throw new Exception("Error fetching ingredient details: " . $conn->error);
    }

    // Fetch query result
    $result = $qry->fetch_array();
    if (!$result) {
        throw new Exception("Ingredient not found.");
    }

    // Assign fetched values to variables
    foreach ($result as $k => $v) {
        $$k = $v;
    }

    include 'new_ingredients.php';

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
}
?>
