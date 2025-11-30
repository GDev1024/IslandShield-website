<?php
// header.php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header>
  <div class="container header-container">
   <a href="index.php" class="default_logo"> 
     <img src="assets/images/logo2.png" alt="IslandShield Security Logo">
   </a>

    <nav>
      <ul id="navMenu">
        <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
        <li><a href="about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">About Us</a></li>

        <li class="has-dropdown">
          <a href="#">Services ▼</a>
          <ul class="dropdown">
            <li><a href="cctv.php" class="<?= $currentPage == 'cctv.php' ? 'active' : '' ?>">CCTV Installation</a></li>
            <li><a href="personnel.php" class="<?= $currentPage == 'personnel.php' ? 'active' : '' ?>">Security Personnel</a></li>
            <li><a href="event.php" class="<?= $currentPage == 'event.php' ? 'active' : '' ?>">Event Security</a></li>
            <li><a href="emergency.php" class="<?= $currentPage == 'emergency.php' ? 'active' : '' ?>">Emergency Response</a></li>
          </ul>
        </li>

        <li><a href="resources.php" class="<?= $currentPage == 'resources.php' ? 'active' : '' ?>">Resources</a></li>
        <li><a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
        <li><a href="faq.php" class="<?= $currentPage == 'faq.php' ? 'active' : '' ?>">FAQ</a></li>
        <li><a href="register.php" class="btn-nav <?= $currentPage == 'register.php' ? 'active' : '' ?>">Sign Up</a></li>
        <li><a href="login.php" class="btn-nav btn-secondary <?= $currentPage == 'login.php' ? 'active' : '' ?>">Log In</a></li>
      </ul>
    </nav>

    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>
