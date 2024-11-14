<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
           width: 230px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #50B498;
            border-right: 1px solid #50B498;
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar-heading {
            text-align: center;
            padding-bottom: 0px;
        }
        .sidebar-logo {
            width: 320px;
            height: 250px;
            margin-left: -65px;
           margin-top: -90px;
        }
        .sidebar .list-group-item {
            border-radius: 0;
            background-color: #50B498;
            color: #fff;
        }
        .sidebar .list-group-item:hover {
            background-color: #4a9b8e;
            color: #fff;
        }
        .main-content {
            margin-left: 250px; 
            padding: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
            }
            .main-content {
                margin-left: 0;
            }
        }
  .navbar-brand {
    font-weight: bold;
    font-family: 'Arial', sans-serif;
    font-size: 24px;
    font-style: oblique;
    text-align: center;
    flex: 1;
    letter-spacing: 1px;
    line-height: 1.2;
    text-transform: uppercase;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    color: #ffffff;
    background-color: #50B498;
    padding: 10px;
    margin-left: 230px;
}

@media (max-width: 768px) {
    .navbar-brand {
        margin-left: 0;
        margin-right: 0;
        font-size: 18px; /* Reduce font size on mobile */
        padding: 5px; /* Adjust padding */
        width: 100%; /* Ensure it spans the full width */
    }
}
  
        .card-box {
            margin-bottom: 20px;
            text-align: center;
        }
        .card-box .card-body {
            padding: 20px;
        }
        @media (min-width: 768px) {
    #productList {
        padding-left: 15px;
        padding-right: 15px;
         margin-left: 1px;
    }
}

@media (max-width: 767.98px) {
    #productContainer {
        padding: 0;

    }
}
@media (max-width: 767.98px) {
    .button-section .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        font-size: 0.875rem; /* Adjust font size for better fit on small screens */
    }
}

@media (min-width: 768px) {
    .form-control {
        font-size: 1rem; /* Standard font size for larger screens */
    }
}
   .alert {
    padding: 15px;
    margin: 15px 0;
    border-radius: 5px;
    font-size: 16px;
    color: #fff;
    display: none; /* Hidden by default */
}
.alert.success {
    background-color: #4CAF50; /* Green */
}
.alert.error {
    background-color: #f44336; /* Red */
}

    </style>
</head>
<body>
    <!-- Navbar -->
 <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #50B498;">
        <a class="navbar-brand" href="#">Inventory Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </li>
                <li class="nav-item">
                   <b> <a class="nav-link" href="Login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<!-- Sidebar and Main Content -->
<div class="container-fluid">
  <div class="row">
    <div class="sidebar">
      <div class="sidebar-heading">
        <img src="founded.png" class="sidebar-logo" alt="Sidebar Logo">
      </div>
     <div class="list-group list-group-flush">
                    <a href="Dashboard.php" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="Product.php" class="list-group-item list-group-item-action"><i class="fas fa-box"></i> Products</a>
                    <a href="Categories.php" class="list-group-item list-group-item-action"><i class="fas fa-tags"></i> Categories</a>
                    <a href="Supplier.php" class="list-group-item list-group-item-action"><i class="fas fa-truck"></i> Suppliers</a>
                    <a href="#borrowerSubMenu" class="list-group-item list-group-item-action" data-toggle="collapse"><i class="fas fa-user-friends"></i> Borrow</a>
                    <div id="borrowerSubMenu" class="collapse">
                         <a href="borrower.php" class="list-group-item list-group-item-action pl-4"><i class="fas fa-user"></i> 
                         Submit Details</a>
                        <a href="borrow_item.php" class="list-group-item list-group-item-action pl-4"><i class="fas fa-hand-holding"></i> Borrow Item</a>
                       
                         <!--   <a href="purchase.php" class="list-group-item list-group-item-action pl-4">
                          <i class="fas fa-shopping-cart"></i> Purchase Item
                        </a> -->
                    </div>
                    <a href="Account.php" class="list-group-item list-group-item-action"><i class="fas fa-user-circle"></i> Account</a>
                    <a href="Order.php" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart"></i> Order</a>
                    <a href="stock.php" class="list-group-item list-group-item-action"><i class="fas fa-warehouse"></i> Stock</a>
                </div>
    </div>
 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
    <h3><b>Add Product</b></h3>
    <!-- Add Product Form -->
     <?php if ($_SESSION['role'] == 'admin'): ?>
    <div class="container mt-4" id="addProductForm">
        <?php if (isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?>">
                Product <?php echo $_GET['mode'] == 'update' ? 'updated' : 'added'; ?> successfully.
            </div>
        <?php endif; ?>
        
       <form id="productForm" method="post" action="edit-product.php">
    <input type="hidden" id="productId" name="productId">
    <input type="hidden" id="formMode" name="formMode" value="create">
    
    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
    </div>
    
    <!-- Other fields, which will be disabled in edit mode -->
    <div class="form-group">
        <label for="productQuantity">Quantity</label>
        <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="Enter quantity" required>
    </div>
    
    <div class="form-group">
        <label for="productCategory">Category</label>
        <select class="form-control" id="productCategory" name="productCategory" required>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'inventoryproj');
            if ($conn->connect_error) {
                die("Connection Failed: " . $conn->connect_error);
            }
            $sql = "SELECT category_name FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option>" . htmlspecialchars($row['category_name']) . "</option>";
                }
            } else {
                echo "<option>No categories available</option>";
            }
            $conn->close();
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="productPrice">Unit Price</label>
        <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="productSupplier">Supplier</label>
        <select class="form-control" id="productSupplier" name="productSupplier" required>
            <option value="">Select a supplier</option>
        </select>
    </div>

    <div class="form-group">
        <label for="warehouse">Warehouse</label>
        <select class="form-control" id="warehouse" name="warehouse" required>
            <option value="">Select a warehouse</option>
            <option value="Warehouse A">Warehouse A</option>
            <option value="Warehouse B">Warehouse B</option>
            <option value="Warehouse C">Warehouse C</option>
        </select>
    </div>

    <div class="form-group">
        <label for="rowNumber">Row</label>
        <input type="number" class="form-control" id="rowNumber" name="rowNumber" placeholder="Enter row number" required>
    </div>

    <div class="form-group">
        <label for="columnNumber">Column</label>
        <input type="number" class="form-control" id="columnNumber" name="columnNumber" placeholder="Enter column number" required>
    </div>

    <div class="form-group">
        <label for="expirationDate">Expiration Date</label>
        <input type="date" class="form-control" id="expirationDate" name="expirationDate" required>
    </div>

    <button type="submit" class="btn" style="background-color: #50B498; color: white;">Submit</button>
    <button type="button" class="btn" style="background-color: #50B498; color: white;" onclick="cancelForm()">Cancel</button>
</form>

    </div>
    <?php else: ?>
    <div class="container mt-4" id="addProductForm">
        <p>You do not have permission to add or search products.</p>
    </div>
    <?php endif; ?>

    <br>

    <!-- Buttons to toggle view and add product form -->
    <div class="container mt-4 button-section">
        <div class="form-group">
            <label for="warehouseSelect">Filter by Warehouse</label>
            <select class="form-control" id="warehouseSelect" name="warehouseSelect" required>
                <option value="">Select a warehouse</option>
                <option value="Warehouse A">Warehouse A</option>
                <option value="Warehouse B">Warehouse B</option>
                <option value="Warehouse C">Warehouse C</option>
            </select>
        </div>
       <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex flex-column flex-md-row">
                <button id="viewProductsBtn" class="btn mb-2 mb-md-0" style="background-color: #50B498; color: white;">View Products</button>
                <form id="searchForm" class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search products..." style="width: 100%; max-width: 160px;">
                    <button type="submit" class="btn ml-2" style="background-color: #50B498; color: white;">Search</button>
                </form>
            </div>
            <?php if ($_SESSION['role'] == 'admin'): ?>
            <button id="addProductBtn" class="btn mt-3 mt-md-0" style="background-color: #50B498; color: white;">Add Product</button>
            <?php endif; ?>
        </div>
    </div>
    <br> 

    <!-- Display Products -->
    <div class="container mt-4" id="productList" style="display:none;">
        <div class="row">
            <div class="col-12">
                <div class="list-group" id="productContainer">
                    <!-- Dynamic list of products will be inserted here -->
                </div>
            </div>
        </div>
    </div>
</main>
</div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script>
    document.getElementById('warehouseSelect').addEventListener('change', function() {
    const selectedWarehouse = this.value;

    if (selectedWarehouse) {
        fetch('view_products.php?warehouse=' + encodeURIComponent(selectedWarehouse))
            .then(response => response.text())
            .then(data => {
                document.getElementById('productContainer').innerHTML = data;
                document.getElementById('productList').style.display = 'block';
                document.getElementById('addProductForm').style.display = 'none';
            });
    }
});
  function fetchSuppliers() {
    fetch('get_suppliers.php')
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
      })
      .then(data => {
        console.log('Supplier data:', data); // Debugging: Check fetched data
        const supplierSelect = document.getElementById('productSupplier');
        supplierSelect.innerHTML = '<option value="">Select a supplier</option>';
        data.forEach(supplier => {
          const option = document.createElement('option');
          option.value = supplier.SupplierName; // Supplier name is used as the value
          option.textContent = `${supplier.SupplierName} `; // Supplier name and contact displayed
          supplierSelect.appendChild(option);
        });
      })
      .catch(error => console.error('Error fetching suppliers:', error));
  }

  document.addEventListener('DOMContentLoaded', fetchSuppliers);

  document.getElementById('viewProductsBtn').addEventListener('click', function() {
    document.getElementById('addProductForm').style.display = 'none';
    document.getElementById('productList').style.display = 'block';
    // Fetch and display products
    fetch('view_products.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('productContainer').innerHTML = data;
      });
  });

  document.getElementById('addProductBtn').addEventListener('click', function() {
    document.getElementById('productList').style.display = 'none';
    document.getElementById('addProductForm').style.display = 'block';
    document.getElementById('productForm').reset(); // Reset form for new product
    document.getElementById('productId').value = ''; // Clear hidden product ID

    // Make fields editable again for creating a new product
    document.getElementById('productCategory').readOnly = false;
    document.getElementById('productPrice').readOnly = false;
    document.getElementById('productSupplier').disabled = false;
    document.getElementById('warehouse').disabled = false;
    document.getElementById('rowNumber').readOnly = false;
    document.getElementById('columnNumber').readOnly = false;
    document.getElementById('productQuantity').readOnly = false;
    document.getElementById('expirationDate').readOnly = false;

    // Set the form mode to create
    document.getElementById('formMode').value = 'create';
});


document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const query = document.getElementById('searchInput').value;
    fetch('search_products.php?query=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(data => {
            document.getElementById('productContainer').innerHTML = data;
            document.getElementById('productList').style.display = 'block';
            document.getElementById('addProductForm').style.display = 'none';
        });
});

function editProduct(id) {
    fetch('get-product.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('productId').value = data.id;
                document.getElementById('productName').value = data.product_name;
                document.getElementById('productCategory').value = data.category;
                document.getElementById('productPrice').value = data.price;
                document.getElementById('productSupplier').value = data.supplier;
                document.getElementById('warehouse').value = data.warehouse;
                document.getElementById('rowNumber').value = data.row_number;
                document.getElementById('columnNumber').value = data.column_number;
                document.getElementById('productQuantity').value = data.quantity;

                // Set the form mode to edit
                document.getElementById('formMode').value = 'edit';

                // Make other fields read-only
                document.getElementById('productCategory').readOnly = true;
                document.getElementById('productPrice').readOnly = true;
                document.getElementById('productSupplier').disabled = true; // For select fields
                document.getElementById('warehouse').disabled = true; // For select fields
                document.getElementById('rowNumber').readOnly = true;
                document.getElementById('columnNumber').readOnly = true;
                document.getElementById('productQuantity').readOnly = true;
                document.getElementById('expirationDate').readOnly = true;

                // Show the form for editing and hide the product list
                document.getElementById('addProductForm').style.display = 'block';
                document.getElementById('productList').style.display = 'none';
            }
        });
}


  function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
      fetch('delete-product.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams('id=' + id)
      })
      .then(response => response.text())
      .then(data => {
        alert(data);
        document.getElementById('viewProductsBtn').click(); // Refresh product list
      });
    }
  }


 </script>
<script>
function cancelForm() {
    // Hide the form and possibly navigate back or reset the form
    document.getElementById('addProductForm').style.display = 'none';
    // If you want to reset the form fields, you can uncomment the next line
    // document.getElementById('productForm').reset();
}
</script>
</body>
</html>