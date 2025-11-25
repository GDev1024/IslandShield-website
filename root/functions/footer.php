<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5><i class="fas fa-shield-alt me-2"></i>IslandShield Security</h5>
                <p>Providing professional security solutions to protect what matters most. Licensed, certified, and trusted by the community.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php">Home</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">Services</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'hero/' : ''; ?>about.php">About Us</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'hero/' : ''; ?>contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Services</h5>
                <ul>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">CCTV Installation</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">Security Personnel</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">Event Security</a></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">Emergency Response</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5>Contact Info</h5>
                <ul>
                    <li><i class="fas fa-map-marker-alt me-2"></i>Grenville, St. Andrew</li>
                    <li><i class="fas fa-phone me-2"></i>(473) 555-SAFE</li>
                    <li><i class="fas fa-envelope me-2"></i>info@islandshield.com</li>
                    <li><i class="fas fa-clock me-2"></i>24/7 Available</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> IslandShield Security Services. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>assets/js/main.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>assets/js/