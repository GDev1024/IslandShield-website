<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - IslandShield Security</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header / Nav -->
<?php include "includes/header.php"; ?>

<!-- Registration Section -->
<main>
  <section class="auth-section">
    <div class="container auth-container">
      <div class="auth-card">

        <!-- Auth Header -->
        <header class="auth-header">
          <h1>Create Your Account</h1>
          <p>Join IslandShield Security and manage your security services online</p>
        </header>

        <!-- Registration Form -->
        <form id="registerForm" class="auth-form" aria-label="Registration Form">
          <div class="form-row">
            <div class="form-group">
              <label for="firstName">First Name *</label>
              <input type="text" id="firstName" name="firstName" required placeholder="John">
            </div>
            <div class="form-group">
              <label for="lastName">Last Name *</label>
              <input type="text" id="lastName" name="lastName" required placeholder="Doe">
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required placeholder="john@example.com">
          </div>

          <div class="form-group">
            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required placeholder="(473) 555-1234">
          </div>

          <div class="form-group">
            <label for="address">Street Address *</label>
            <input type="text" id="address" name="address" required placeholder="123 Main Street">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="parish">Parish *</label>
              <select id="parish" name="parish" required>
                <option value="">Select Parish</option>
                <option value="st-andrew">St. Andrew</option>
                <option value="st-david">St. David</option>
                <option value="st-george">St. George</option>
                <option value="st-john">St. John</option>
                <option value="st-mark">St. Mark</option>
                <option value="st-patrick">St. Patrick</option>
                <option value="carriacou">Carriacou & Petite Martinique</option>
              </select>
            </div>
            <div class="form-group">
              <label for="propertyType">Property Type *</label>
              <select id="propertyType" name="propertyType" required>
                <option value="">Select Type</option>
                <option value="residential">Residential</option>
                <option value="commercial">Commercial</option>
                <option value="industrial">Industrial</option>
                <option value="event-venue">Event Venue</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" required placeholder="Minimum 8 characters">
            <small>Must be at least 8 characters long</small>
          </div>

          <div class="form-group">
            <label for="confirmPassword">Confirm Password *</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Re-enter password">
          </div>

          <div class="form-group checkbox-group">
             <label class="checkbox-label">
                <input type="checkbox" id="terms" name="terms" required>
                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
              </label>
          </div>

          <div class="form-group checkbox-group">
            <label class="checkbox-label">
              <input type="checkbox" id="updates" name="updates">
              Send me security tips and company updates
          </label>
          </div>

          <button type="submit" class="btn btn-submit btn-full">Create Account</button>
        </form>

        <!-- Auth Footer -->
        <footer class="auth-footer">
          <p>Already have an account? <a href="login.php">Log In</a></p>
          <p class="security-notice">🔒 Your connection is secure and encrypted</p>
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
