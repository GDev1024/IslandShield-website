<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - IslandShield Security</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Header / Nav -->
<?php include "includes/header.php"; ?>

<!-- Login Section -->
<section class="auth-section">
  <div class="container">
    <div class="auth-wrapper-centered">
      <div class="auth-form-container">
        <div class="auth-header">
          <h1>Welcome Back</h1>
          <p>Log in to access your security dashboard</p>
        </div>
        
        <form id="loginForm" class="auth-form">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="john@example.com" autocomplete="email">
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password" autocomplete="current-password">
          </div>
          
          <div class="form-group form-options">
            <label class="checkbox-label">
              <input type="checkbox" id="remember" name="remember">
              Remember me
            </label>
            <a href="#" class="forgot-password">Forgot Password?</a>
          </div>
          
          <button type="submit" class="btn btn-submit btn-full">Log In</button>
        </form>
        
        <div class="divider">
          <span>OR</span>
        </div>
        
        <div class="social-login">
          <button class="btn-social btn-google">
            <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
             <span>Continue with Google</span>
           </button>
        </div>
        
        <div class="auth-footer">
          <p>Don't have an account? <a href="register.html">Sign Up</a></p>
        </div>
        
        <div class="security-notice">
          <p>🔒 Your connection is secure and encrypted</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Quick Access Features -->
<section class="login-features">
  <div class="container">
    <h2 class="section-title">Access Your Security Dashboard</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">📹</div>
        <h3>Live Camera Feeds</h3>
        <p>Monitor all your cameras in real-time from any device</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🔔</div>
        <h3>Instant Alerts</h3>
        <p>Get notified immediately of any security events</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">📊</div>
        <h3>Activity Reports</h3>
        <p>View detailed reports and analytics of your security system</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">⚙️</div>
        <h3>System Control</h3>
        <p>Manage settings and configure your security preferences</p>
      </div>
    </div>
  </div>
</section>

<!-- Emergency Contact -->
<section class="emergency-banner">
  <div class="container">
    <div class="emergency-content">
      <h2>🚨 Need Immediate Assistance?</h2>
      <p>For security emergencies, call our 24/7 hotline</p>
      <a href="tel:4735559111" class="btn btn-emergency">(473) 555-9111</a>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include "includes/footer.php"; ?>


<script src="assets/js/script.js"></script>
</body>
</html>