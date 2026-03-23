<?php
include "../database/connection.php";

$statements = [
    "CREATE TABLE IF NOT EXISTS user(
        id int primary key not null auto_increment,
        name varchar(50) not null,
        email varchar(50) not null,
        password varchar(50) not null,
        role varchar(50) not null default 'client'
    )",
    "CREATE TABLE IF NOT EXISTS category(
        id int primary key not null auto_increment,
        name varchar(100) not null,
        description text
    )",
    "CREATE TABLE IF NOT EXISTS product(
        id int primary key not null auto_increment,
        name varchar(100) not null,
        description text,
        price decimal(10,2) not null,
        category_id int,
        quantity int not null default 0,
        image varchar(255)
    )",
    "CREATE TABLE IF NOT EXISTS cart(
        id int primary key not null auto_increment,
        user_id int not null,
        product_id int not null,
        quantity int not null default 1
    )",
    "CREATE TABLE IF NOT EXISTS payment(
        id int primary key not null auto_increment,
        user_id int not null,
        product_id int not null,
        quantity int not null default 1,
        amount decimal(10,2) not null,
        payment_method varchar(50),
        status varchar(50) default 'pending',
        payment_date timestamp default current_timestamp
    )"
];

echo "<br>Running Setup...<br>";

foreach($statements as $sql) {
    if(mysqli_query($conn, $sql)) {
        echo "Table ensured successfully.<br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }
}

// Insert admin user
$adminSql = "SELECT * FROM user WHERE email='admin237@gmail.com'";
$res = mysqli_query($conn, $adminSql);
if(mysqli_num_rows($res) == 0) {
    $insertAdmin = "INSERT INTO user (name, email, password, role) VALUES ('admin', 'admin237@gmail.com', '123456789', 'admin')";
    if(mysqli_query($conn, $insertAdmin)) {
        echo "Admin user inserted successfully.<br>";
    } else {
        echo "Error inserting admin: " . mysqli_error($conn) . "<br>";
    }
} else {
    // Update admin role in case it was inserted previously without the admin role
    $updateAdmin = "UPDATE user SET role='admin' WHERE email='admin237@gmail.com'";
    mysqli_query($conn, $updateAdmin);
    echo "Admin user already exists. Role ensured as admin.<br>";
}

echo "Setup Complete.<br>";
?>
