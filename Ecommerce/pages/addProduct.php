<?php
session_start();
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    // Redirect if not admin
    header("Location: landing.php");
    exit();
}
include "../database/connection.php";
$catQuery = "SELECT * FROM category ORDER BY name ASC";
$catResult = mysqli_query($conn, $catQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.2">
</head>
<body class="login-page">
    <div class="signup-card" style="max-width: 600px; width: 100%;">
        <h2>Add New Car</h2>
        <form action="../controller/productController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="add_product" value="1">
            <div class="form-group">
                <label>Car Name / Model</label>
                <input type="text" name="name" required placeholder="2024 Luxury Model">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" required placeholder="Brief description of the vehicle...">
            </div>
            <div class="form-group">
                <label>Vehicle Category</label>
                <select name="category_id" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; background: var(--bg); color: var(--text); font-family: inherit;">
                    <option value="">-- Select a Category --</option>
                    <?php 
                    if($catResult && mysqli_num_rows($catResult) > 0) {
                        while($cat = mysqli_fetch_assoc($catResult)) {
                            echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Price (FCFA)</label>
                    <input type="number" step="0.01" name="price" required placeholder="50000.00">
                </div>
                <div class="form-group">
                    <label>Inventory Quantity</label>
                    <input type="number" name="quantity" required value="1">
                </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label>Car Image (Upload Local File)</label>
                <input type="file" name="image_file" accept="image/*" style="padding: 0.5rem;">
            </div>
            <div class="form-group">
                <label>Or Image URL (Online)</label>
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg">
            </div>
            <button type="submit" name="submit">Add Product to Inventory</button>
            <a href="manageProducts.php" class="link" style="color: var(--text-muted); display: block; text-align: center; margin-top: 1rem;">Cancel and Return</a>
        </form>
    </div>
</body>
</html>
