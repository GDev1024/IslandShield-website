<?php
require_once 'includes/config.php';

echo "<h2>Database Check</h2>";

// Check connection
if (!$connection) {
    echo "✗ Connection failed: " . mysqli_connect_error();
    exit;
}
echo "✓ Connected to database: " . DB_NAME . "<br><br>";

// Check if database exists and is selected
$result = mysqli_query($connection, "SELECT DATABASE()");
$row = mysqli_fetch_row($result);
echo "Current database: " . ($row[0] ?? 'NONE') . "<br><br>";

// List all tables
echo "<h3>Tables in database:</h3>";
$result = mysqli_query($connection, "SHOW TABLES");
if (mysqli_num_rows($result) == 0) {
    echo "<strong style='color:red'>✗ NO TABLES FOUND! You need to import the SQL file.</strong><br><br>";
    echo "Go to phpMyAdmin (http://localhost/phpmyadmin) and:<br>";
    echo "1. Select 'islandshield_db' database<br>";
    echo "2. Click 'Import' tab<br>";
    echo "3. Choose 'includes/islandshield_database.sql'<br>";
    echo "4. Click 'Go'<br>";
} else {
    while ($row = mysqli_fetch_row($result)) {
        echo "- " . $row[0] . "<br>";
    }
}

// Check users table
echo "<br><h3>Users in database:</h3>";
$result = mysqli_query($connection, "SELECT user_id, first_name, last_name, email FROM users");
if (!$result) {
    echo "✗ Error: " . mysqli_error($connection);
} else if (mysqli_num_rows($result) == 0) {
    echo "<strong style='color:red'>✗ No users found!</strong><br>";
    echo "The SQL file wasn't imported properly.<br>";
} else {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Test password hash
echo "<br><h3>Password Test:</h3>";
$testPassword = 'password';
$result = mysqli_query($connection, "SELECT email, password_hash FROM users WHERE email = 'garysonwalker@test.com'");
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    echo "User found: " . $user['email'] . "<br>";
    echo "Stored hash: " . substr($user['password_hash'], 0, 30) . "...<br>";
    
    if (password_verify($testPassword, $user['password_hash'])) {
        echo "<strong style='color:green'>✓ Password 'password' is CORRECT</strong><br>";
    } else {
        echo "<strong style='color:red'>✗ Password 'password' does NOT match</strong><br>";
        echo "Creating new hash for 'password':<br>";
        $newHash = password_hash($testPassword, PASSWORD_DEFAULT);
        echo "New hash: " . $newHash . "<br>";
        
        // Update the password
        $stmt = mysqli_prepare($connection, "UPDATE users SET password_hash = ? WHERE email = 'garysonwalker@test.com'");
        mysqli_stmt_bind_param($stmt, "s", $newHash);
        if (mysqli_stmt_execute($stmt)) {
            echo "<strong style='color:green'>✓ Password updated! Try logging in with 'password' now.</strong><br>";
        }
    }
} else {
    echo "<strong style='color:red'>✗ User garysonwalker@test.com not found</strong><br>";
}
?>
