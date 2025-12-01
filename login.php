<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - IslandShield Security</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<main>
  <!-- Login Section -->
  <section class="auth-section">
    <div class="container auth-container">
      <div class="auth-card">

        <!-- Auth Header -->
        <header class="auth-header">
          <h1>Welcome Back</h1>
          <p>Log in to access your security dashboard</p>
        </header>

        <!-- Login Form -->
        <form id="loginForm" class="auth-form" method="POST" action="includes/login_handler.php" aria-label="Login Form">
          <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" required>
          </div>

          <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>

          <div class="form-options">
            <label class="checkbox-label">
              <input type="checkbox" name="remember" id="remember">
              <span>Remember me</span>
            </label>
            <a href="#" class="forgot-password">Forgot Password?</a>
          </div>

          <button type="submit" class="btn btn-submit btn-full">Log In</button>
        </form>

        <!-- Divider -->
        <div class="divider"><span>OR</span></div>

        <!-- Social Login -->
        <div class="social-login">
          <button type="button" class="btn-social btn-google">
            <i class="fa fa-google"></i> Continue with Google
          </button>
          <button type="button" class="btn-social btn-facebook">
            <i class="fa fa-facebook"></i> Continue with Facebook
          </button>
        </div>

        <!-- Auth Footer -->
        <footer class="auth-footer">
          <p>Don't have an account? <a href="register.php">Sign up here</a></p>
        </footer>

      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>
<script src="assets/js/script.js"></script>
