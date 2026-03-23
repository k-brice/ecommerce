<?php
session_start();
// Check if admin is doing this
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    header("Location: landing.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.2">
</head>
<body class="login-page">
    <div class="signup-card" style="max-width: 500px; width: 100%;">
        <h2>Add New Category</h2>
        <form action="../controller/categoryController.php" method="POST">
            <input type="hidden" name="add_category" value="1">
            
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" required placeholder="e.g. Trucks, Convertibles">
            </div>
            
            <div class="form-group">
                <label>Description (Optional)</label>
                <input type="text" name="description" placeholder="Brief description of this category">
            </div>
            
            <button type="submit" name="submit" style="margin-top: 1rem;">Save Category</button>
            <a href="manageCategories.php" class="link" style="color: var(--text-muted); display: block; text-align: center; margin-top: 1rem;">Cancel</a>
        </form>
    </div>
</body>
</html>
