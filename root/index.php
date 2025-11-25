<?php
$page_title = "Home - IslandShield Security Services";
require_once '/functions/header.php';
?>

<!-- Hero Section with Video Background -->
<section class="hero-section" id="home">
    <div class="hero-video-background">
        <video autoplay muted loop playsinline>
            <source src="assets/videos/islandshield_bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <h1>Professional Security Solutions</h1>
            <p class="lead">Protecting what matters most with 24/7 surveillance, expert personnel, and cutting-edge technology</p>
            <div class="hero-buttons">
                <a href="#services" class="btn-hero-primary">
                    <i class="fas fa-shield-alt me-2"></i>Our Services
                </a>
                <a href="hero/contact.php" class="btn-hero-secondary">
                    <i class="fas fa-phone me-2"></i>Get a Quote
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section" id="services">
    <div class="container">
        <div class="section-title">
            <h2>Our Core Services</h2>
            <p>Comprehensive security solutions tailored to your needs</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-video"></i>
                    <h3>CCTV Installation & Monitoring</h3>
                    <p>State-of-the-art surveillance systems with 24/7 monitoring, HD cameras, and cloud storage solutions.</p>
                    <a href="cctv-services.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-user-shield"></i>
                    <h3>Security Personnel</h3>
                    <p>Highly trained and certified security guards for businesses, residences, and special events.</p>
                    <a href="security-personnel.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Event Security</h3>
                    <p>Professional security teams for concerts, conferences, private parties, and corporate events.</p>
                    <a href="services.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-home"></i>
                    <h3>Residential Security</h3>
                    <p>Customized home security systems including alarms, access control, and patrol services.</p>
                    <a href="services.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-building"></i>
                    <h3>Corporate Protection</h3>
                    <p>Enterprise-level security solutions for offices, warehouses, and business facilities.</p>
                    <a href="services.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="fas fa-bell"></i>
                    <h3>Emergency Response</h3>
                    <p>Rapid response teams available 24/7 for emergency situations and crisis management.</p>
                    <a href="services.php" class="btn-service">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stat-box">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Clients Protected</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <span class="stat-number">15+</span>
                    <span class="stat-label">Years Experience</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <span class="stat-number">100+</span>
                    <span class="stat-label">Security Personnel</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Monitoring Service</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Secure Your Property?</h2>
        <p>Contact us today for a free security assessment and custom quote</p>
        <div class="hero-buttons">
            <a href="hero/contact.php" class="btn-hero-secondary">
                <i class="fas fa-envelope me-2"></i>Contact Us
            </a>
            <a href="tel:4735557233" class="btn-hero-primary" style="background: white; color: #3b82f6;">
                <i class="fas fa-phone me-2"></i>Call Now: (473) 555-SAFE
            </a>
        </div>
    </div>
</section>

<?php require_once 'functions/footer.php'; ?>