<?php
header('Content-Type: text/html; charset=utf-8');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'inventoryproj');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
// Fetch expired products ordered by created_at (FIFO)
$sqlExpired = "SELECT * FROM expired_products ORDER BY created_at ASC";
$resultExpired = $conn->query($sqlExpired);

echo '<h2>Expired Products</h2>';
if ($resultExpired->num_rows > 0) {
    echo '<table class="table table-striped">
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
                    <th>Created At</th>
                    <th>Expiration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $resultExpired->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['product_name']) . '</td>
                <td>' . htmlspecialchars($row['category']) . '</td>
                <td>' . htmlspecialchars($row['price']) . '</td>
                <td>' . htmlspecialchars($row['supplier']) . '</td>
                <td>' . htmlspecialchars($row['warehouse']) . '</td>
                <td>' . htmlspecialchars($row['row_number']) . '</td>
                <td>' . htmlspecialchars($row['column_number']) . '</td>
                <td>' . htmlspecialchars($row['quantity']) . '</td>
                <td>' . htmlspecialchars($row['created_at']) . '</td>
                <td>' . htmlspecialchars($row['expiration_date']) . '</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editProduct(' . $row['id'] . ')">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteProduct(' . $row['id'] . ')">Delete</button>
                </td>
            </tr>';
    }
    echo '  </tbody>
         </table>';
} else {
    echo '<p>No expired products found.</p>';
}

$conn->close();
?>