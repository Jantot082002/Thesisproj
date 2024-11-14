<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'inventoryproj');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $id = $_POST['productId'];
    $mode = $_POST['formMode'];
    $productName = $_POST['productName'];

    if ($mode == 'edit' && !empty($id)) {
        // Update only the product name
        $stmt = $conn->prepare("UPDATE products SET product_name=? WHERE id=?");
        $stmt->bind_param("si", $productName, $id);

        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: Product.php?status=success&mode=update");
            exit();
        } else {
            // Redirect with error message
            header("Location: Product.php?status=error&mode=update");
            exit();
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>
