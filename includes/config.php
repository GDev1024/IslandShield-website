<?php

define("BASE_URL", "http://localhost/islandshield/");

// Database Settings (XAMPP default)
define("DB_HOST", "localhost");
define("DB_USER", "root");     
define("DB_PASS", "");         
define("DB_NAME", "islandshield"); 

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Timezone
date_default_timezone_set("America/Grenada");

// Debug Mode (true = error messages, false = hide errors)
define("DEBUG_MODE", true);

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}
?>
