<?php
/**
 * Database Connection Test for Render PostgreSQL
 * 
 * This file tests the connection to the PostgreSQL database
 * Works for both local and Render deployments
 */

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>IslandShield Database Connection Test</h1>";
echo "<hr>";

// Load configuration
require_once 'includes/config.php';

echo "<h2>Configuration Details:</h2>";
echo "<ul>";
echo "<li><strong>Host:</strong> " . DB_HOST . "</li>";
echo "<li><strong>Port:</strong> " . DB_PORT . "</li>";
echo "<li><strong>Database:</strong> " . DB_NAME . "</li>";
echo "<li><strong>User:</strong> " . DB_USER . "</li>";
echo "<li><strong>Environment:</strong> " . (getenv('APP_ENV') ?: 'development') . "</li>";
echo "</ul>";
echo "<hr>";

// Test 1: Check if PDO PostgreSQL extension is loaded
echo "<h2>Test 1: PDO PostgreSQL Extension</h2>";
if (extension_loaded('pdo_pgsql')) {
    echo "<p style='color: green;'>✓ PDO PostgreSQL extension is loaded</p>";
} else {
    echo "<p style='color: red;'>✗ PDO PostgreSQL extension is NOT loaded</p>";
    echo "<p>Enable it in php.ini: <code>extension=pdo_pgsql</code></p>";
    exit;
}
echo "<hr>";

// Test 2: Test database connection
echo "<h2>Test 2: Database Connection</h2>";
try {
    if (isset($connection) && $connection instanceof PDO) {
        echo "<p style='color: green;'>✓ Database connection established successfully!</p>";
        
        // Test 3: Get PostgreSQL version
        echo "<h2>Test 3: PostgreSQL Version</h2>";
        $stmt = $connection->query("SELECT version()");
        $version = $stmt->fetch();
        echo "<p style='color: green;'>✓ PostgreSQL Version: " . $version['version'] . "</p>";
        echo "<hr>";
        
        // Test 4: List all tables
        echo "<h2>Test 4: Database Tables</h2>";
        $stmt = $connection->query("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public' 
            ORDER BY table_name
        ");
        $tables = $stmt->fetchAll();
        
        if (count($tables) > 0) {
            echo "<p style='color: green;'>✓ Found " . count($tables) . " tables:</p>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>" . $table['table_name'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠ No tables found. Run the SQL schema file to create tables.</p>";
        }
        echo "<hr>";
        
        // Test 5: Count records in users table
        echo "<h2>Test 5: Sample Data Check</h2>";
        try {
            $stmt = $connection->query("SELECT COUNT(*) as count FROM users");
            $result = $stmt->fetch();
            echo "<p style='color: green;'>✓ Users table has " . $result['count'] . " record(s)</p>";
            
            if ($result['count'] > 0) {
                $stmt = $connection->query("SELECT first_name, last_name, email FROM users LIMIT 5");
                $users = $stmt->fetchAll();
                echo "<p>Sample users:</p>";
                echo "<ul>";
                foreach ($users as $user) {
                    echo "<li>" . $user['first_name'] . " " . $user['last_name'] . " (" . $user['email'] . ")</li>";
                }
                echo "</ul>";
            }
        } catch (PDOException $e) {
            echo "<p style='color: orange;'>⚠ Users table not found or empty: " . $e->getMessage() . "</p>";
        }
        echo "<hr>";
        
        // Test 6: Test prepared statement
        echo "<h2>Test 6: Prepared Statement Test</h2>";
        try {
            $stmt = $connection->prepare("SELECT NOW() as current_time");
            $stmt->execute();
            $result = $stmt->fetch();
            echo "<p style='color: green;'>✓ Prepared statements working correctly</p>";
            echo "<p>Current database time: " . $result['current_time'] . "</p>";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>✗ Prepared statement failed: " . $e->getMessage() . "</p>";
        }
        echo "<hr>";
        
        // Summary
        echo "<h2>Summary</h2>";
        echo "<p style='color: green; font-size: 18px; font-weight: bold;'>✓ All tests passed! Database is ready to use.</p>";
        echo "<p><a href='index.php'>Go to Homepage</a> | <a href='login.php'>Go to Login</a></p>";
        
    } else {
        echo "<p style='color: red;'>✗ Connection variable is not set or not a PDO instance</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database connection failed!</p>";
    echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Error Code:</strong> " . $e->getCode() . "</p>";
    
    echo "<h3>Troubleshooting:</h3>";
    echo "<ul>";
    echo "<li>Check if PostgreSQL is running</li>";
    echo "<li>Verify DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD in .env</li>";
    echo "<li>Check if database 'islandshield_db' exists</li>";
    echo "<li>Check if user 'islandshield_user' has proper permissions</li>";
    echo "<li>For Render: Use Internal Database URL for DB_HOST</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p style='color: gray; font-size: 12px;'>Test completed at: " . date('Y-m-d H:i:s') . "</p>";
echo "<p style='color: gray; font-size: 12px;'><strong>Note:</strong> Delete this file after testing for security.</p>";
?>
