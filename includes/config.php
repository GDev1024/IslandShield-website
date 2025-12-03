<?php
// Load environment variables from .env file if it exists (local development)
$env = [];
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $env = @parse_ini_file($envFile, false, INI_SCANNER_RAW);
    if ($env === false) {
        $env = [];
    }
}

// Base URL - auto-detect or use environment variable
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define("BASE_URL", getenv('APP_URL') ?: $protocol . $host . '/');

// Debug Mode - Use environment variable (define early)
define("DEBUG_MODE", getenv('APP_DEBUG') === 'true' || ($env['APP_DEBUG'] ?? false));

// Database Settings - Use environment variables with fallbacks
define("DB_HOST", getenv('DB_HOST') ?: ($env['DB_HOST'] ?? 'localhost'));
define("DB_USER", getenv('DB_USER') ?: ($env['DB_USER'] ?? 'root'));
define("DB_PASS", getenv('DB_PASSWORD') ?: ($env['DB_PASSWORD'] ?? ''));
define("DB_NAME", getenv('DB_NAME') ?: ($env['DB_NAME'] ?? 'islandshield_db'));

// MySQL connection using MySQLi
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$connection) {
    error_log("Database connection failed: " . mysqli_connect_error());
    if (DEBUG_MODE) {
        die("Database connection failed: " . mysqli_connect_error());
    } else {
        die("Unable to connect to database. Please try again later.");
    }
}

// Set charset to UTF-8
mysqli_set_charset($connection, "utf8mb4");

// Timezone
date_default_timezone_set("America/Grenada");

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Security settings for production
if (getenv('APP_ENV') === 'production') {
    // Secure session settings
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.use_strict_mode', 1);
}
?>
