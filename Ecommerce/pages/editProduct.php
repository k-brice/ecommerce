<?php
session_start();
// Check if admin is doing this
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    header("Location: landing.php");
    exit();
}

include "../database/connection.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = "SELECT * FROM product WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

$catQuery = "SELECT * FROM category ORDER BY name ASC";
$catResult = mysqli_query($conn, $catQuery);

if (!$product) {
    echo "<div style='text-align:center; padding:50px;'><h2>Product Not Found</h2></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.2">
</head>
<body class="login-page">
    <div class="signup-card" style="max-width: 600px; width: 100%;">
        <h2>Edit Car Details</h2>
        <form action="../controller/productController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_product" value="1">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            
            <div class="form-group">
                <label>Car Name / Model</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" required value="<?php echo htmlspecialchars($product['description']); ?>">
            </div>
            
            <div class="form-group">
                <label>Vehicle Category</label>
                <select name="category_id" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; background: var(--bg); color: var(--text); font-family: inherit;">
                    <option value="">-- Select a Category --</option>
                    <?php 
                    if($catResult && mysqli_num_rows($catResult) > 0) {
                        while($cat = mysqli_fetch_assoc($catResult)) {
                            $selected = ($cat['id'] == $product['category_id']) ? 'selected' : '';
                            echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . htmlspecialchars($cat['name']) . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>Price (FCFA)</label>
                    <input type="number" step="0.01" name="price" required value="<?php echo $product['price']; ?>">
                </div>
                <div class="form-group">
                    <label>Inventory Quantity</label>
                    <input type="number" name="quantity" required value="<?php echo $product['quantity']; ?>">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 1rem;">
                <label>Update Car Image (Upload Local File) - Leave empty to keep existing</label>
                <input type="file" name="image_file" accept="image/*" style="padding: 0.5rem;">
            </div>
            <div class="form-group">
                <label>Or Image URL (Online) - Leave empty to keep existing</label>
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg">
            </div>
            
            <button type="submit" name="submit">Update Product</button>
            <a href="manageProducts.php" class="link" style="color: var(--text-muted);">Cancel and Return</a>
        </form>
    </div>
</body>
</html>
