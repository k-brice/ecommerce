<?php
session_start();
include "../database/connection.php";

// Ensure the product table exists before we try to save to it
$sqlCreateTable="CREATE TABLE IF NOT EXISTS product(
    id int primary key not null auto_increment,
    name varchar(100) not null,
    description text,
    price decimal(10,2) not null,
    category_id int,
    quantity int not null default 0,
    image varchar(255)
)";
mysqli_query($conn, $sqlCreateTable);

if(isset($_POST["add_product"]) || isset($_POST["submit"])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category_id = isset($_POST["category_id"]) ? (int)$_POST["category_id"] : NULL;
        
        $imagePath = "";
        
        if(!empty($_POST['image_url'])) {
            $imagePath = mysqli_real_escape_string($conn, $_POST['image_url']);
        }
        
        if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $targetDir = "../assets/image/";
            if(!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $fileName = time() . '_' . basename($_FILES["image_file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            
            if(move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFilePath)) {
                $imagePath = $targetFilePath;
            }
        }

        $catVal = $category_id ? $category_id : "NULL";
        $sqlInsert = "INSERT INTO product (name, description, price, quantity, category_id, image) VALUES ('$name', '$description', '$price', '$quantity', $catVal, '$imagePath')";
        if(mysqli_query($conn, $sqlInsert)){
            header("Location: ../pages/manageProducts.php");
            exit();
        } else {
            echo "Failed to add product: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access. Only admins can add products.";
    }
}

if(isset($_POST["delete_product"])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $product_id = (int)$_POST["product_id"];
        $sqlDelete = "DELETE FROM product WHERE id = $product_id";
        if(mysqli_query($conn, $sqlDelete)) {
            header("Location: ../pages/manageProducts.php");
            exit();
        } else {
            echo "Failed to delete product: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";
    }
}

if(isset($_POST["edit_product"])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $product_id = (int)$_POST["product_id"];
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $category_id = isset($_POST["category_id"]) ? (int)$_POST["category_id"] : NULL;
        $categoryUpdate = $category_id ? ", category_id=$category_id" : ", category_id=NULL";
        
        $imageUpdate = "";
        
        if(!empty($_POST['image_url'])) {
            $url = mysqli_real_escape_string($conn, $_POST['image_url']);
            $imageUpdate = ", image='$url'";
        }
        
        if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
            $targetDir = "../assets/image/";
            if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $fileName = time() . '_' . basename($_FILES["image_file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            if(move_uploaded_file($_FILES["image_file"]["tmp_name"], $targetFilePath)) {
                $imageUpdate = ", image='$targetFilePath'";
            }
        }

        $sqlUpdate = "UPDATE product SET name='$name', description='$description', price='$price', quantity='$quantity' $categoryUpdate $imageUpdate WHERE id=$product_id";
        if(mysqli_query($conn, $sqlUpdate)){
            header("Location: ../pages/manageProducts.php");
            exit();
        } else {
            echo "Failed to update product: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";
    }
}
?>
