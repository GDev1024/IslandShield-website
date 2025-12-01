<?php
// Load environment variables from .env file if it exists (local development)
$env = [];
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $env = parse_ini_file($envFile, false, INI_SCANNER_TYPED);
}

// Base URL - auto-detect or use environment variable
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define("BASE_URL", getenv('APP_URL') ?: $protocol . $host . '/');

// Database Settings - Use environment variables with fallbacks
define("DB_HOST", getenv('DB_HOST') ?: ($env['DB_HOST'] ?? 'localhost'));
define("DB_USER", getenv('DB_USER') ?: ($env['DB_USER'] ?? 'root'));
define("DB_PASS", getenv('DB_PASSWORD') ?: ($env['DB_PASSWORD'] ?? ''));
define("DB_NAME", getenv('DB_NAME') ?: ($env['DB_NAME'] ?? 'islandshield'));
define("DB_PORT", getenv('DB_PORT') ?: ($env['DB_PORT'] ?? '5432'));

// PostgreSQL connection using PDO
try {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    $connection = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Unable to connect to database. Please try again later.");
}

// Timezone
date_default_timezone_set("America/Grenada");

// Debug Mode - Use environment variable
define("DEBUG_MODE", getenv('APP_DEBUG') === 'true' || ($env['APP_DEBUG'] ?? false));

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
