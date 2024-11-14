<?php
header('Content-Type: text/html; charset=utf-8');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'inventoryproj');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Get the selected warehouse from the query string
$warehouseFilter = isset($_GET['warehouse']) ? $_GET['warehouse'] : '';

// Fetch products with optional warehouse filter, ordered by created_at (FIFO)
$sql = "SELECT * FROM products";
if (!empty($warehouseFilter)) {
    $sql .= " WHERE warehouse = ?";
}
$sql .= " ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
if (!empty($warehouseFilter)) {
    $stmt->bind_param('s', $warehouseFilter);
}
$stmt->execute();
$result = $stmt->get_result();

echo '<h2>Products</h2>';
if ($result->num_rows > 0) {
    echo '<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit Price</th>
                        <th>Supplier</th>
                        <th>Warehouse</th>
                        <th>Row</th>
                        <th>Column</th>
                        <th>Current Quantity</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
    while ($row = $result->fetch_assoc()) {
        // Check for expiration
        $expirationDate = $row['expiration_date'];
        $currentDate = date('Y-m-d');
        if ($expirationDate && $expirationDate < $currentDate) {
            // Insert expired item into another table (if not already there)
            $insertExpiredSql = "INSERT INTO expired_products (product_name, category, price, supplier, warehouse, row_number, column_number, quantity, created_at, expiration_date)
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                                 ON DUPLICATE KEY UPDATE product_name = product_name"; // Prevent duplicate insertion
            $stmt = $conn->prepare($insertExpiredSql);
            $stmt->bind_param('ssssiiisss', $row['product_name'], $row['category'], $row['price'], $row['supplier'], $row['warehouse'], $row['row_number'], $row['column_number'], $row['quantity'], $row['created_at'], $row['expiration_date']);
            $stmt->execute();
        }

        // Determine color based on current quantity
        $quantity = $row['quantity'];
        if ($quantity > 50) {
            $statusColor = 'green';
            $statusText = 'In Stock';
        } elseif ($quantity > 1) {
            $statusColor = 'orange';
            $statusText = 'Low Stock';
        } else {
            $statusColor = 'red';
            $statusText = 'Out of Stock';
        }

        echo '<tr>
                <td>' . htmlspecialchars($row['product_name']) . '</td>
                <td>' . htmlspecialchars($row['category']) . '</td>
                <td>' . htmlspecialchars($row['price']) . '</td>
                <td>' . htmlspecialchars($row['supplier']) . '</td>
                <td>' . htmlspecialchars($row['warehouse']) . '</td>
                <td>' . htmlspecialchars($row['row_number']) . '</td>
                <td>' . htmlspecialchars($row['column_number']) . '</td>
                <td>' . htmlspecialchars($row['quantity']) . '</td>
                <td style="color: ' . $statusColor . ';">' . $statusText . '</td>
                <td>' . htmlspecialchars($row['created_at']) . '</td>
                <td>' . htmlspecialchars($row['expiration_date']) . '</td>
                <td>
                    <button class="btn btn-sm" style="background-color: #4b9a7f; color:white;" onclick="editProduct(' . $row['id'] . ')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(' . $row['id'] . ')">Delete</button>
                </td>
            </tr>';
    }
    echo '  </tbody>
         </table>
         </div>';
} else {
    echo '<p>No products found.</p>';
}

// Fetch expired products ordered by created_at (FIFO)
$sqlExpired = "SELECT * FROM expired_products ORDER BY created_at ASC";
$resultExpired = $conn->query($sqlExpired);

echo '<h2>Expired Products</h2>';
if ($resultExpired->num_rows > 0) {
    echo '<div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit Price</th>
                        <th>Supplier</th>
                        <th>Row</th>
                        <th>Column</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Expiration Date</th>
                    </tr>
                </thead>
                <tbody>';
    while ($row = $resultExpired->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['product_name']) . '</td>
                <td>' . htmlspecialchars($row['category']) . '</td>
                <td>' . htmlspecialchars($row['price']) . '</td>
                <td>' . htmlspecialchars($row['supplier']) . '</td>
                <td>' . htmlspecialchars($row['row_number']) . '</td>
                <td>' . htmlspecialchars($row['column_number']) . '</td>
                <td>' . htmlspecialchars($row['quantity']) . '</td>
                <td>' . htmlspecialchars($row['created_at']) . '</td>
                <td>' . htmlspecialchars($row['expiration_date']) . '</td>
            </tr>';
    }
    echo '  </tbody>
         </table>
         </div>';
} else {
    echo '<p>No expired products found.</p>';
}

$conn->close();
?>