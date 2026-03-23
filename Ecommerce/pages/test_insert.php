<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$_SESSION["user_id"] = 1; // Fake login
$_POST['add_to_cart'] = '1';
$_POST['product_id'] = '3'; // using an existing product

include "../controller/cartController.php";
echo "Done";
