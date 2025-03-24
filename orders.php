<?php
include 'db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch supplier orders
$orders = $conn->query("SELECT * FROM supplier_orders");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Order Tracking</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            text-align: center;
            color: black;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-dropdown {
            width: 100%;
            padding: 5px;
        }

        .status-delivered {
            background-color: #d4edda !important;
            color: #155724 !important;
        }

        .status-ongoing {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }

        .mode-select {
            width: 200px;
            margin: 10px auto;
            padding: 5px;
            display: block;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Orders Tracking</h1>

    <!-- Mode Selection -->
    <select id="updateMode" class="mode-select">
        <option value="auto">Auto Date</option>
        <option value="prompt">Prompt Date</option>
    </select>

    <table>
        <tr>
            <th>Num</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Delivered Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $orders->fetch_assoc()): ?>
            <tr class="<?= $row['status'] === 'delivered' ? 'status-delivered' : 'status-ongoing' ?>">
                <td><?= $row['num'] ?></td>
                <td><?= $row['order_id'] ?></td>
                <td>
                    <select class="status-dropdown" onchange="updateStatus(<?= $row['num'] ?>, this.value)">
                        <option value="delivered" <?= $row['status'] === 'delivered' ? 'selected' : '' ?> class="status-delivered">Delivered</option>
                        <option value="ongoing" <?= $row['status'] === 'ongoing' ? 'selected' : '' ?> class="status-ongoing">Ongoing</option>
                    </select>
                </td>
                <td><?= $row['order_date'] ?></td>
                <td><?= $row['delivered_date'] ?: 'N/A' ?></td>
                <td>
                    <button onclick="viewOrder(<?= $row['num'] ?>)">View</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Order Details</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div id="orderDetails"></div>
        </div>
    </div>

    <script>
        function viewOrder(orderId) {
            const modal = document.getElementById('orderModal');
            const orderDetails = document.getElementById('orderDetails');

            // Fetch order details
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch_order_details.php?orderId=${orderId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    orderDetails.innerHTML = xhr.responseText;
                    modal.style.display = 'block';
                }
            };
            xhr.send();
        }

        function closeModal() {
            document.getElementById('orderModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('orderModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>

    <script>
        function updateStatus(orderId, newStatus) {
            const updateMode = document.getElementById('updateMode').value;

            if (newStatus === 'delivered') {
                if (updateMode === 'prompt') {
                    let deliveryDate;
                    while (true) {
                        deliveryDate = prompt("Enter the delivery date (YYYY-MM-DD):");
                        if (!deliveryDate) {
                            alert("Delivery date is required for delivered status.");
                            location.reload();
                            return;
                        }

                        const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
                        if (!dateRegex.test(deliveryDate)) {
                            alert("Invalid date format. Please enter the date in YYYY-MM-DD format.");
                            continue;
                        }

                        const isValidDate = !isNaN(Date.parse(deliveryDate));
                        if (!isValidDate) {
                            alert("Invalid date. Please enter a valid date in YYYY-MM-DD format.");
                            continue;
                        }

                        break;
                    }

                    sendStatusUpdate(orderId, newStatus, deliveryDate);
                } else if (updateMode === 'auto') {
                    const currentDate = new Date().toISOString().split('T')[0];
                    sendStatusUpdate(orderId, newStatus, currentDate);
                }
            } else {
                sendStatusUpdate(orderId, newStatus, null);
            }
        }

        function sendStatusUpdate(orderId, newStatus, deliveryDate = null) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update_order_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Status updated successfully!");
                    location.reload();
                }
            };
            xhr.send(`orderId=${orderId}&newStatus=${newStatus}&deliveryDate=${deliveryDate}`);
        }
    </script>
</body>

</html>

<?php $conn->close(); ?>