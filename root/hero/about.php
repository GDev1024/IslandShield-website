<?php
$page_title = "About Us - IslandShield Security";
require_once __DIR__ . '/../database/config.php';
require_once __DIR__ . '/../database/auth.php';

require_once __DIR__ . '/../functions/header.php';
?>

<section class="about-page py-5">
    <div class="container">
        <!-- Page Title -->
        <div class="section-title text-center mb-5">
            <h2>About IslandShield Security</h2>
            <p>Your trusted partner in comprehensive security solutions</p>
        </div>

        <!-- Company Overview -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4">
                <img src="../assets/images/about-hero.jpg" alt="IslandShield Team" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">Who We Are</h3>
                <p>IslandShield Security Services is a leading provider of comprehensive security solutions across the Caribbean. With over a decade of experience, we have become the trusted choice for businesses and individuals seeking professional protection and peace of mind.</p>
                <p>Our commitment to excellence, innovation, and customer satisfaction drives everything we do. We combine cutting-edge technology with highly trained security personnel to deliver unparalleled protection.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Licensed and Certified Personnel</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>24/7 Monitoring & Response</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>State-of-the-Art Technology</li>
                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Customized Solutions</li>
                </ul>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="about-card">
                    <div class="about-card-icon">
                        <i class="fas fa-target fa-3x text-primary"></i>
                    </div>
                    <h4>Our Mission</h4>
                    <p>To provide innovative, reliable, and professional security services that protect our clients' assets, people, and peace of mind through cutting-edge technology and dedicated personnel.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="about-card">
                    <div class="about-card-icon">
                        <i class="fas fa-eye fa-3x text-primary"></i>
                    </div>
                    <h4>Our Vision</h4>
                    <p>To be the leading security provider in the Caribbean region, recognized for our commitment to excellence, innovation, and customer satisfaction.</p>
                </div>
            </div>
        </div>

        <!-- Core Values -->
        <div class="about-values mb-5">
            <h3 class="text-center mb-4">Our Core Values</h3>
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <div class="value-icon">
                        <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                    </div>
                    <h5>Safety</h5>
                    <p>We prioritize the safety and security of everyone we serve</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="value-icon">
                        <i class="fas fa-handshake fa-2x text-primary mb-3"></i>
                    </div>
                    <h5>Integrity</h5>
                    <p>We operate with honesty and transparency in all dealings</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="value-icon">
                        <i class="fas fa-cogs fa-2x text-primary mb-3"></i>
                    </div>
                    <h5>Excellence</h5>
                    <p>We strive for the highest standards in every service we provide</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="value-icon">
                        <i class="fas fa-users fa-2x text-primary mb-3"></i>
                    </div>
                    <h5>Partnership</h5>
                    <p>We build long-term relationships with our clients</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="about-cta text-center py-5">
            <h3>Ready to Secure Your Property?</h3>
            <p class="lead mb-4">Contact us today for a free security consultation</p>
            <a href="contact.php" class="btn btn-primary btn-lg">
                <i class="fas fa-phone me-2"></i>Get in Touch
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../functions/footer.php'; ?>