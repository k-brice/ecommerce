<?php
$email = isset($_POST["email"]) ? $_POST["email"] : (isset($_GET["name"]) ? "Guest (" . htmlspecialchars($_GET["name"]) . ")" : "User");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ManG</title>
    <link rel="stylesheet" href="index.css?v=2.0">
    <style>
        /* Small adjustments to fit dashboard components into landing layout */
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
            <h1>ManG</h1>
        </div>
        <div class="options">
            <div style="display: inline-flex; align-items: center; gap: 1rem; margin-right: 1.5rem;">
                <div class="avatar" style="width: 32px; height: 32px; font-size: 1rem;"><?php echo strtoupper(substr(str_replace('Guest (', '', $email), 0, 1)); ?></div>
                <span style="color: var(--text); font-weight: 500;"><?php echo htmlspecialchars($email); ?></span>
            </div>
            <a href="landing.php">Home</a>
            <a href="#overview">Overview</a>
            <a href="login.php" class="btn-login" style="background-color: #ef4444;">Logout</a>
        </div>
    </nav>



    <!-- Main Content Section -->
    <section class="dashboard-section container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">Total Views</div>
                <div class="stat-value">1,248</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">New Users</div>
                <div class="stat-value">64</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Active Sessions</div>
                <div class="stat-value">12</div>
            </div>
        </div>

        <div class="dashboard-content" style="margin-top: 2rem;">
            <h3>Recent Activity</h3>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div>
                    <strong>System Update</strong>
                    <div style="color: var(--text-muted); font-size: 0.875rem;">Successfully redesigned platform interfaces</div>
                </div>
                <div style="margin-left: auto; color: var(--text-muted); font-size: 0.875rem;">Just now</div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <strong>Sign In</strong>
                    <div style="color: var(--text-muted); font-size: 0.875rem;"><?php echo htmlspecialchars($email); ?> logged into the system</div>
                </div>
                <div style="margin-left: auto; color: var(--text-muted); font-size: 0.875rem;"><?php echo date('H:i'); ?></div>
            </div>
        </div>
    </section>
</body>
</html>