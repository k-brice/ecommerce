<?php
// cart.php
include "../controller/cartController.php";

if (!isset($_SESSION["user_id"])) {
    $user_id = 0;
    $result = false;
} else {
    $user_id = (int)$_SESSION["user_id"];
    $query = "SELECT cart.id as cart_id, cart.quantity as cart_qty, product.* FROM cart JOIN product ON cart.product_id = product.id WHERE cart.user_id = $user_id";
    $result = mysqli_query($conn, $query);
}
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - ManG Cars</title>
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
            <a href="cart.php" style="color: var(--primary);">Cart</a>
        </div>
    </nav>

    <div class="products-container" style="max-width: 900px;">
        <div class="page-header" style="text-align: left;">
            <h2>Your Shopping Cart</h2>
            <p>Review the vehicles you've selected before proceeding to payment.</p>
        </div>

        <div class="cart-table-wrapper">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $subtotal = $row['price'] * $row['cart_qty'];
                            $total += $subtotal;
                            $image = !empty($row['image']) ? $row['image'] : '../assets/image/GT.jpg';
                    ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 50px; height: 50px; background: var(--surface-light); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; overflow:hidden;">
                                    <img src="<?php echo htmlspecialchars($image); ?>" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--text);"><?php echo htmlspecialchars($row['name']); ?></div>
                                    <div style="font-size: 0.875rem; color: var(--text-muted);"><?php echo htmlspecialchars(substr($row['description'], 0, 30)); ?>...</div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo number_format($row['price'], 2); ?> FCFA</td>
                        <td><?php echo $row['cart_qty']; ?></td>
                        <td><?php echo number_format($subtotal, 2); ?> FCFA</td>
                        <td><a href="#" style="color: #ef4444; text-decoration: none; font-size: 0.875rem;">Remove</a></td>
                    </tr>
                    <?php
                        }
                    } else {
                        if (isset($user_id) && $user_id === 0) {
                            echo "<tr><td colspan='5' style='text-align: center; padding: 3rem;'>
                                <div style='margin-bottom: 1rem; color: var(--text-muted);'>You must be logged in to access your saved cart.</div>
                                <a href='login.php' class='btn btn-primary' style='display: inline-block;'>Login to your account</a>
                            </td></tr>";
                        } else {
                            echo "<tr><td colspan='5' style='text-align: center; padding: 2rem;'>Your cart is empty.</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            
            <div class="cart-total">
                Total: <span style="color: var(--primary);"><?php echo number_format($total, 2); ?> FCFA</span>
            </div>
            
            <div style="text-align: right;">
                <a href="payment.php" class="btn btn-primary" style="display: inline-block; padding: 1rem 3rem;">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</body>
</html>
