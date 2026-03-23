<?php
session_start();
include "../database/connection.php";
// Check if coming from login or form submission
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : (isset($_POST["email"]) ? $_POST["email"] : "Guest");
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : 'client';

$soldQuery = "SELECT SUM(quantity) as total_sold FROM payment";
$soldResult = mysqli_query($conn, $soldQuery);
$soldRow = mysqli_fetch_assoc($soldResult);
$carsSold = $soldRow['total_sold'] ?? 0;

$inventoryQuery = "SELECT COUNT(*) as total_inventory FROM product";
$invResult = mysqli_query($conn, $inventoryQuery);
$invRow = mysqli_fetch_assoc($invResult);
$newInventory = $invRow['total_inventory'] ?? 0;

$revenueQuery = "SELECT SUM(amount) as total_revenue FROM payment";
$revResult = mysqli_query($conn, $revenueQuery);
$revRow = mysqli_fetch_assoc($revResult);
$totalRevenue = $revRow['total_revenue'] ?? 0;

$recentActivityQuery = "SELECT payment.*, product.name as product_name, user.name as user_name FROM payment JOIN product ON payment.product_id = product.id JOIN user ON payment.user_id = user.id ORDER BY payment.id DESC LIMIT 5";
$recentActivityResult = mysqli_query($conn, $recentActivityQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ManG Cars</title>
    <link rel="stylesheet" href="index.css?v=2.1">
    <style>
        .dashboard-hero {
            min-height: 40vh;
            padding: 4rem 2rem 2rem;
            align-items: flex-end;
            padding-bottom: 4rem;
        }
        .dashboard-section {
            padding: 2rem;
            background: var(--bg);
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body class="landing-page">
    <nav class="navbar">
        <div class="logo">
            <h1>ManG Cars Dashboard</h1>
        </div>
        <div class="menu-toggle" onclick="document.querySelector('.options').classList.toggle('active')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </div>
        <div class="options">
            <div style="display: inline-flex; align-items: center; gap: 1rem; margin-right: 1.5rem;">
                <div class="avatar" style="width: 32px; height: 32px; font-size: 1rem;"><?php echo strtoupper(substr(str_replace('Guest (', '', $email), 0, 1)); ?></div>
                <span style="color: var(--text); font-weight: 500;"><?php echo htmlspecialchars($email); ?></span>
            </div>
            <a href="landing.php">Storefront</a>
            <?php if ($role === 'admin'): ?>
            <a href="manageProducts.php">Manage Products</a>
            <a href="manageCategories.php">Manage Categories</a>
            <?php endif; ?>
            <a href="login.php" class="btn-login" style="background-color: #ef4444;">Logout</a>
        </div>
    </nav>



    <!-- Main Content Section -->
    <section class="dashboard-section container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Cars Sold</div>
                <div class="stat-value"><?php echo number_format($carsSold); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">New Inventory</div>
                <div class="stat-value"><?php echo number_format($newInventory); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Total Revenue</div>
                <div class="stat-value"><?php echo number_format((float)$totalRevenue, 2); ?> FCFA</div>
            </div>
        </div>

        <div class="dashboard-content" style="margin-top: 2rem;">
            <h3>Recent Sales Activity</h3>
            
            <?php 
            if($recentActivityResult && mysqli_num_rows($recentActivityResult) > 0) {
                while($activity = mysqli_fetch_assoc($recentActivityResult)) {
            ?>
            <div class="activity-item">
                <div class="activity-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div>
                    <strong>New Sale Secured</strong>
                    <div style="color: var(--text-muted); font-size: 0.875rem;">
                        <?php echo htmlspecialchars($activity['user_name']); ?> purchased <?php echo $activity['quantity']; ?>x <?php echo htmlspecialchars($activity['product_name']); ?> via <?php echo htmlspecialchars($activity['payment_method']); ?>
                    </div>
                </div>
                <div style="margin-left: auto; text-align: right;">
                    <strong style="color: var(--primary); font-size: 0.875rem; display: block;"><?php echo number_format($activity['amount'], 2); ?> FCFA</strong>
                    <div style="color: var(--text-muted); font-size: 0.75rem;">Recently</div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p style='color: var(--text-muted); padding: 1rem 0;'>No recent sales activity to display.</p>";
            }
            ?>
        </div>
    </section>
</body>
</html>