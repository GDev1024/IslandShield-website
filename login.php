<?php
// contact.php
include "includes/header.php";
?>

<main>
  <!-- Contact Section -->
  <section class="auth-section">
    <div class="container auth-container">
      <div class="auth-card">

        <!-- Auth Header -->
        <header class="auth-header">
          <h1>Contact Us</h1>
          <p>Fill out the form below and we'll get back to you within 24 hours.</p>
        </header>

        <!-- Contact Form -->
        <form id="contactForm" class="auth-form" method="POST" action="process_contact.php" aria-label="Contact Form">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name *</label>
              <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" id="email" name="email" placeholder="john@example.com" required>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="(473) 555-1234">
            </div>
            <div class="form-group">
              <label for="service">Service Interested In</label>
              <select id="service" name="service">
                <option value="">Select a service</option>
                <option value="cctv">CCTV Installation</option>
                <option value="personnel">Security Personnel</option>
                <option value="event">Event Security</option>
                <option value="emergency">Emergency Response</option>
                <option value="consultation">General Consultation</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="subject">Subject *</label>
            <input type="text" id="subject" name="subject" placeholder="How can we help?" required>
          </div>

          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="6" placeholder="Tell us about your security needs..." required></textarea>
          </div>

          <button type="submit" class="btn btn-submit btn-full">Send Message</button>
        </form>

        <!-- Divider -->
        <div class="divider"><span>OR</span></div>

        <!-- Contact Info -->
        <div class="social-login contact-info">
          <h2>Contact Information</h2>
          <p>Reach us through any of the following channels:</p>
          <div class="contact-item">
            <span class="contact-icon">📍</span>
            <p>Main Street, Grenville, St. Andrew, Grenada</p>
          </div>
          <div class="contact-item">
            <span class="contact-icon">📞</span>
            <p>Main: <a href="tel:4735557233">(473) 555-SAFE</a><br>Emergency: <a href="tel:4735559111">(473) 555-9111</a></p>
          </div>
          <div class="contact-item">
            <span class="contact-icon">✉️</span>
            <p>General: <a href="mailto:info@islandshield.com">info@islandshield.com</a><br>Support: <a href="mailto:support@islandshield.com">support@islandshield.com</a></p>
          </div>
          <div class="contact-item">
            <span class="contact-icon">🕐</span>
            <p>Office: Mon-Fri, 8:00 AM - 6:00 PM<br>Emergency: 24/7/365</p>
          </div>
        </div>

        <!-- Auth Footer -->
        <footer class="auth-footer">
          <p>Need immediate help? <a href="tel:4735559111">Call our 24/7 hotline</a></p>
        </footer>

      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>
<script src="assets/js/script.js"></script>
