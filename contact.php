<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - IslandShield Security</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header / Nav -->
<?php include "includes/header.php"; ?>

<main>

  <!-- Contact Section -->
  <section class="auth-section">
    <div class="container auth-container">
      <div class="auth-card">

        <!-- Header -->
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

        <!-- Contact Information -->
        <div class="contact-info">
          <h2>Contact Information</h2>
          <p>Reach us through any of the following channels. We're available 24/7 for emergencies.</p>

          <div class="contact-item">
            <span class="contact-icon">📍</span>
            <div class="contact-details">
              <h3>Office Location</h3>
              <p>Main Street<br>Grenville, St. Andrew<br>Grenada</p>
            </div>
          </div>

          <div class="contact-item">
            <span class="contact-icon">📞</span>
            <div class="contact-details">
              <h3>Phone Numbers</h3>
              <p><strong>Main:</strong> <a href="tel:4735557233">(473) 555-SAFE</a></p>
              <p><strong>Emergency:</strong> <a href="tel:4735559111">(473) 555-9111</a></p>
            </div>
          </div>

          <div class="contact-item">
            <span class="contact-icon">✉️</span>
            <div class="contact-details">
              <h3>Email Addresses</h3>
              <p><strong>General:</strong> <a href="mailto:info@islandshield.com">info@islandshield.com</a></p>
              <p><strong>Support:</strong> <a href="mailto:support@islandshield.com">support@islandshield.com</a></p>
            </div>
          </div>

          <div class="contact-item">
            <span class="contact-icon">🕐</span>
            <div class="contact-details">
              <h3>Business Hours</h3>
              <p><strong>Office:</strong> Mon-Fri, 8:00 AM - 6:00 PM</p>
              <p><strong>Emergency:</strong> 24/7/365</p>
            </div>
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

<!-- Footer -->
<?php include "includes/footer.php"; ?>

<script src="assets/js/script.js"></script>
</body>
</html>
