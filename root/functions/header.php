<?php
require_once __DIR__ . '/../database/config.php';
require_once __DIR__ . '/../database/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'IslandShield Security Services'; ?></title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Saira -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Saira:wght@300;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php">
            <i class="fas fa-shield-alt"></i>
            IslandShield Security
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mobile-menu-header d-lg-none">
                <h5><i class="fas fa-bars me-2"></i>Menu</h5>
                <button class="close-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php">
                        <i class="fas fa-home d-lg-none me-2"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? '' : '../'; ?>index.php#services">
                        <i class="fas fa-shield-alt d-lg-none me-2"></i>Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'hero/' : ''; ?>about.php">
                        <i class="fas fa-info-circle d-lg-none me-2"></i>About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'hero/' : ''; ?>contact.php">
                        <i class="fas fa-envelope d-lg-none me-2"></i>Contact
                    </a>
                </li>
                <li class="nav-item ms-lg-3">
                    <?php if (isLoggedIn()): ?>
                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'hero/' : ''; ?>dashboard.php" class="btn btn-login">
                            <i class="fas fa-user"></i> Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) == '/root' ? 'functions/' : '../functions/'; ?>login.php" class="btn btn-login">
                            <i class="fas fa-user"></i> Client Login
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>