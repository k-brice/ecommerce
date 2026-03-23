<?php
session_start();
// Check if admin is doing this
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    header("Location: landing.php");
    exit();
}

include "../database/connection.php";
$query = "SELECT product.*, category.name AS category_name FROM product LEFT JOIN category ON product.category_id = category.id ORDER BY product.id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.3">
</head>
<body class="landing-page">
    <nav class="navbar">
        <div class="logo">
            <h1>ManG Cars Admin</h1>
        </div>
        <div class="menu-toggle" onclick="document.querySelector('.options').classList.toggle('active')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </div>
        <div class="options">
            <a href="Dashboard.php">Dashboard</a>
            <a href="manageProducts.php" style="color: var(--primary);">Manage Products</a>
            <a href="manageCategories.php">Manage Categories</a>
            <a href="landing.php" class="btn-login">Storefront</a>
        </div>
    </nav>

    <div class="products-container" style="max-width: 1200px;">
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div style="text-align: left;">
                <h2 style="margin: 0;">Inventory Management</h2>
                <p style="margin: 0.5rem 0 0 0;">View, edit, and delete vehicles from the catalog.</p>
            </div>
            <a href="addProduct.php" class="btn btn-primary" style="display: inline-block;">Add New Product</a>
        </div>

        <div class="cart-table-wrapper" style="margin-top: 2rem;">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $image = !empty($row['image']) ? $row['image'] : '../assets/image/GT.jpg';
                    ?>
                    <tr>
                        <td>
                            <div style="width: 60px; height: 60px; background: var(--surface-light); border-radius: 0.5rem; overflow:hidden;">
                                <img src="<?php echo htmlspecialchars($image); ?>" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        </td>
                        <td style="font-weight: 600; color: var(--text);"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><span style="background: rgba(99, 102, 241, 0.1); color: var(--primary); padding: 0.25rem 0.5rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;"><?php echo isset($row['category_name']) ? htmlspecialchars($row['category_name']) : 'Uncategorized'; ?></span></td>
                        <td><?php echo number_format($row['price'], 2); ?> FCFA</td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>
                            <div style="display: flex; gap: 1rem; align-items: center;">
                                <a href="editProduct.php?id=<?php echo $row['id']; ?>" style="color: var(--primary); text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                                <form action="../controller/productController.php" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <input type="hidden" name="delete_product" value="1">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" style="background: none; border: none; color: #ef4444; font-size: 0.875rem; font-weight: 500; cursor: pointer; padding: 0;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center; padding: 2rem;'>No products found in inventory.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
