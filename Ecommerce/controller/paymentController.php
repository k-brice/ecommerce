<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../pages/login.php");
    exit();
}

include "../database/connection.php";

$sqlCreateTable="CREATE TABLE IF NOT EXISTS payment(
    id int primary key not null auto_increment,
    user_id int not null,
    product_id int not null,
    quantity int not null,
    amount decimal(10,2) not null,
    payment_method varchar(50) default 'card'
)";
mysqli_query($conn, $sqlCreateTable);

if(isset($_POST['submit_payment'])) {
    $user_id = (int)$_SESSION["user_id"];
    $payment_method = isset($_POST['payment_method']) ? mysqli_real_escape_string($conn, $_POST['payment_method']) : 'Credit Card';
    
    // 1. Fetch entire user's cart
    $query = "SELECT cart.product_id, cart.quantity as cart_qty, product.price FROM cart JOIN product ON cart.product_id = product.id WHERE cart.user_id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) === 0) {
        header("Location: ../pages/cart.php");
        exit();
    }
    
    // 2. Loop through cart, insert into payment, update product inventory
    while($row = mysqli_fetch_assoc($result)) {
        $product_id = (int)$row['product_id'];
        $quantity = (int)$row['cart_qty'];
        $amount = $row['price'] * $quantity;
        
        // Insert Payment Record
        $sqlInsert = "INSERT INTO payment (user_id, product_id, quantity, amount, payment_method) VALUES ('$user_id', '$product_id', '$quantity', '$amount', '$payment_method')";
        mysqli_query($conn, $sqlInsert);
        
        // Update Inventory (Only decrease if stock is available to prevent negative stock)
        $sqlUpdateProduct = "UPDATE product SET quantity = quantity - $quantity WHERE id = $product_id AND quantity >= $quantity";
        mysqli_query($conn, $sqlUpdateProduct);
    }
    
    // 3. Clear the user's cart
    $sqlDeleteCart = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($conn, $sqlDeleteCart);
    
    // 4. Success Output
    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>";
    echo "<h2>Purchase Successful!</h2>";
    echo "<p>Your transaction via <strong>" . htmlspecialchars($payment_method) . "</strong> has been processed successfully.</p>";
    echo "<p>Your items will be prepared for delivery/pickup!</p>";
    echo "<a href='../pages/landing.php' style='display: inline-block; margin-top: 2rem; padding: 10px 20px; background-color: var(--primary, #4a90e2); color: white; text-decoration: none; border-radius: 5px;'>Return to Storefront</a>";
    echo "</div>";
} else {
    header("Location: ../pages/cart.php");
    exit();
}
?>
