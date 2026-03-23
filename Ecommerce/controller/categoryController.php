<?php
session_start();
include_once "../database/connection.php";

$sqlCreateTable="CREATE TABLE IF NOT EXISTS category(
    id int primary key not null auto_increment,
    name varchar(100) not null,
    description text
)";
mysqli_query($conn, $sqlCreateTable);

if(isset($_POST['add_category'])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $sqlInsert = "INSERT INTO category (name, description) VALUES ('$name', '$description')";
        if(mysqli_query($conn, $sqlInsert)) {
            header("Location: ../pages/manageCategories.php");
            exit();
        } else {
            echo "Failed to add category: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";
    }
}

if(isset($_POST['edit_category'])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $category_id = (int)$_POST['category_id'];
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $sqlUpdate = "UPDATE category SET name='$name', description='$description' WHERE id=$category_id";
        if(mysqli_query($conn, $sqlUpdate)) {
            header("Location: ../pages/manageCategories.php");
            exit();
        } else {
            echo "Failed to update category: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";
    }
}

if(isset($_POST['delete_category'])) {
    $role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
    if ($role === 'admin') {
        $category_id = (int)$_POST['category_id'];
        $sqlDelete = "DELETE FROM category WHERE id=$category_id";
        if(mysqli_query($conn, $sqlDelete)) {
            header("Location: ../pages/manageCategories.php");
            exit();
        } else {
            echo "Failed to delete category: " . mysqli_error($conn);
        }
    } else {
        echo "Unauthorized access.";
    }
}
?>
