<?php
// payment.php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include "../database/connection.php";
$user_id = (int)$_SESSION["user_id"];

// Fetch cart to calculate total
$query = "SELECT cart.quantity as cart_qty, product.price FROM cart JOIN product ON cart.product_id = product.id WHERE cart.user_id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    header("Location: cart.php"); // No items to pay for!
    exit();
}

$total_amount = 0;
while($row = mysqli_fetch_assoc($result)) {
    $total_amount += ($row['price'] * $row['cart_qty']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.4">
</head>
<body class="login-page">
    <div class="signup-card" style="max-width: 600px; width: 100%;">
        <h2>Secure Checkout</h2>
        <p style="text-align: center; color: var(--text-muted); margin-bottom: 2rem;">Complete your purchase for your selected vehicles</p>
        
        <form action="../controller/paymentController.php" method="POST">
            <h3 style="margin-top: 0; color: var(--primary); font-size: 1.125rem;">Billing Information</h3>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
            </div>

            <h3 style="margin-top: 2rem; color: var(--primary); font-size: 1.125rem;">Payment Method</h3>
            <div class="form-group">
                <select name="payment_method" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 0.5rem; background: var(--bg); color: var(--text); font-family: inherit; font-size: 1rem;">
                    <option value="Credit Card">Credit/Debit Card</option>
                    <option value="Mobile Money (MTN/Orange)">Mobile Money (MTN/Orange)</option>
                    <option value="Bank Transfer">Direct Bank Transfer</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            <div style="margin: 2rem 0; padding: 1.5rem; background: rgba(99, 102, 241, 0.1); border-radius: 0.5rem; text-align: center; border: 1px solid rgba(99, 102, 241, 0.2);">
                <span style="color: var(--text-muted); font-size: 1.125rem; display: block; margin-bottom: 0.5rem;">Total Amount to Pay:</span> 
                <span style="font-size: 2rem; font-weight: 800; color: var(--primary); display: block;"><?php echo number_format($total_amount, 2); ?> FCFA</span>
            </div>

            <button type="submit" name="submit_payment" style="font-size: 1.125rem; padding: 1rem; width: 100%;">Finalize Purchase</button>
            <a href="cart.php" class="link" style="color: var(--text-muted); display: block; text-align: center; margin-top: 1rem;">Return to Cart</a>
        </form>
    </div>
</body>
</html>
