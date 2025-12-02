<?php
// Quick test to see what's happening
require_once 'includes/config.php';

echo "<h2>Database Connection Test</h2>";

// Test connection
if ($connection) {
    echo "✓ Connected to database<br>";
    echo "Database: " . DB_NAME . "<br>";
} else {
    echo "✗ Connection failed: " . mysqli_connect_error() . "<br>";
    exit;
}

// Check if users table exists
$result = mysqli_query($connection, "SHOW TABLES LIKE 'users'");
if (mysqli_num_rows($result) > 0) {
    echo "✓ Users table exists<br>";
} else {
    echo "✗ Users table does NOT exist<br>";
    echo "Run the SQL file to create tables<br>";
    exit;
}

// Check table structure
echo "<h3>Users Table Structure:</h3>";
$result = mysqli_query($connection, "DESCRIBE users");
echo "<pre>";
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}
echo "</pre>";

// Test a simple insert
echo "<h3>Testing Insert:</h3>";
$testEmail = "test_" . time() . "@test.com";
$testPassword = password_hash("test123", PASSWORD_DEFAULT);

$stmt = mysqli_prepare($connection, "INSERT INTO users (first_name, last_name, email, phone, address, parish, property_type, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo "✗ Prepare failed: " . mysqli_error($connection) . "<br>";
} else {
    $fn = "Test";
    $ln = "User";
    $phone = "1234567890";
    $addr = "Test Address";
    $parish = "st-george";
    $propType = "residential";
    
    mysqli_stmt_bind_param($stmt, "ssssssss", $fn, $ln, $testEmail, $phone, $addr, $parish, $propType, $testPassword);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "✓ Test insert successful<br>";
        echo "Test email: " . $testEmail . "<br>";
    } else {
        echo "✗ Insert failed: " . mysqli_error($connection) . "<br>";
    }
}
?>
