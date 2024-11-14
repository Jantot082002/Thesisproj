<?php
$conn = new mysqli('localhost', 'root', '', 'inventoryproj');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$query = $_GET['query'];
$sql = "SELECT * FROM products WHERE product_name LIKE '%" . $conn->real_escape_string($query) . "%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="list-group-item">';
        echo '<h5 class="mb-1">' . htmlspecialchars($row['product_name']) . '</h5>';
        echo '<p class="mb-1">Category: ' . htmlspecialchars($row['category']) . '</p>';
        echo '<p class="mb-1">Price: ' . htmlspecialchars($row['price']) . '</p>';
        echo '<p class="mb-1">Supplier: ' . htmlspecialchars($row['supplier']) . '</p>';
        echo '<p class="mb-1">Row: ' . htmlspecialchars($row['row_number']) . '</p>';
        echo '<p class="mb-1">Column: ' . htmlspecialchars($row['column_number']) . '</p>';
        echo '<p class="mb-1">Quantity: ' . htmlspecialchars($row['quantity']) . '</p>'; // Quantity
        echo '<p class="mb-1">Warehouse: ' . htmlspecialchars($row['warehouse']) . '</p>'; // Warehouse
        echo '<button onclick="editProduct(' . $row['id'] . ')" class="btn btn-sm btn-warning">Edit</button>';
        echo '<button onclick="deleteProduct(' . $row['id'] . ')" class="btn btn-sm btn-danger ml-2">Delete</button>';
        echo '</div>';
    }
} else {
    echo '<p>No products found.</p>';
}

$conn->close();
?>