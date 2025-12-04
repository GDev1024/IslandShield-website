<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - IslandShield Security</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- Modular CSS -->
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/layout.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/pages/auth.css">
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

        <?php if (isset($_SESSION['success_message'])): ?>
          <div class="alert alert-success" style="background: rgba(0,255,0,0.2); border: 1px solid #00ff00; color: #00ff00; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
          </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_message'])): ?>
          <div class="alert alert-error" style="background: rgba(255,68,68,0.2); border: 1px solid #ff4444; color: #ff4444; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            <?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
          </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form id="loginForm" class="auth-form" method="POST" action="login_handler.php" aria-label="Login Form">
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

        <!-- Auth Footer -->
        <footer class="auth-footer">
          <p>Don't have an account? <a href="register.php">Sign up here</a></p>
        </footer>

      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>

<script src="/assets/js/script.js"></script>
