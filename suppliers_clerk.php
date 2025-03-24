<?php
include 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch suppliers
$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Calibri', sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: black; /* Changed to black for visibility */
        }
        td {
            background-color: #ffffff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-dropdown {
            cursor: pointer;
            text-align: center;
        }
        .add-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 30px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .add-button:hover {
            background-color: #218838;
        }
        .modal-header, .modal-body {
            text-align: center;
        }
        .modal-title {
            font-size: 1.5rem;
        }
        .btn-flat {
            border-radius: 50px;
        }
        .dropdown-menu {
            padding: 10px;
        }
        .dropdown-item {
            font-weight: normal;
        }
    </style>
</head>
<body>
    <h1>Supplier Management</h1>
    <div class="container">
        <div class="card">
            
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Supplier Name</th>
                            <th>Contact Number</th>
                            <th>Ingredient</th>
                            <th>Current Price</th>
                            <th>Measurement</th>
                            <th>Performance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $suppliers->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['num'] ?></td>
                            <td><?= $row['supplier_name'] ?></td>
                            <td><?= $row['contact_number'] ?></td>
                            <td><?= $row['supplier_ingredient'] ?></td>
                            <td><?= $row['current_price'] ?></td>
                            <td><?= $row['measurement'] ?></td>
                            <td><?= str_repeat("★", $row['supplier_performance']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="modal" class="modal" tabindex="-1" style="display:none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="modal-form" method="POST" action="supplier_actions.php">
                        <input type="hidden" name="id" id="supplier-id">
                        <div class="mb-3">
                            <label for="supplier-code" class="form-label">Code:</label>
                            <input type="text" class="form-control" name="code" id="supplier-code" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-name" class="form-label">Name:</label>
                            <input type="text" class="form-control" name="name" id="supplier-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-contact" class="form-label">Contact:</label>
                            <input type="text" class="form-control" name="contact" id="supplier-contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-ingredient" class="form-label">Ingredient:</label>
                            <input type="text" class="form-control" name="ingredient" id="supplier-ingredient" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-price" class="form-label">Price:</label>
                            <input type="number" class="form-control" name="price" id="supplier-price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-measurement" class="form-label">Measurement:</label>
                            <input type="text" class="form-control" name="measurement" id="supplier-measurement" required>
                        </div>
                        <div class="mb-3">
                            <label for="supplier-performance" class="form-label">Performance:</label>
                            <select name="performance" class="form-select" id="supplier-performance" required>
                                <option value="1">★</option>
                                <option value="2">★★</option>
                                <option value="3">★★★</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>

<?php $conn->close(); ?>
