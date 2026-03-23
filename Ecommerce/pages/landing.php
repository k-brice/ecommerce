<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - ManG Cars</title>
    <link rel="stylesheet" href="index.css">
</head>
<body class="landing-page">
    <nav class="navbar">
        <div class="logo">
            <h1>ManG Cars</h1>
        </div>
        <div class="menu-toggle" onclick="document.querySelector('.options').classList.toggle('active')">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </div>
        <div class="options">
            <a href="landing.php">Home</a>
            <a href="products.php">Cars</a>
            <a href="category.php">Categories</a>
            <a href="cart.php">Cart</a>
            <a href="#about">About</a>                
            <a href="signup.php">Signup</a> 
            <a href="Dashboard.php" class="btn-login">Dashboard</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero" id="home">
        <div class="hero-content">
            <img src="../assets/image/ev.jpg" alt="premium car">
            <p>Your premium car dealership. Browse our exclusive collection of luxury and sports cars and drive away satisfied.</p>
            <div class="hero-buttons">
                <a href="products.php" class="btn btn-primary">View Inventory</a>
                <a href="#about" class="btn btn-secondary">Learn More</a>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2>Why Choose Us</h2>
            <p class="about-subtitle">We provide top-tier vehicles and exceptional customer service.</p>
            <div class="about-grid">
                <div class="about-card">
                    <div class="icon">🏆</div>
                    <h3>Premium Selection</h3>
                    <p>Experience our hand-picked collection of premium vehicles tailored for top performance.</p>
                </div>
                <div class="about-card">
                    <div class="icon">🛡️</div>
                    <h3>Extended Warranty</h3>
                    <p>All our cars come with an extensive warranty to keep your peace of mind intact.</p>
                </div>
                <div class="about-card">
                    <div class="icon">💰</div>
                    <h3>Flexible Financing</h3>
                    <p>We offer flexible financing options to ensure you can afford the car of your dreams.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="footer" id="footer">
        <div class="footer-box">
            <h2>ManG <span>Cars</span></h2>
            <p>Your trusted partner in finding the perfect vehicle that suits your lifestyle and budget.</p>
            <div class="social">
                <a href="#"><i class="bx bxl-facebook"></i></a>
                <a href="#"><i class="bx bxl-twitter"></i></a>
                <a href="#"><i class="bx bxl-instagram"></i></a>
            </div>
        </div>
        <div class="footer-box">
            <h3>Services</h3>
            <li><a href="products.php">Inventory</a></li>
            <li><a href="#">Help & Support</a></li>
            <li><a href="#">Financing</a></li>
            <li><a href="#">FAQ</a></li>
        </div>
        <div class="footer-box">
            <h3>Categories</h3>
            <li><a href="category.php">Sedans</a></li>
            <li><a href="category.php">SUVs</a></li>
            <li><a href="category.php">Luxury Cars</a></li>
            <li><a href="category.php">Sports Cars</a></li>
        </div>
        <div class="footer-box contact-info">
            <h3>Contact</h3>
            <span>Cameroon, Yaounde 237</span>
            <span>+237 6 98 46 33 34</span>
            <span>contact@mangcars.com</span>
        </div>
    </section>
    <div class="copyright">
        <p>&#169; ManG Cars All Right Reserved.</p>
    </div>
</body>
</html>
