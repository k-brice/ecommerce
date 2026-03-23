<?php
session_start();
// Check if admin is doing this
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';
if ($role !== 'admin') {
    header("Location: landing.php");
    exit();
}

include "../database/connection.php";
$query = "SELECT * FROM category ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.4">
</head>
<body class="landing-page">
    <nav class="navbar">
        <div class="logo">
            <h1>ManG Cars Admin</h1>
        </div>
        <div class="menu-toggle" onclick="document.querySelector('.options').classList.toggle('active')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </div>
        <div class="options">
            <a href="Dashboard.php">Dashboard</a>
            <a href="manageProducts.php">Manage Products</a>
            <a href="manageCategories.php" style="color: var(--primary);">Manage Categories</a>
            <a href="landing.php" class="btn-login">Storefront</a>
        </div>
    </nav>

    <div class="products-container" style="max-width: 1000px;">
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div style="text-align: left;">
                <h2 style="margin: 0;">Category Management</h2>
                <p style="margin: 0.5rem 0 0 0;">View, edit, and delete car categories.</p>
            </div>
            <a href="addCategory.php" class="btn btn-primary" style="display: inline-block;">Add New Category</a>
        </div>

        <div class="cart-table-wrapper" style="margin-top: 2rem;">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($result && mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td style="font-weight: 600; color: var(--text);"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo isset($row['description']) ? htmlspecialchars($row['description']) : '-'; ?></td>
                        <td>
                            <div style="display: flex; gap: 1rem; align-items: center;">
                                <a href="editCategory.php?id=<?php echo $row['id']; ?>" style="color: var(--primary); text-decoration: none; font-size: 0.875rem; font-weight: 500;">Edit</a>
                                <form action="../controller/categoryController.php" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="delete_category" value="1">
                                    <input type="hidden" name="category_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" style="background: none; border: none; color: #ef4444; font-size: 0.875rem; font-weight: 500; cursor: pointer; padding: 0;">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center; padding: 2rem;'>No categories found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
