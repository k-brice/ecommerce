<?php
// product_details.php
include "../database/connection.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$query = "SELECT * FROM product WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    $product = [
        'name' => 'Product Not Found',
        'price' => 0,
        'description' => 'This product does not exist.',
        'image' => ''
    ];
}
$image = !empty($product['image']) ? $product['image'] : '../assets/image/GT.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details - ManG Cars</title>
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
            <a href="category.php">Categories</a>
            <a href="cart.php">Cart</a>
        </div>
    </nav>

    <div class="product-detail-container">
        <!-- Left Side: Image -->
        <div class="product-detail-image">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="" style="width:100%; height:100%; object-fit:cover;"> 
       </div>

        <!-- Right Side: Details -->
        <div class="product-detail-info">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <div class="product-detail-price"><?php echo number_format($product['price'], 2); ?> FCFA</div>
            
            <p style="color: var(--text-muted); font-size: 1.125rem; line-height: 1.6; margin-bottom: 2rem;">
                <?php echo htmlspecialchars($product['description']); ?>
            </p>

            <div class="spec-grid">
                <div class="spec-item">
                    <div class="spec-label">Engine</div>
                    <div class="spec-val">4.0L V8 Twin-Turbo</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Transmission</div>
                    <div class="spec-val">8-Speed Automatic</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Mileage</div>
                    <div class="spec-val">0 miles (New)</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Drivetrain</div>
                    <div class="spec-val">All-Wheel Drive</div>
                </div>
            </div>

            <form action="cart.php" method="POST" style="margin-top: 2rem;">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button type="submit" name="add_to_cart" style="padding: 1rem; font-size: 1.125rem;">Add to Cart</button>
            </form>
        </div>
    </div>
</body>
</html>
