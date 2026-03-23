<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "../database/connection.php";

echo "Session User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NOT SET') . "<br>";

$res = mysqli_query($conn, "SELECT * FROM cart");
echo "Cart Table (" . mysqli_num_rows($res) . " rows):<br>";
while($row = mysqli_fetch_assoc($res)) {
    print_r($row); echo "<br>";
}

$res = mysqli_query($conn, "SELECT id, name FROM product");
if($res) {
    echo "Product Table (" . mysqli_num_rows($res) . " rows):<br>";
    while($row = mysqli_fetch_assoc($res)) {
        print_r($row); echo "<br>";
    }
} else {
    echo "Product query failed: " . mysqli_error($conn);
}
?>
