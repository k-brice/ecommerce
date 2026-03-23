<?php
@session_start();
include_once "../database/connection.php";

$sqlCreateTable="CREATE TABLE IF NOT EXISTS cart(
    id int primary key not null auto_increment,
    user_id int not null,
    product_id int not null,
    quantity int not null default 1
)";
mysqli_query($conn, $sqlCreateTable);

if(isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION["user_id"])) {
        header("Location: ../pages/login.php");
        exit();
    }
    
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 1;
    $user_id = (int)$_SESSION["user_id"]; 
    $quantity = 1;

    // Check if item already in cart
    $sqlCheck = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        $sqlUpdate = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id";
        mysqli_query($conn, $sqlUpdate);
    } else {
        $sqlInsert = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
        mysqli_query($conn, $sqlInsert);
    }
    header("Location: ../pages/cart.php");
    exit();
}
?>
