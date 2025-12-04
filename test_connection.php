<?php
// Test file to diagnose InfinityFree issues
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$diagnostics = [
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
];

// Test 1: Check if config file exists
$diagnostics['config_exists'] = file_exists(__DIR__ . '/includes/config.php');

// Test 2: Try to load config
try {
    require_once __DIR__ . '/includes/config.php';
    $diagnostics['config_loaded'] = true;
    $diagnostics['db_host'] = DB_HOST;
    $diagnostics['db_name'] = DB_NAME;
    $diagnostics['db_user'] = DB_USER;
} catch (Exception $e) {
    $diagnostics['config_loaded'] = false;
    $diagnostics['config_error'] = $e->getMessage();
}

// Test 3: Check database connection
if (isset($connection)) {
    $diagnostics['db_connected'] = mysqli_ping($connection);
    if ($diagnostics['db_connected']) {
        // Test 4: Check if users table exists
        $result = mysqli_query($connection, "SHOW TABLES LIKE 'users'");
        $diagnostics['users_table_exists'] = mysqli_num_rows($result) > 0;
        
        if ($diagnostics['users_table_exists']) {
            // Test 5: Count users
            $result = mysqli_query($connection, "SELECT COUNT(*) as count FROM users");
            $row = mysqli_fetch_assoc($result);
            $diagnostics['user_count'] = $row['count'];
        }
    } else {
        $diagnostics['db_error'] = mysqli_error($connection);
    }
} else {
    $diagnostics['db_connected'] = false;
    $diagnostics['connection_variable_missing'] = true;
}

// Test 6: Check POST handling
$diagnostics['request_method'] = $_SERVER['REQUEST_METHOD'];
$diagnostics['post_data_received'] = !empty($_POST);

// Test 7: Check session
session_start();
$diagnostics['session_working'] = session_status() === PHP_SESSION_ACTIVE;

// Test 8: Check write permissions
$diagnostics['can_write_sessions'] = is_writable(session_save_path());

echo json_encode($diagnostics, JSON_PRETTY_PRINT);
?>
