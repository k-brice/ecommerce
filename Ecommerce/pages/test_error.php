<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../database/connection.php";

$sqlCreateTable="CREATE TABLE IF NOT EXISTS cart(
    id int primary key not null auto_increment,
    user_id int not null,
    product_id int not null,
    quantity int not null default 1
)";
$res1 = mysqli_query($conn, $sqlCreateTable);
echo "Create Table Result: " . ($res1 ? 'Success' : mysqli_error($conn)) . "<br>";

$sqlInsert = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('1', '3', '1')";
$res2 = mysqli_query($conn, $sqlInsert);
echo "Insert Result: " . ($res2 ? 'Success' : mysqli_error($conn)) . "<br>";
?>
