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
<main>
  <section class="auth-section">
    <div class="container auth-container">
      <div class="auth-card">
        
        <!-- Auth Header -->
        <header class="auth-header">
          <h1>Welcome Back</h1>
          <p>Log in to access your security dashboard</p>
        </header>

        <!-- Login Form -->
        <form id="loginForm" class="auth-form" aria-label="Login Form">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required autocomplete="email">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
          </div>

          <fieldset class="form-options">
            <label class="checkbox-label">
              <input type="checkbox" id="remember" name="remember">
              Remember me
            </label>
            <a href="#" class="forgot-password">Forgot Password?</a>
          </fieldset>

          <button type="submit" class="btn btn-submit btn-full">Log In</button>
        </form>

        <!-- Divider -->
        <div class="divider"><span>OR</span></div>

        <!-- Social Login -->
        <div class="social-login">
          <button class="btn-social btn-google" type="button" aria-label="Login with Google">
            <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
            <span>Continue with Google</span>
          </button>
        </div>

        <!-- Auth Footer -->
        <footer class="auth-footer">
          <p>Don't have an account? <a href="register.html">Sign Up</a></p>
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