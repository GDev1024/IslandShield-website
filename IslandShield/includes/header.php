<?php
// header.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IslandShield Security</title>
    <link rel="stylesheet" href="/IslandShield/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="/IslandShield/assets/js/script.js" defer></script>
</head>

<body>

<!-- Header / Nav -->
<header>
  <div class="container header-container">
    <h1>IslandShield Security</h1>

    <nav>
      <ul id="navMenu">
        <li><a href="/IslandShield/index.php" class="active">Home</a></li>
        <li><a href="/IslandShield/about.php">About Us</a></li>

        <li class="has-dropdown">
          <a href="#">Services ▼</a>
          <ul class="dropdown">
            <li><a href="/IslandShield/services/cctv.php">CCTV Installation</a></li>
            <li><a href="/IslandShield/services/personnel.php">Security Personnel</a></li>
            <li><a href="/IslandShield/services/event.php">Event Security</a></li>
            <li><a href="/IslandShield/services/emergency.php">Emergency Response</a></li>
          </ul>
        </li>

        <li><a href="/IslandShield/resources.php">Resources</a></li>
        <li><a href="/IslandShield/contact.php">Contact</a></li>
        <li><a href="/IslandShield/faq.php">FAQ</a></li>
        <li><a href="/IslandShield/register.php" class="btn-nav">Sign Up</a></li>
        <li><a href="/IslandShield/login.php" class="btn-nav btn-secondary">Log In</a></li>
      </ul>
    </nav>

    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>
