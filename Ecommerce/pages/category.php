<?php
// category.php
include "../database/connection.php";

// Fetch categories
$catQuery = "SELECT * FROM category ORDER BY name ASC";
$catResult = mysqli_query($conn, $catQuery);

// Fetch products based on selected category
$active_cat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($active_cat > 0) {
    $query = "SELECT * FROM product WHERE category_id = $active_cat ORDER BY id DESC";
} else {
    $query = "SELECT * FROM product ORDER BY id DESC";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.2">
</head>
<body class="landing-page">
    <nav class="navbar">
        <div class="logo">
            <h1>ManG Cars</h1>
        </div>
        <div class="menu-toggle" onclick="document.querySelector('.options').classList.toggle('active')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </div>
        <div class="options">
            <a href="landing.php">Home</a>
            <a href="products.php">Cars</a>
            <a href="category.php" style="color: var(--primary);">Categories</a>
            <a href="cart.php">Cart</a>
        </div>
    </nav>

    <div class="products-container">
        <div class="page-header">
            <h2>Shop by Category</h2>
            <p>Find the exact body style that suits your needs.</p>
        </div>

        <div class="category-filters" style="display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 1rem; justify-content: center;">
            <a href="category.php" class="filter-btn <?php echo ($active_cat === 0) ? 'active' : ''; ?>" style="text-decoration: none;">All Cars</a>
            <?php 
            if($catResult && mysqli_num_rows($catResult) > 0) {
                while($cat = mysqli_fetch_assoc($catResult)) {
                    $isActive = ($active_cat === (int)$cat['id']) ? 'active' : '';
                    echo '<a href="category.php?id=' . $cat['id'] . '" class="filter-btn ' . $isActive . '" style="text-decoration: none;">' . htmlspecialchars($cat['name']) . '</a>';
                }
            }
            ?>
        </div>

        <div class="product-grid">
            <?php 
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $image = !empty($row['image']) ? $row['image'] : '../assets/image/GT.jpg';
            ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="" style="width:100%; height:100%; object-fit:cover;">
                </div>
                <div class="product-info">
                    <h3 class="product-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                    <div class="product-price"><?php echo number_format($row['price'], 2); ?> FCFA</div>
                    <p class="product-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                    <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" style="text-align: center; display: block;">View Details</a>
                </div>
            </div>
            <?php 
                }
            } else {
                echo "<p style='grid-column: 1 / -1; text-align: center; color: var(--text-muted); padding: 2rem;'>No products available in this category.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
