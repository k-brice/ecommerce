<?php
session_start();
// Check if admin is doing this
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    header("Location: landing.php");
    exit();
}

include "../database/connection.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = "SELECT * FROM category WHERE id = $id";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    echo "<div style='text-align:center; padding:50px;'><h2>Category Not Found</h2></div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.2">
</head>
<body class="login-page">
    <div class="signup-card" style="max-width: 500px; width: 100%;">
        <h2>Edit Category</h2>
        <form action="../controller/categoryController.php" method="POST">
            <input type="hidden" name="edit_category" value="1">
            <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
            
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" required value="<?php echo htmlspecialchars($category['name']); ?>">
            </div>
            
            <div class="form-group">
                <label>Description (Optional)</label>
                <input type="text" name="description" value="<?php echo isset($category['description']) ? htmlspecialchars($category['description']) : ''; ?>">
            </div>
            
            <button type="submit" name="submit" style="margin-top: 1rem;">Update Category</button>
            <a href="manageCategories.php" class="link" style="color: var(--text-muted); display: block; text-align: center; margin-top: 1rem;">Cancel</a>
        </form>
    </div>
</body>
</html>
