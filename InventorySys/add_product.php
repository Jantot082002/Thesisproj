<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'inventoryproj');
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // Get form data
    $productName = $conn->real_escape_string($_POST['productName']);
    $productCategory = $conn->real_escape_string($_POST['productCategory']);
    $productPrice = $conn->real_escape_string($_POST['productPrice']);
    $productSupplier = $conn->real_escape_string($_POST['productSupplier']);
    $warehouse = $conn->real_escape_string($_POST['warehouse']);
    $rowNumber = $conn->real_escape_string($_POST['rowNumber']);
    $columnNumber = $conn->real_escape_string($_POST['columnNumber']);
    $productQuantity = $conn->real_escape_string($_POST['productQuantity']);
    $expirationDate = $conn->real_escape_string($_POST['expirationDate']);

    // Check if the same warehouse, row, and column combination already exists
    $checkSql = "SELECT * FROM products WHERE warehouse = '$warehouse' AND row_number = '$rowNumber' AND column_number = '$columnNumber'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        echo "A product already exists in the specified warehouse, row, and column. Please choose a different location.";
    } else {
        // Insert product into database
        $sql = "INSERT INTO products (product_name, category, price, supplier, warehouse, row_number, column_number, quantity, expiration_date)
                VALUES ('$productName', '$productCategory', '$productPrice', '$productSupplier', '$warehouse', '$rowNumber', '$columnNumber', '$productQuantity', '$expirationDate')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully";

            // Deduct the quantity from the orders table
            // Fetch orders with the same product name and 'Received' status
            $fetchOrderSql = "SELECT id, quantity FROM orders WHERE product_name = '$productName' AND status = 'Received'";
            $orderResult = $conn->query($fetchOrderSql);

            $remainingQuantity = $productQuantity;

            // Deduct the quantity from each order until the remaining quantity is zero
            while ($orderRow = $orderResult->fetch_assoc()) {
                $orderId = $orderRow['id'];
                $orderQuantity = $orderRow['quantity'];

                if ($remainingQuantity >= $orderQuantity) {
                    // Deduct the full quantity of this order
                    $updateOrderSql = "UPDATE orders SET quantity = 0 WHERE id = ?";
                    $stmt = $conn->prepare($updateOrderSql);
                    $stmt->bind_param('i', $orderId);
                    $stmt->execute();
                    $stmt->close();
                    $remainingQuantity -= $orderQuantity;
                } else {
                    // Partially deduct from this order
                    $updateOrderSql = "UPDATE orders SET quantity = quantity - ? WHERE id = ?";
                    $stmt = $conn->prepare($updateOrderSql);
                    $stmt->bind_param('ii', $remainingQuantity, $orderId);
                    $stmt->execute();
                    $stmt->close();
                    $remainingQuantity = 0;
                    break; // Exit the loop as we've deducted the full amount needed
                }

                if ($remainingQuantity <= 0) {
                    break; // Exit the loop if no remaining quantity
                }
            }

            if ($remainingQuantity > 0) {
                echo " but there was not enough stock to deduct the full quantity. Remaining quantity not deducted.";
            } else {
                echo " and stock updated successfully.";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>